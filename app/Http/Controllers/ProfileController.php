<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Reviewer;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil.
     */
    public function index(Request $request)
    {
        // Asumsikan user login berdasarkan email untuk demonstrasi
        // $email = $request->user()->email; 
        // Pastikan sistem login mengirimkan data user
        // Email yang dicek
        $email = session('email'); // Ganti dengan email dari login (e.g., $request->user()->email)


        // Ambil data pengaju berdasarkan email
        $profilPengaju = Pengguna::where('email', $email)->first();

        // Cek di tabel Reviewer
        $profilReviewer = Reviewer::where('email', $email)->first();

        if (!$profilPengaju && !$profilReviewer) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        return view('proposal_kegiatan.profil_pengaju', compact('profilPengaju', 'profilReviewer'));
    }
}
