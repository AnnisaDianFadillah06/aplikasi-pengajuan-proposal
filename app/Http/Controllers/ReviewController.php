<?php

namespace App\Http\Controllers;
use App\Models\PengajuanProposal;
use App\Models\ReviewProposal;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace
use App\Models\ReviewLPJ;
use App\Models\LPJ;
use App\Models\SPJ;
use Illuminate\Support\Facades\DB;


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
    
        // Ambil semua proposal yang sesuai dengan kondisi
        // $proposals = PengajuanProposal::where('updated_by', $sessionId)->get();

        // Ambil semua proposal dengan status_lpj != 1 yang sesuai dengan kondisi
        $idRole = session('id_role');

        $proposals = PengajuanProposal::where('updated_by', $sessionId)
                                        ->where('status_lpj', '!=', 1);

        if ($idRole == 2 || $idRole == 3) {
            $proposals = $proposals->where('id_ormawa', session('id_ormawa'));
        }

        $proposals = $proposals->get();


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


        // Mendapatkan semua data lpj dan spj dari database
        $spjAll = Spj::all();
        $lpjAll = DB::table('lpj')
            ->join('proposal_kegiatan', 'lpj.id_proposal', '=', 'proposal_kegiatan.id_proposal')
            ->join('pengaju', 'proposal_kegiatan.id_pengguna', '=', 'pengaju.id')
            ->select(
                'lpj.*', // Ambil semua kolom dari tabel `lpj`
                'proposal_kegiatan.nama_kegiatan', // Contoh kolom dari `proposal`
                'proposal_kegiatan.tanggal_mulai',
                'pengaju.username', // Kolom nama pengguna dari `pengguna`

            )
            ->get();

        // Return ke tampilan
        return view('proposal_kegiatan.tabel_review', [
            'proposals' => $proposals,
            'lpjs' => $lpjs,
            'spjAll' => $spjAll,
            'lpjAll' => $lpjAll,
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

    // Fungsi untuk menampilkan data proposal yang akan direvisi
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
            'id_dosen' => session('id_role'),
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
    

}