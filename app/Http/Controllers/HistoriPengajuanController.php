<?php

namespace App\Http\Controllers;

use App\Models\Proposal; // Impor model Proposal
use Illuminate\Http\Request;
use PDF; // Impor DOMPDF facade
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class HistoriPengajuanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $proposals = Proposal::select(
                'id_proposal',
                'nama_kegiatan',
                'tanggal_mulai',
                'tanggal_akhir',
                'tmpt_kegiatan',
                'created_at',
                'status',
            )
                ->whereIn('status', [1, 2])
                ->get();

            return view('proposal_kegiatan.histori_pengajuan', compact('proposals'));
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

    public function downloadPDF()
    {
        try {
            // Ambil data proposal
            $proposals = Proposal::select('id_proposal', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_akhir', 'tmpt_kegiatan', 'created_at', 'status')
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
