<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class MahasiswaAuthController extends Controller
{
    public function checkPengaju()
    {
        try {
            // Ambil pengguna mahasiswa yang sedang login
            $mahasiswa = Auth::guard('mahasiswa')->user();
            $username = $mahasiswa->username;
            
            // Cari reviewer menggunakan Eloquent
            $pengaju = Pengguna::with('ormawa') // Memuat relasi role
                ->where('username', $username)
                ->first();

            if ($pengaju) {
                session([
                    'username' => $pengaju->username,
                    'id' => $pengaju->id,
                    'ormawa' => $pengaju->ormawa->nama_ormawa,
                    'email' => $pengaju->email,                
                    'id_ormawa' => $pengaju->id_ormawa,

                ]);
                return redirect()->intended('/dashboard-pengaju');
            } else {
                // Jika bukan pengaju, logout dan arahkan ke halaman login mahasiswa
                Auth::guard('mahasiswa')->logout();
                return redirect()->route('login.mahasiswa')->withErrors([
                    'email' => 'Anda tidak memiliki akses sebagai pengaju.',
                ]);
            }
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('mahasiswa')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect()->route('login.mahasiswa'); // Arahkan kembali ke halaman login dosen
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }
}
