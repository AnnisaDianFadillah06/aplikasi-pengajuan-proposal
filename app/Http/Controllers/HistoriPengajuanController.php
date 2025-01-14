<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Impor DOMPDF facade
use App\Models\PengajuanProposal;
use App\Models\Proposal; // Impor model Proposal

class HistoriPengajuanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil semua proposal pengguna
        $proposals = PengajuanProposal::where('id_pengguna', $sessionId)
        ->whereIn('status', [1, 2]) // Filter berdasarkan status
        ->get();

        // Kembalikan hasil ke view
        return view('proposal_kegiatan.histori_pengajuan', compact('proposals'));
    }

    public function downloadPDF()
    {
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil semua proposal pengguna
        $proposals = PengajuanProposal::where('id_pengguna', $sessionId)
        ->whereIn('status', [1, 2]) // Filter berdasarkan status
        ->get();

        // Tentukan label status
        $statusLabels = [
            1 => 'Ditolak',
            2 => 'Disetujui',
        ];

        // Generate PDF menggunakan tampilan 'proposals-pdf'
        $pdf = PDF::loadView('proposal_kegiatan.histori_pdf', compact('proposals', 'statusLabels'));

        // Unduh file PDF dengan nama 'histori_pengajuan.pdf'
        return $pdf->download('Riwayat Pengajuan Proposal.pdf');
    }
}
