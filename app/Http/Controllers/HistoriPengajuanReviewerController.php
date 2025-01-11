<?php

namespace App\Http\Controllers;

use App\Models\Proposal; // Impor model Proposal
use Illuminate\Http\Request;
use PDF; // Impor DOMPDF facade
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class HistoriPengajuanReviewerController extends Controller
{
    public function index(Request $request)
    {
        try { 
            // Ambil hanya kolom yang diperlukan
            $proposals = Proposal::select(
                'id_proposal',
                'nama_kegiatan',
                'tanggal_mulai',
                'tanggal_akhir',
                'tmpt_kegiatan',
                'created_at',
                'status',
            ) ->get();

            // Kembalikan hasil ke view
            return view('proposal_kegiatan.histori_pengajuan_reviewer', compact('proposals'));
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
            $proposals = Proposal::select(
                'id_proposal', 
                'nama_kegiatan', 
                'tgl_kegiatan', 
                'tmpt_kegiatan', 
                'created_at', 
                'status',
            ) ->get();

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
        } catch (\Exception $e) {
            // Kirim email notifikasi ke developer
            $this->sendErrorNotification($e);

            // Log error untuk debugging
            Log::error('Terjadi error saat menghasilkan PDF: ' . $e->getMessage());

            // Tampilkan pesan error ke pengguna
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh PDF. Tim kami telah diberitahu.');
        }
    }

    private function sendErrorNotification(\Exception $e)
    {
        // Email tujuan developer (gunakan array)
        $developerEmails = explode(',', env('DEVELOPER_EMAILS'));

        // Kirim email notifikasi error
        Mail::to($developerEmails)->send(new ErrorNotification($e));
    }
}
