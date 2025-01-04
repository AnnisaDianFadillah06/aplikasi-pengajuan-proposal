<?php

namespace App\Http\Controllers;

use App\Models\Lpj;
use App\Models\ReviewLPJ;
use Illuminate\Http\Request;

class PengajuanLpjController extends Controller
{
    public function index()
    {
        // Ambil ID dari sesi
        $sessionId = session('id_ormawa');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil LPJ yang id_pengguna pada tabel pengajuan proposal-nya sama dengan id pengguna yang sedang login
        $lpjs = Lpj::whereHas('ormawa', function ($query) use ($sessionId) {
            $query->where('id_ormawa', $sessionId);
        })->get();

        // Ambil semua revisi terbaru untuk setiap proposal
        $latestReviews = ReviewLPJ::whereIn('id_lpj', $lpjs->pluck('id_lpj'))
            ->orderBy('id_lpj')
            ->orderBy('id_lpj', 'desc')
            ->get()
            ->groupBy('id_lpj')
            ->map(function ($revisions) {
                return $revisions->first(); // Ambil revisi terbaru dari setiap proposal
            });

        return view('proposal_kegiatan.pengajuan_lpj', [
            'lpjs' => $lpjs,
            'latestReviews' => $latestReviews
        ]);
    }
}
