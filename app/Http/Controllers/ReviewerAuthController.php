<?php

namespace App\Http\Controllers;

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

        // Cek di database reviewer
        $reviewer = DB::connection('pgsql')
            ->table('reviewer')
            ->where('username', $username)
            ->first();

        if ($reviewer) {
            session([
                'username' => $reviewer->username,
                'role' => $reviewer->role,
                'id' => $reviewer->id,
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
}
