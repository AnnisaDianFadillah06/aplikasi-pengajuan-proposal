<?php

namespace App\Http\Controllers;

use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class ReviewerAuthController extends Controller
{

    public function checkReviewer()
    {
        try {
            $dosen = Auth::guard('dosen')->user();
            $username = $dosen->username;
    
            // Cari reviewer menggunakan Eloquent
            $reviewer = Reviewer::with('role','ormawa') // Memuat relasi role
                ->where('username', $username)
                ->first();
                
            if ($reviewer) {
                session([
                    'username' => $reviewer->username,
                    'role' => $reviewer->role->role,
                    'id_role' => $reviewer->id_role,
                    'ormawa' => $reviewer->ormawa->nama_ormawa,
                    'id_ormawa' => $reviewer->id_ormawa,
                    'id' => $reviewer->id,
                    'email' => $reviewer->email,
                ]);
                return redirect()->intended('/dashboard-reviewer');
            } else {
                // Jika bukan reviewer, logout dan arahkan ke halaman login dosen
                Auth::guard('dosen')->logout();
                return redirect()->route('login.dosen')->withErrors([
                    'email' => 'Anda tidak memiliki akses sebagai reviewer.',
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
            Auth::guard('dosen')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect()->route('login.dosen'); // Arahkan kembali ke halaman login dosen
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
