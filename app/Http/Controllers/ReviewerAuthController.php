<?php

namespace App\Http\Controllers;

use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewerAuthController extends Controller
{
    /**
     * Periksa apakah pengguna adalah reviewer dan atur sesi yang sesuai.
     */
    public function checkReviewer()
    {
        // Ambil pengguna yang sedang login
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
    }

    public function logout(Request $request)
    {
        Auth::guard('dosen')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.dosen'); // Arahkan kembali ke halaman login dosen
    }

}
