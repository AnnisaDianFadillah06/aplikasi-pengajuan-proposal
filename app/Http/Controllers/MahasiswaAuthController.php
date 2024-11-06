<?php

namespace App\Http\Controllers;

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
        $pengaju = DB::connection('pgsql')
            ->table('pengaju')
            ->where('username', $username)
            ->first();

        if ($pengaju) {
            session([
                'username' => $pengaju->username,
                'id' => $pengaju->id,
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
}
