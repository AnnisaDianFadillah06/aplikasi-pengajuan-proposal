<?php

namespace App\Http\Controllers;
use App\Models\ReviewLPJ;
use Illuminate\Http\Request;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;

class ReviewController extends Controller
{
    public function index()
    {
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }
    
        // Ambil semua proposal yang sesuai dengan kondisi
        // $proposals = PengajuanProposal::where('updated_by', $sessionId)->get();

        // Ambil semua proposal dengan status_lpj != 1 yang sesuai dengan kondisi
        $proposals = PengajuanProposal::where('updated_by', $sessionId)
                                    ->where('status_lpj', '!=', 1)
                                    ->get();

        // Ambil semua proposal dengan status_lpj = 1
        $lpjs = PengajuanProposal::where('updated_by', $sessionId)
                                ->where('status_lpj', 1)
                                ->get();


        // Ambil revisi terbaru untuk setiap proposal
        $latestRevisions = ReviewProposal::whereIn('id_proposal', $proposals->pluck('id_proposal'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_proposal');
        
        // Ambil revisi terbaru untuk setiap LPJ
        $latestRevisionsLpjs = ReviewLPJ::whereIn('id_proposal', $lpjs->pluck('id_proposal'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_proposal');

        // Gabungkan proposal dengan revisi terakhir
        foreach ($proposals as $proposal) {
            $proposal->latestRevision = $latestRevisions->get($proposal->id_proposal)?->first(); // Ambil revisi terakhir atau null
        }

        // Gabungkan LPJ dengan revisi terakhir
        foreach ($lpjs as $lpj) {
            $lpj->latestRevision = $latestRevisionsLpjs->get($lpj->id_proposal)?->first(); // Ambil revisi terakhir atau null
        }

        // Return ke tampilan
        return view('proposal_kegiatan.tabel_review', [
            'proposals' => $proposals,
            'lpjs' => $lpjs,
            'sessionId' => $sessionId, // Kirim sessionId ke view
        ]);
    }
    
    // Fungsi untuk menampilkan data proposal yang akan direvisi
    public function show($id_proposal)
    {
        // Cari review proposal berdasarkan id_proposal
        $reviewProposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();
        
        // Cari revisi terbaru berdasarkan id_proposal
        // mengambil dokumen revisi terakhir
        $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
                            ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
                            ->orderBy('id_revisi', 'desc')
                            ->first();

        return view('proposal_kegiatan.manajemen_review', compact('reviewProposal','latestRevision'));
    }
    

    // Fungsi untuk menyimpan data revisi ke dalam tabel revisi_file
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input yang diperlukan untuk menyimpan revisi
        $request->validate([
            // 'catatan_revisi' => 'required|string',
            // 'tgl_revisi' => 'required|date',
            // 'id_dosen' => 'required|integer',
            // 'id_proposal' => 'required|integer',
            'status_revisi' => 'required',
        ]);

        // Menyimpan data revisi ke dalam tabel revisi_file
        ReviewProposal::create([
            'catatan_revisi' => $request->input('catatan_revisi'),
            'tgl_revisi' => now()->format('Y-m-d'),
            'id_dosen' => session('id'),
            'id_proposal' => $request->input('id_proposal'),
            'status_revisi' => $request->input('status_revisi'),
        ]);

        // Mengubah status di tabel proposal_pengajuan
        $proposal = PengajuanProposal::find($request->input('id_proposal'));
        if ($proposal) {
            // Cek apakah pengguna yang login memiliki ID = 6 (wd 3) === status disetujui hanya jika sudah sampai di wd3
            if (session()->has('id') && session('id') == 6) {
                // Ubah status proposal sesuai input
                $proposal->status = $request->input('status_revisi');
            }
            
            // Periksa apakah status proposal adalah 1 sebelum menetapkan updated_by
            if ($request->input('status_revisi') == 1 && session()->has('id')) {
                $proposal->updated_by = session('id') + 1 ;
            }
            
            // Simpan perubahan ke database
            $proposal->save();
        }

        // Redirect ke halaman yang sesuai, misalnya halaman daftar proposal
        return redirect()->route('proposal.index')->with('success', 'Revisi berhasil disimpan dan status proposal telah diperbarui.');
    }

}