<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MahasiswaAuthController extends Controller
{
    /**
     * Periksa apakah mahasiswa adalah pengaju dan atur sesi yang sesuai.
     */
    public function checkPengaju()
    {
        // Ambil pengguna mahasiswa yang sedang login
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $username = $mahasiswa->username;

        // Cek di database pengaju
        // $pengaju = DB::connection('pgsql')
        //     ->table('pengaju')
        //     ->where('username', $username)
        //     ->first();
        
        // Cari reviewer menggunakan Eloquent
        $pengaju = Pengguna::with('ormawa') // Memuat relasi role
            ->where('username', $username)
            ->where('status', 1)
            ->first();

        if ($pengaju) {
            session([
                'username' => $pengaju->username,
                'id' => $pengaju->id,
                'ormawa' => $pengaju->ormawa->nama_ormawa,
                'email' => $pengaju->email,                
                'id_ormawa' => $pengaju->id_ormawa,
                'foto_profil' => $pengaju->foto_profil,

            ]);
            return redirect()->intended('/dashboard-pengaju');
        } else {
            // Jika bukan pengaju, logout dan arahkan ke halaman login mahasiswa
            Auth::guard('mahasiswa')->logout();
            return redirect()->route('login.mahasiswa')->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai pengaju.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.mahasiswa'); // Arahkan kembali ke halaman login dosen
    }
}
