<?php

namespace App\Http\Controllers;

use App\Models\Proposal; // Impor model Proposal
use Illuminate\Http\Request;
use PDF; // Impor DOMPDF facade

class HistoriPengajuanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil hanya kolom yang diperlukan
        $proposals = Proposal::select('id_proposal', 'nama_kegiatan', 'tgl_kegiatan', 'tmpt_kegiatan', 'created_at', 'status',)
        ->whereIn('status', [1, 2]) // Filter berdasarkan status
        ->get();

        // Kembalikan hasil ke view
        return view('proposal_kegiatan.histori_pengajuan', compact('proposals'));
    }

    public function downloadPDF()
    {
        // Ambil data proposal
        $proposals = Proposal::select('id_proposal', 'nama_kegiatan', 'tgl_kegiatan', 'tmpt_kegiatan', 'created_at', 'status',)
            ->whereIn('status', [1, 2])
            ->get();

        // Tentukan label status
        $statusLabels = [
            1 => 'Ditolak',
            2 => 'Disetujui',
        ];

        // Generate PDF menggunakan tampilan 'proposals-pdf'
        $pdf = PDF::loadView('proposal_kegiatan.proposals-pdf', compact('proposals', 'statusLabels'));

        // Unduh file PDF dengan nama 'histori_pengajuan.pdf'
        return $pdf->download('Riwayat Pengajuan Proposal.pdf');
    }
}
