<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        try {
            $email = session('email'); // Ganti dengan email dari login (e.g., $request->user()->email)

            // Ambil data pengaju berdasarkan email
            $profilPengaju = Pengguna::where('email', $email)->first();
    
            // Cek di tabel Reviewer
            $profilReviewer = Reviewer::where('email', $email)->first();
    
            if (!$profilPengaju && !$profilReviewer) {
                return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
            }
    
            return view('proposal_kegiatan.profil_pengaju', compact('profilPengaju', 'profilReviewer'));
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
