<?php

namespace App\Http\Controllers;

use App\Models\Proposal; // Impor model Proposal
use Illuminate\Http\Request;
use PDF; // Impor DOMPDF facade

class HistoriPengajuanReviewerController extends Controller
{
    public function index(Request $request)
    {
        // Ambil hanya kolom yang diperlukan
        $proposals = Proposal::select('id_proposal', 'nama_kegiatan', 'tgl_kegiatan', 'tmpt_kegiatan', 'created_at', 'status',)
        ->get();

        // Kembalikan hasil ke view
        return view('proposal_kegiatan.histori_pengajuan_reviewer', compact('proposals'));
    }

    public function downloadPDF()
    {
        // Ambil data proposal
        $proposals = Proposal::select('id_proposal', 'nama_kegiatan', 'tgl_kegiatan', 'tmpt_kegiatan', 'created_at', 'status',)
            ->get();

        // Tentukan label status
        $statusLabels = [
            0 => 'Menunggu',
            1 => 'Ditolak',
            2 => 'Disetujui',
            3 => 'Dibatalkan',
        ];

        // Generate PDF menggunakan tampilan 'proposals-pdf'
        $pdf = PDF::loadView('proposal_kegiatan.proposals-pdf', compact('proposals', 'statusLabels'));

        // Unduh file PDF dengan nama 'Riwayat Pengajuan Proposal.pdf'
        return $pdf->download('Riwayat Pengajuan Proposal.pdf');
    }
}
