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
use App\Mail\kirimEmail;
use App\Mail\notifikasiReviewerProposal;
use App\Models\Reviewer;
use Symfony\Component\Mailer\Exception\TransportException;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    public function index()
    {
        // $proposal = PengajuanProposal::find(1);
        // $proposal->nama_kegiatan = 'Kegiatan Bsaru Loh';
        // $proposal->save();  // Pastikan untuk menyimpan perubahan
        
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
    
    public function show($id_proposal)
    {
        // $proposal = LPJ::find(2);
        // $proposal->file_lpj = 'Kegiatan Barffu sssLoh';
        // $proposal->save();  // Pastikan untuk menyimpan perubahan
        // Ambil proposal saat ini berdasarkan id_proposal
        $reviewProposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();

        // Dapatkan ID Ormawa dari proposal saat ini
        $idOrmawa = $reviewProposal->id_ormawa;

        // Cari proposal lain dengan status_spj = 0 untuk ormawa ini
        $pendingSpjProposals = PengajuanProposal::where('id_ormawa', $idOrmawa)
            ->where('status_spj', 0) // Status SPJ belum diajukan
            ->where('status', 1)     // Status proposal aktif/disetujui sudah berjalan tapi belum ada spj
            ->where('id_proposal', '!=', $id_proposal) // Bukan proposal saat ini
            ->get();

        // Jika terdapat proposal lain yang belum menyelesaikan SPJ
        if ($pendingSpjProposals->isNotEmpty()) {
            session()->flash('error', 'Terdapat proposal lain pada ormawa ini yang belum menyelesaikan SPJ. Harap dipertimbangkan untuk menyetujui proposal ini.');
        }

        $fileNameCheck = 'Daftar Periksa.pdf'; // daftar periksa

        // Normalisasi nama bidang ke huruf kecil
        $namaBidang = strtolower($reviewProposal->bidangKegiatan->nama_bidang_kegiatan);

        // Daftar nama bidang yang dianggap sebagai "Proker" maka tampilkan Daftar Periksa
        $validBidang = ['proker', 'program kerja'];

        // Cek apakah nama bidang termasuk dalam daftar valid
        $showChecklist = in_array($namaBidang, $validBidang);

        // Kirim data ke view untuk ditampilkan
        return view('proposal_kegiatan.manajemen_review', [
            'reviewProposal' => $reviewProposal,
            'pendingSpjProposals' => $pendingSpjProposals,
            'fileNameCheck' => $fileNameCheck,
            'showChecklist' => $showChecklist 
        ]);
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
                'tgl_revisi' => now(),
                'id_dosen' => session('id_role'),
                'id_proposal' => $request->input('id_proposal'),
                'status_revisi' => $request->input('status_revisi'),
            ]);

            // Update status proposal
            $proposal = PengajuanProposal::find($request->input('id_proposal'));
            if ($proposal) {
                $pengajuList = $proposal->pengaju;
                foreach ($pengajuList as $pengaju) {
                if ($pengaju && $pengaju->email) {
                    // Format dokumen revisi
                    $revisi_items = $request->input('revisi_items', []);
                    $revisi_items_string = implode("\n", $revisi_items);

                    $data_email = [
                        'subject' => 'Revisi Proposal',
                        'sender_name' => 'Kemahasiswaan Polban',
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
            }

            // Kirim email ke penanggung jawab
            $data_email_penanggung = [
                'subject' => 'Revisi Proposal - Penanggung Jawab',
                'sender_name' => 'Kemahasiswaan Polban',
                'judul' => $proposal->nama_kegiatan,
                'username' => $proposal->nama_penanggung_jawab,
                'revisi_items' => implode("\n", $request->input('revisi_items', [])),
                'isi' => $request->input('catatan_revisi'),
                'route' => 'proposal',
                'status_revisi' => $request->input('status_revisi'),
                'id_role' => session('id_role'),
            ];

            // Kirim email ke penanggung jawab
            Mail::to($proposal->email_penanggung_jawab)->send(new kirimEmail($data_email_penanggung));

            // Ambil data ormawa proposal terkait
            $ormawa = Ormawa::find($proposal->id_ormawa);

            // Nama ormawa yang diambil dari relasi tabel
            $nama_ormawa = $ormawa->nama_ormawa ?? '';
            
                // Update status proposal dan kegiatan
                // if (session()->has('id_role') && session('id_role') == 5) {
                if (session()->has('id_role') && session('id_role') == 5 && $request->input('status_revisi') == 1) {
                    $proposal->status = $request->input('status_revisi');
                    $proposal->status_kegiatan = 2;
                }

                // Update updated_by jika status revisi = 1
                if ($request->input('status_revisi') == 1 && session()->has('id_role')) {
                    // Kondisi khusus untuk Ormawa UKM, BEM, atau MPM
                    if ((str_contains($nama_ormawa, 'UKM') || str_contains($nama_ormawa, 'BEM') || str_contains($nama_ormawa, 'MPM')) && session('id_role') == 2) {
                        $proposal->updated_by = session('id_role') + 2;
                    } else {
                        // Kondisi default untuk Ormawa lainnya
                        $proposal->updated_by = session('id_role') + 1;
                    }
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
                                        ->with(['reviewer']) // Eager loading reviewer dan role
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
        $posterKegiatan = $proposal->poster_kegiatan;
                            
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
            'posterKegiatan' => $posterKegiatan
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
                                        ->with(['reviewer']) // Eager loading reviewer dan role
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
        $filePathSptb = $spj->file_sptb;
        $filePathBeritaAcara = $spj->dokumen_berita_acara;
        $filePathBuktiSpj = $spj->gambar_bukti_spj;
        $filePathVideoKegiatan = $spj->video_kegiatan;
                            
        return view('proposal_kegiatan.detail_spj_wd3', [
            'spj' => $spj,
            'groupedRevisions' => $allRevisions,
            'filePath' => $filePath,
            'filePathSptb' => $filePathSptb,
            'filePathBeritaAcara' => $filePathBeritaAcara,
            'filePathBuktiSpj' => $filePathBuktiSpj,
            'filePathVideoKegiatan' => $filePathVideoKegiatan,
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
                                        ->with(['reviewer']) // Eager loading reviewer dan role
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
        $filePathSPJFinal = $lpj->file_spj;
        $filePathSPTBFinal = $lpj->file_sptb;
                            
        return view('proposal_kegiatan.detail_lpj_wd3', [
            'lpj' => $lpj,
            'groupedRevisions' => $allRevisions,
            'filePath' => $filePath,
            'filePathSPJFinal' => $filePathSPJFinal,
            'fileSPTBFinal' => $filePathSPTBFinal,
            'nama_ormawa' => $nama_ormawa,
            'jenis_kegiatans' => $jenis_kegiatans, 
            'bidang_kegiatans' => $bidang_kegiatans,
        ]);
    }

    public function getReviewerEmail($roleId, $idOrmawa, $checkOrmawa)
    {
        $query = Reviewer::where('id_role', $roleId);
    
        // Jika updated_by adalah 2 atau 3 (pembina atau kajur), tambahkan filter id_ormawa
        if ($checkOrmawa) {
            $query->where('id_ormawa', $idOrmawa);
        }
    
        return $query->pluck('email');
    }
    

    public function sendReviewNotificationProposal($proposal)
    {
        // Cek apakah updated_by adalah 2 atau 3
        $checkOrmawa = in_array($proposal->updated_by, [2, 3]);

        // Ambil email reviewer berdasarkan kondisi
        $reviewerEmails = $this->getReviewerEmail($proposal->updated_by, $proposal->id_ormawa, $checkOrmawa);

        // Siapkan data untuk email
        $data_email = [
            'judul' => $proposal->nama_kegiatan,
        ];

        // Kirim email ke semua reviewer yang sesuai
        foreach ($reviewerEmails as $email) {
            Mail::to($email)->send(new notifikasiReviewerProposal($data_email));
        }
    }

    public function destroy($id_proposal)
    {
        try {
            DB::beginTransaction();
            
            // Cari proposal
            $proposal = PengajuanProposal::findOrFail($id_proposal);
            
            // Hapus SPJ terkait jika ada
            $spj = Spj::where('id_proposal', $id_proposal)->first();
            if ($spj) {
                // Hapus file SPJ jika ada
                if ($spj->file_spj && Storage::exists('uploads/' . $spj->file_spj)) {
                    Storage::delete('uploads/' . $spj->file_spj);
                }
                if ($spj->file_sptb && Storage::exists('uploads/' . $spj->file_sptb)) {
                    Storage::delete('uploads/' . $spj->file_sptb);
                }
                if ($spj->dokumen_berita_acara && Storage::exists('uploads/' . $spj->dokumen_berita_acara)) {
                    Storage::delete('uploads/' . $spj->dokumen_berita_acara);
                }
                if ($spj->gambar_bukti_spj && Storage::exists('uploads/' . $spj->gambar_bukti_spj)) {
                    Storage::delete('uploads/' . $spj->gambar_bukti_spj);
                }
                if ($spj->video_kegiatan && Storage::exists('uploads/' . $spj->video_kegiatan)) {
                    Storage::delete('uploads/' . $spj->video_kegiatan);
                }
                
                // Hapus review SPJ terkait
                ReviewSPJ::where('id_spj', $spj->id_spj)->delete();
                
                // Hapus SPJ
                $spj->delete();
            }

            // Hapus file proposal jika ada
            if ($proposal->file_proposal && Storage::exists('uploads/' . $proposal->file_proposal)) {
                Storage::delete('uploads/' . $proposal->file_proposal);
            }
            if ($proposal->surat_berkegiatan_ketuplak && Storage::exists('uploads/' . $proposal->surat_berkegiatan_ketuplak)) {
                Storage::delete('uploads/' . $proposal->surat_berkegiatan_ketuplak);
            }
            if ($proposal->surat_pernyataan_ormawa && Storage::exists('uploads/' . $proposal->surat_pernyataan_ormawa)) {
                Storage::delete('uploads/' . $proposal->surat_pernyataan_ormawa);
            }
            if ($proposal->surat_peminjaman_sarpras && Storage::exists('uploads/' . $proposal->surat_peminjaman_sarpras)) {
                Storage::delete('uploads/' . $proposal->surat_peminjaman_sarpras);
            }
            if ($proposal->poster_kegiatan && Storage::exists('uploads/' . $proposal->poster_kegiatan)) {
                Storage::delete('uploads/' . $proposal->poster_kegiatan);
            }
            
            // Hapus review proposal terkait
            ReviewProposal::where('id_proposal', $id_proposal)->delete();
            
            // Hapus proposal
            $proposal->delete();

            DB::commit();
            return redirect()->route('proposal.index')->with('success', 'Proposal dan data terkait berhasil dihapus');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('proposal.index')->with('error', 'Gagal menghapus proposal: ' . $e->getMessage());
        }
    }

    public function destroySpj($id_spj)
    {
        try {
            DB::beginTransaction();
            
            // Cari SPJ
            $spj = Spj::findOrFail($id_spj);
            
            // Hapus file SPJ jika ada
            if ($spj->file_spj && Storage::exists('uploads/' . $spj->file_spj)) {
                Storage::delete('uploads/' . $spj->file_spj);
            }
            if ($spj->file_sptb && Storage::exists('uploads/' . $spj->file_sptb)) {
                Storage::delete('uploads/' . $spj->file_sptb);
            }
            if ($spj->dokumen_berita_acara && Storage::exists('uploads/' . $spj->dokumen_berita_acara)) {
                Storage::delete('uploads/' . $spj->dokumen_berita_acara);
            }
            if ($spj->gambar_bukti_spj && Storage::exists('uploads/' . $spj->gambar_bukti_spj)) {
                Storage::delete('uploads/' . $spj->gambar_bukti_spj);
            }
            if ($spj->video_kegiatan && Storage::exists('uploads/' . $spj->video_kegiatan)) {
                Storage::delete('uploads/' . $spj->video_kegiatan);
            }
            
            // Hapus review SPJ terkait
            ReviewSPJ::where('id_spj', $id_spj)->delete();
            
            // Hapus SPJ
            $spj->delete();

            DB::commit();
            return redirect()->route('proposal.index')->with('success', 'SPJ dan data terkait berhasil dihapus');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('proposal.index')->with('error', 'Gagal menghapus SPJ: ' . $e->getMessage());
        }
    }

    public function destroyLpj($id_lpj)
    {
        try {
            DB::beginTransaction();
            
            // Cari LPJ
            $lpj = Lpj::findOrFail($id_lpj);
            
            // Hapus file LPJ jika ada
            if ($lpj->file_lpj && Storage::exists('uploads/' . $lpj->file_lpj)) {
                Storage::delete('uploads/' . $lpj->file_lpj);
            }
            if ($lpj->file_spj && Storage::exists('uploads/' . $lpj->file_spj)) {
                Storage::delete('uploads/' . $lpj->file_spj);
            }
            if ($lpj->file_sptb && Storage::exists('uploads/' . $lpj->file_sptb)) {
                Storage::delete('uploads/' . $lpj->file_sptb);
            }
            
            // Hapus review LPJ terkait
            ReviewLPJ::where('id_lpj', $id_lpj)->delete();
            
            // Hapus LPJ
            $lpj->delete();

            DB::commit();
            return redirect()->route('proposal.index')->with('success', 'LPJ dan data terkait berhasil dihapus');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('proposal.index')->with('error', 'Gagal menghapus LPJ: ' . $e->getMessage());
        }
    }
}