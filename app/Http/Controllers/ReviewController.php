<?php

namespace App\Http\Controllers;
use App\Models\LPJ;
use App\Models\Spj;
use App\Models\Ormawa;
use App\Models\Pengguna;
use App\Models\ReviewLPJ;
use App\Models\ReviewSPJ;
use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\BidangKegiatan;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace


class ReviewController extends Controller
{
    public function index()
    {
        // Ambil ID dari sesi
        $sessionId = session('id_role');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil semua proposal
        $idRole = session('id_role');

        $proposals = PengajuanProposal::query();
        if ($idRole == 5) {
            // Ambil semua proposal tanpa filter
            $proposals = $proposals->get();
        } else {
            // Filter berdasarkan updated_by dan id_ormawa
            $proposals = $proposals->where('updated_by', $sessionId);
            if ($idRole == 2 || $idRole == 3) {
                $proposals = $proposals->where('id_ormawa', session('id_ormawa'));
            }
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
        $spjAll = SPJ::query();
        if ($idRole == 5) {
            // Ambil semua SPJ tanpa filter
            $spjAll = $spjAll->get();
        } else {
            // Filter berdasarkan updated_by dan id_ormawa
            $spjAll = $spjAll->where('updated_by', $sessionId);
            if ($idRole == 2 || $idRole == 3) {
                $spjAll = $spjAll->where('id_ormawa', session('id_ormawa'));
            }
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
        $lpjAll = LPJ::query();
        if ($idRole == 5) {
            // Ambil semua LPJ tanpa filter
            $lpjAll = $lpjAll->get();
        } else {
            // Filter berdasarkan updated_by dan id_ormawa
            $lpjAll = $lpjAll->where('updated_by', $sessionId);
            if ($idRole == 2 || $idRole == 3) {
                $lpjAll = $lpjAll->where('id_ormawa', session('id_ormawa'));
            }
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
        return view('proposal_kegiatan.tabel_review', [
            'proposals' => $proposals,
            'spjAll' => $spjAll,
            'lpjAll' => $lpjAll,
            'sessionId' => $sessionId, 
            'idRole' => $idRole// Kirim sessionId ke view
        ]);
    }
    
    // Fungsi untuk menampilkan data proposal yang akan direvisi
    public function show($id_proposal)
    {
        // Cari review proposal berdasarkan id_proposal
        $reviewProposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();
        
        // Cari revisi terbaru berdasarkan id_proposal
        // mengambil dokumen revisi terakhir
        // $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
        //                     ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
        //                     ->orderBy('id_revisi', 'desc')
        //                     ->first();

        return view('proposal_kegiatan.manajemen_review', compact('reviewProposal'));
    }

    // Fungsi untuk menampilkan data proposal yang akan direvisi ANGEL
    public function historiReview($id_proposal)
    {
        // Cari review proposal berdasarkan id_proposal
        $proposal = PengajuanProposal::with('revisions.dosen')->findOrFail($id_proposal);
        return view('proposal_kegiatan.histori_review', compact('proposal'));
    }
    

    // Fungsi untuk menyimpan data revisi ke dalam tabel revisi_file
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'status_revisi' => 'required',
        ]);
    
        // Simpan data revisi ke dalam tabel revisi_file
        ReviewProposal::create([
            'catatan_revisi' => $request->input('catatan_revisi'),
            'tgl_revisi' => now()->format('Y-m-d'),
            'id_dosen' => session('id_role'), //yang disimpan itu role id role (bem, wd3, dst) bukan id_reviewernya
            'id_proposal' => $request->input('id_proposal'),
            'status_revisi' => $request->input('status_revisi'),
        ]);
    
        // Update status proposal
        $proposal = PengajuanProposal::find($request->input('id_proposal'));
        if ($proposal) {
            // Kirim notifikasi email
            $pengaju = $proposal->pengguna; // Ambil data pengguna terkait proposal
            if ($pengaju && $pengaju->email) {
                // Format dokumen yang harus direvisi menjadi string dengan pemisah newline
                $revisi_items = $request->input('revisi_items', []);
                $revisi_items_string = implode("\n", $revisi_items);
    
                $data_email = [
                    'subject' => 'Revisi Proposal',
                    'sender_name' => 'proposalkupolban@gmail.com',
                    'judul' => $proposal->nama_kegiatan,
                    'username' => $pengaju->username,
                    'revisi_items' => $revisi_items_string,
                    'isi' => $request->input('catatan_revisi'),
                ];
    
                Mail::to($pengaju->email)->send(new kirimEmail($data_email));
            }
    
            // Update status proposal dan kegiatan
            if (session()->has('id_role') && session('id_role') == 5) {
                $proposal->status = $request->input('status_revisi');
                $proposal->status_kegiatan = 2;
            }
    
            // Update updated_by jika status revisi = 1
            if ($request->input('status_revisi') == 1 && session()->has('id')) {
                $proposal->updated_by = session('id_role') + 1;
            }
    
            $proposal->save();
        }
    
        return redirect('/manajemen-review')
            ->with('success', 'Revisi berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');
    }
    
    public function pantauProposal(Request $request, $id_proposal)
    {
        // Cek apakah proposal ditemukan
        $proposal = PengajuanProposal::findOrFail($id_proposal);
        $jenis_kegiatans = JenisKegiatan::all();
        $bidang_kegiatans = BidangKegiatan::all();

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }


        // Ambil data revisi terbaru terkait proposal ini (semua revisi)
        $allRevisions = ReviewProposal::where('id_proposal', $proposal->id_proposal)
                                        ->select(
                                            'id_dosen',
                                            'catatan_revisi',
                                            'tgl_revisi'
                                        )
                                        ->orderBy('id_dosen') // Urutkan berdasarkan id_dosen
                                        ->orderBy('tgl_revisi', 'desc') // Revisi terbaru di atas
                                        ->get()
                                        ->groupBy('id_dosen'); // Grup berdasarkan id_dosen

        // Ambil data reviewer dan ormawa terkait
        $ormawa = Ormawa::find($proposal->id_ormawa);

        // Nama ormawa yang diambil dari relasi tabel
        $nama_ormawa = $ormawa->nama_ormawa ?? '';

        // File proposal
        $filePath = $proposal->file_proposal;

        // Surat Berkegiatan Ketuplak
        $fileKetuplakPath = $proposal->surat_berkegiatan_ketuplak;

        // Surat Pernyataan Ormawa
        $fileOrmawaPath = $proposal->surat_pernyataan_ormawa;

        // Surat Peminjaman Sarpras
        $fileSarprasPath = $proposal->surat_peminjaman_sarpras;
                            
        return view('proposal_kegiatan.detail_proposal_wd3', [
            'proposal' => $proposal,
            'groupedRevisions' => $allRevisions,
            'filePath' => $filePath,
            'nama_ormawa' => $nama_ormawa,
            'fileKetuplakPath' => $fileKetuplakPath,
            'fileOrmawaPath' => $fileOrmawaPath,
            'fileSarprasPath' => $fileSarprasPath,
            'jenis_kegiatans' => $jenis_kegiatans, 
            'bidang_kegiatans' => $bidang_kegiatans,
        ]);
    }

}