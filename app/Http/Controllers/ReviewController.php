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
use Symfony\Component\Mailer\Exception\TransportException;


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
        $spjAll = Spj::with([
            'proposalKegiatan.pengguna'       // Relasi ke `pengguna` melalui `proposal`
        ]);
        if ($idRole == 5) {
            // Ambil semua SPJ tanpa filter
            $spjAll = $spjAll->get();
        } else {
            // Filter berdasarkan updated_by dan id_ormawa
            $spjAll = $spjAll->where('updated_by', $sessionId);
            if ($idRole == 2 || $idRole == 3) {
                // Filter berdasarkan id_ormawa melalui relasi proposalKegiatan
                $spjAll = $spjAll->whereHas('proposalKegiatan', function ($query) {
                    $query->where('id_ormawa', session('id_ormawa'));
                });
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
        $lpjAll = LPJ::with([
            'ormawa'
        ]);
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
    

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'status_revisi' => 'required',
            ]);

            // Mulai transaksi database
            DB::beginTransaction();

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
                $pengaju = $proposal->pengguna;
                if ($pengaju && $pengaju->email) {
                    // Format dokumen revisi
                    $revisi_items = $request->input('revisi_items', []);
                    $revisi_items_string = implode("\n", $revisi_items);

                    $data_email = [
                        'subject' => 'Revisi Proposal',
                        'sender_name' => 'proposalkupolban@gmail.com',
                        'judul' => $proposal->nama_kegiatan,
                        'username' => $pengaju->username,
                        'revisi_items' => $revisi_items_string,
                        'isi' => $request->input('catatan_revisi'),
                        'route' => 'proposal',
                        'status_revisi' => $request->input('status_revisi'),
                        'id_role' => session('id_role'),
                    ];

                    // Kirim email
                    Mail::to($pengaju->email)->send(new kirimEmail($data_email));
                }

                // Update status proposal dan kegiatan
                // if (session()->has('id_role') && session('id_role') == 5) {
                if (session()->has('id_role') && session('id_role') == 5 && $request->input('status_revisi') == 1) {
                    $proposal->status = $request->input('status_revisi');
                    $proposal->status_kegiatan = 2;
                }

                // Update updated_by jika status revisi = 1
                if ($request->input('status_revisi') == 1 && session()->has('id_role')) {
                    $proposal->updated_by = session('id_role') + 1;
                }

                $proposal->save();
            }

            // Commit transaksi jika semuanya sukses
            DB::commit();

            return redirect('/manajemen-review')
                ->with('success', 'Revisi berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');
        } catch (TransportException $e) {
            // Rollback transaksi jika pengiriman email gagal
            DB::rollBack();

            return redirect('/manajemen-review')
                ->with('error', 'Email gagal dikirim. Data revisi tidak disimpan. Periksa koneksi jaringan Anda.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error lain
            DB::rollBack();

            return redirect('/manajemen-review')
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
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
                                        ->with(['reviewer.role']) // Eager loading reviewer dan role
                                        ->select(
                                            'id_dosen',
                                            'catatan_revisi',
                                            'tgl_revisi',
                                            'status_revisi' 
                                        )
                                        ->orderBy('id_dosen') // Urutkan berdasarkan id_dosen
                                        ->orderBy('tgl_revisi', 'desc') // Revisi terbaru di atas
                                        ->get()
                                        ->map(function ($revision) {
                                            // Tambahkan label status
                                            $statusLabels = [
                                                0 => 'Menunggu',
                                                1 => 'Disetujui',
                                                2 => 'Ditolak',
                                                3 => 'Revisi',
                                            ];
                                            $revision->status_label = $statusLabels[$revision->status_revisi] ?? 'Tidak Diketahui';
                                            return $revision;
                                        })
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

    public function pantauSPJ(Request $request, $id_spj)
    {
        // Cek apakah proposal ditemukan
        $spj = SPJ::findOrFail($id_spj);
        $jenis_kegiatans = JenisKegiatan::all();
        $bidang_kegiatans = BidangKegiatan::all();

        if (!$spj) {
            abort(404, 'spj tidak ditemukan');
        }

        // Ambil data revisi terbaru terkait spj ini (semua revisi)
        $allRevisions = ReviewSPJ::where('id_spj', $spj->id_spj)
                                        ->with(['reviewer.role']) // Eager loading reviewer dan role
                                        ->select(
                                            'id_dosen',
                                            'catatan_revisi',
                                            'tgl_revisi',
                                            'status_revisi' 
                                        )
                                        ->orderBy('id_dosen') // Urutkan berdasarkan id_dosen
                                        ->orderBy('tgl_revisi', 'desc') // Revisi terbaru di atas
                                        ->get()
                                        ->map(function ($revision) {
                                            // Tambahkan label status
                                            $statusLabels = [
                                                0 => 'Menunggu',
                                                1 => 'Disetujui',
                                                2 => 'Ditolak',
                                                3 => 'Revisi',
                                            ];
                                            $revision->status_label = $statusLabels[$revision->status_revisi] ?? 'Tidak Diketahui';
                                            return $revision;
                                        })
                                        ->groupBy('id_dosen'); // Grup berdasarkan id_dosen
                                        

        // Ambil data ormawa terkait melalui relasi proposalKegiatan
        $id_ormawa = $spj->proposalKegiatan->id_ormawa ?? null;

        // Pastikan id_ormawa ditemukan sebelum mencoba mengambil data Ormawa
        if ($id_ormawa) {
            $ormawa = Ormawa::find($id_ormawa);
            $nama_ormawa = $ormawa->nama_ormawa ?? 'Nama Ormawa Tidak Ditemukan';
        } else {
            $nama_ormawa = 'Nama Ormawa Tidak Ditemukan';
        }

        // File spj
        $filePath = $spj->file_spj;
                            
        return view('proposal_kegiatan.detail_spj_wd3', [
            'spj' => $spj,
            'groupedRevisions' => $allRevisions,
            'filePath' => $filePath,
            'nama_ormawa' => $nama_ormawa,
            'jenis_kegiatans' => $jenis_kegiatans, 
            'bidang_kegiatans' => $bidang_kegiatans,
        ]);
    }

    public function pantauLPJ(Request $request, $id_lpj)
    {
        // Cek apakah proposal ditemukan
        $lpj = LPJ::findOrFail($id_lpj);
        $jenis_kegiatans = JenisKegiatan::all();
        $bidang_kegiatans = BidangKegiatan::all();

        if (!$lpj) {
            abort(404, 'lpj tidak ditemukan');
        }

        // Ambil data revisi terbaru terkait lpj ini (semua revisi)
        $allRevisions = ReviewLPJ::where('id_lpj', $lpj->id_lpj)
                                        ->with(['reviewer.role']) // Eager loading reviewer dan role
                                        ->select(
                                            'id_dosen',
                                            'catatan_revisi',
                                            'tgl_revisi',
                                            'status_revisi' 
                                        )
                                        ->orderBy('id_dosen') // Urutkan berdasarkan id_dosen
                                        ->orderBy('tgl_revisi', 'desc') // Revisi terbaru di atas
                                        ->get()
                                        ->map(function ($revision) {
                                            // Tambahkan label status
                                            $statusLabels = [
                                                0 => 'Menunggu',
                                                1 => 'Disetujui',
                                                2 => 'Ditolak',
                                                3 => 'Revisi',
                                            ];
                                            $revision->status_label = $statusLabels[$revision->status_revisi] ?? 'Tidak Diketahui';
                                            return $revision;
                                        })
                                        ->groupBy('id_dosen'); // Grup berdasarkan id_dosen

        // Ambil data reviewer dan ormawa terkait
        $ormawa = Ormawa::find($lpj->id_ormawa);

        // Nama ormawa yang diambil dari relasi tabel
        $nama_ormawa = $ormawa->nama_ormawa ?? '';

        // File lpj
        $filePath = $lpj->file_lpj;
                            
        return view('proposal_kegiatan.detail_lpj_wd3', [
            'lpj' => $lpj,
            'groupedRevisions' => $allRevisions,
            'filePath' => $filePath,
            'nama_ormawa' => $nama_ormawa,
            'jenis_kegiatans' => $jenis_kegiatans, 
            'bidang_kegiatans' => $bidang_kegiatans,
        ]);
    }

}