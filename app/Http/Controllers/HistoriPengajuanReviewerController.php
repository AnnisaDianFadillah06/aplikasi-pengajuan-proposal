<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use App\Models\LPJ;
use App\Models\ReviewLPJ;
use App\Models\ReviewSPJ;
use Illuminate\Http\Request;
use App\Models\ReviewProposal;
use PDF; // Impor DOMPDF facade
use App\Models\PengajuanProposal;
use App\Models\Proposal; // Impor model Proposal

class HistoriPengajuanReviewerController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID dari sesi
        $sessionId = session('id_role');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil semua proposal
        $idRole = session('id_role');

        $proposals = PengajuanProposal::query()
            ->whereIn('status', [1, 2]); // Filter berdasarkan status 1 atau 2
            
        if ($idRole == 2 || $idRole == 3) {
            // Filter khusus untuk id_role 2 dan 3 berdasarkan id_ormawa
            $proposals = $proposals->where('id_ormawa', session('id_ormawa'))->get();
        } else {
            // Ambil semua proposal tanpa filter tambahan untuk peran lainnya
            $proposals = $proposals->get();
        }

        // Ambil revisi terbaru untuk setiap proposal
        $latestRevisions = ReviewProposal::whereIn('id_proposal', $proposals->pluck('id_proposal'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_proposal');
        
        // Gabungkan proposal dengan revisi terakhir
        foreach ($proposals as $proposal) {
            $proposal->latestRevision = $latestRevisions->get($proposal->id_proposal)?->first(); // Ambil revisi terakhir atau null
        }

        // Ambil semua SPJ ========
        $spjAll = Spj::with([
            'proposalKegiatan.pengguna'       // Relasi ke `pengguna` melalui `proposal`
        ])->whereIn('status', [1, 2]);

        if ($idRole == 2 || $idRole == 3) {
            // Filter khusus untuk id_role 2 dan 3
            $spjAll = $spjAll->whereHas('proposalKegiatan', function ($query) {
                $query->where('id_ormawa', session('id_ormawa'));
            })->get();
        } else {
            // Ambil semua SPJ tanpa filter tambahan untuk peran lainnya
            $spjAll = $spjAll->get();
        }

        // Ambil revisi terbaru untuk setiap spj
        $latestRevisionsSpj = ReviewSPJ::whereIn('id_spj', $spjAll->pluck('id_spj'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_spj');

        // Gabungkan spj dengan revisi terakhir
        foreach ($spjAll as $spj) {
            $spj->latestRevision = $latestRevisionsSpj->get($spj->id_spj)?->first(); // Ambil revisi terakhir atau null
        }

        // Ambil semua LPJ ========
        $lpjAll = LPJ::with(['ormawa'])
            ->whereIn('status_lpj', [1, 2]); 

        if ($idRole == 2 || $idRole == 3) {
            // Filter khusus untuk id_role 2 dan 3
            $lpjAll = $lpjAll->where('id_ormawa', session('id_ormawa'))->get();
        } else {
            // Ambil semua LPJ tanpa filter tambahan untuk peran lainnya
            $lpjAll = $lpjAll->get();
        }

        // Ambil revisi terbaru untuk setiap spj
        $latestRevisionsLpj = ReviewLPJ::whereIn('id_lpj', $lpjAll->pluck('id_lpj'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_lpj');

        // Gabungkan lpj dengan revisi terakhir
        foreach ($lpjAll as $lpj) {
            $lpj->latestRevision = $latestRevisionsLpj->get($lpj->id_lpj)?->first(); // Ambil revisi terakhir atau null
        }

        // Return ke tampilan
        return view('proposal_kegiatan.histori_pengajuan_reviewer', [
            'proposals' => $proposals,
            'spjAll' => $spjAll,
            'lpjAll' => $lpjAll,
            'sessionId' => $sessionId, 
            'idRole' => $idRole// Kirim sessionId ke view
        ]);
    }

    public function downloadPDF()
    {
        // Ambil ID dari sesi
        $sessionId = session('id_role');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil semua proposal
        $idRole = session('id_role');

        $proposals = PengajuanProposal::query()
            ->whereIn('status', [1, 2]); // Filter berdasarkan status 1 atau 2
            
        if ($idRole == 2 || $idRole == 3) {
            // Filter khusus untuk id_role 2 dan 3 berdasarkan id_ormawa
            $proposals = $proposals->where('id_ormawa', session('id_ormawa'))->get();
        } else {
            // Ambil semua proposal tanpa filter tambahan untuk peran lainnya
            $proposals = $proposals->get();
        }

        // Ambil revisi terbaru untuk setiap proposal
        $latestRevisions = ReviewProposal::whereIn('id_proposal', $proposals->pluck('id_proposal'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_proposal');
        
        // Gabungkan proposal dengan revisi terakhir
        foreach ($proposals as $proposal) {
            $proposal->latestRevision = $latestRevisions->get($proposal->id_proposal)?->first(); // Ambil revisi terakhir atau null
        }

        // Ambil semua SPJ ========
        $spjAll = Spj::with([
            'proposalKegiatan.pengguna'       // Relasi ke `pengguna` melalui `proposal`
        ])->whereIn('status', [1, 2]);

        if ($idRole == 2 || $idRole == 3) {
            // Filter khusus untuk id_role 2 dan 3
            $spjAll = $spjAll->whereHas('proposalKegiatan', function ($query) {
                $query->where('id_ormawa', session('id_ormawa'));
            })->get();
        } else {
            // Ambil semua SPJ tanpa filter tambahan untuk peran lainnya
            $spjAll = $spjAll->get();
        }

        // Ambil revisi terbaru untuk setiap spj
        $latestRevisionsSpj = ReviewSPJ::whereIn('id_spj', $spjAll->pluck('id_spj'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_spj');

        // Gabungkan spj dengan revisi terakhir
        foreach ($spjAll as $spj) {
            $spj->latestRevision = $latestRevisionsSpj->get($spj->id_spj)?->first(); // Ambil revisi terakhir atau null
        }

        // Ambil semua LPJ ========
        $lpjAll = LPJ::with(['ormawa'])
            ->whereIn('status_lpj', [1, 2]); 

        if ($idRole == 2 || $idRole == 3) {
            // Filter khusus untuk id_role 2 dan 3
            $lpjAll = $lpjAll->where('id_ormawa', session('id_ormawa'))->get();
        } else {
            // Ambil semua LPJ tanpa filter tambahan untuk peran lainnya
            $lpjAll = $lpjAll->get();
        }

        // Ambil revisi terbaru untuk setiap spj
        $latestRevisionsLpj = ReviewLPJ::whereIn('id_lpj', $lpjAll->pluck('id_lpj'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_lpj');

        // Gabungkan lpj dengan revisi terakhir
        foreach ($lpjAll as $lpj) {
            $lpj->latestRevision = $latestRevisionsLpj->get($lpj->id_lpj)?->first(); // Ambil revisi terakhir atau null
        }

        $statusLabels = [
            1 => 'Disetujui',
            2 => 'Ditolak',
        ];
        
        
        // Generate PDF menggunakan tampilan 'proposals-pdf'
        $pdf = PDF::loadView('proposal_kegiatan.histori_reviewer_pdf', [
            'proposals' => $proposals,
            'spjAll' => $spjAll,
            'lpjAll' => $lpjAll,
            'sessionId' => $sessionId, 
            'idRole' => $idRole, 
            'statusLabels' => $statusLabels // Pastikan 'statusLabels' juga dikirim
        ]);

        // Unduh file PDF dengan nama 'Riwayat Pengajuan Proposal.pdf'
        return $pdf->download('Riwayat Pengajuan Proposal.pdf');
    }
}
