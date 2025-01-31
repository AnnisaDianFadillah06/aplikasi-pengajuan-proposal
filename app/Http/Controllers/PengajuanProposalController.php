<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Ormawa;


use App\Models\Reviewer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\ProposalToken;
use App\Models\BidangKegiatan;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanProposalController extends Controller
{
    public function index()
    {
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil semua proposal pengguna
        $proposals = PengajuanProposal::where('id_pengguna', $sessionId)->get();

        // Ambil semua revisi terbaru untuk setiap proposal
        $latestReviews = ReviewProposal::whereIn('id_proposal', $proposals->pluck('id_proposal'))
            ->orderBy('id_proposal')
            ->orderBy('id_revisi', 'desc')
            ->get()
            ->groupBy('id_proposal')
            ->map(function ($revisions) {
                return $revisions->first(); // Ambil revisi terbaru dari setiap proposal
            });

        return view('proposal_kegiatan.pengajuan_proposal', [
            'proposals' => $proposals,
            'latestReviews' => $latestReviews
        ]);
    }


    public function show(Request $request, $id_proposal)
    {
        // Cek apakah proposal ditemukan
        $proposal = PengajuanProposal::findOrFail($id_proposal);
        $jenis_kegiatans = JenisKegiatan::all();
        $bidang_kegiatans = BidangKegiatan::all();

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }

        // Ambil id_ormawa dari proposal saat ini
        $idOrmawa = $proposal->id_ormawa;

        // Periksa apakah ada proposal lain dari Ormawa yang sama dengan status_spj belum diajukan
        $pendingSpjProposals = PengajuanProposal::where('id_ormawa', $idOrmawa)
            ->where('status_spj', 0) //  status 0 berarti belum diajukan
            ->where('status', 1) 
            ->where('id_proposal', '!=', $id_proposal) // Pastikan bukan proposal saat ini
            ->get(); // Ambil data proposal yang sesuai kondisi

        // Cek apakah ada proposal dengan status_spj belum diajukan
        $hasPendingSpj = $pendingSpjProposals->isNotEmpty();

        // =====================================================================
        // mengambil review terakhir untuk mengambil proposal sedang di tahap mana
        $latestReview = ReviewProposal::where('id_proposal', $proposal->id_proposal)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();
        
        // assign var updatedByStep sesuai kondisi status pada tabel revisi file
        if ($latestReview) {
            // $updatedByStep = $latestReview->status_revisi == 1 
            //     ? $latestReview->id_dosen + 1 
            //     : $latestReview->id_dosen;

            $status = $latestReview->status_revisi == 1 
                ? 0 
                : $latestReview->status_revisi;
        } else {
            // $updatedByStep = 1;
            $status = $proposal->status;
        }

        $updatedByStep = $proposal->updated_by;
        $status_lpj = $proposal->status_lpj;
        
        // Periksa jika ini adalah akses pertama kali
        $isFirstAccess = $request->input('is_first_access', false); // default false jika tidak ada
        
        if ($isFirstAccess) {
            // Lakukan sesuatu jika ini adalah akses pertama kali
            $currentStep = 1;
            session()->put('currentStep', 1);
        } else {
            // $currentStep = session()->get('currentStep', 1);
            $currentStep = session()->get('currentStep', 1);
        }
        // =====================================================================

        // Ambil data revisi terbaru terkait proposal ini (current step)
        $allRevision = ReviewProposal::where('id_proposal', $proposal->id_proposal)
                                        ->where('id_dosen', $currentStep) // Filter berdasarkan currentStep
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
        
        // poster
        $filePosterPath = $proposal->poster_kegiatan;
        
        return view('proposal_kegiatan.detail_proposal', [
            'proposal' => $proposal,
            'currentStep' => $currentStep,
            'updatedByStep' => $updatedByStep,
            'status' => $status,
            'status_lpj' => $status_lpj,
            'latestRevision' => $latestReview, // Ganti nama untuk view
            'groupedRevisions' => $allRevision,
            'filePath' => $filePath,
            'nama_ormawa' => $nama_ormawa,
            'fileKetuplakPath' => $fileKetuplakPath,
            'fileOrmawaPath' => $fileOrmawaPath,
            'fileSarprasPath' => $fileSarprasPath,
            'filePosterPath' => $filePosterPath,
            'jenis_kegiatans' => $jenis_kegiatans, 
            'bidang_kegiatans' => $bidang_kegiatans,
            'hasPendingSpj' => $hasPendingSpj, // Variabel notifikasi
            'pendingSpjProposals' => $pendingSpjProposals,
        ]);
    }

    public function nextStep(Request $request, $id)
    {
        $proposal = PengajuanProposal::findOrFail($id);
        $currentStep = session()->get('currentStep', 1);
        $ormawa = Ormawa::find($proposal->id_ormawa);
        // Nama ormawa yang diambil dari relasi tabel
        $ormawa = $ormawa->nama_ormawa ?? '';

        //untuk mengetahui proposal sedang di tahap mana (menentukan updatedbystep)
        $latestReview = ReviewProposal::where('id_proposal', $proposal->id_proposal)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();
        if ($latestReview) {
            $updatedByStep = $latestReview->status_revisi == 1 
                ? $latestReview->id_dosen + 1 
                : $latestReview->id_dosen;

        } else {
            $updatedByStep = $proposal->updated_by;
        }

        // Kondisi khusus untuk Ormawa yang bukan UKM, BEM, atau MPM
        if (str_contains($ormawa, 'UKM') || str_contains($ormawa, 'BEM') || str_contains($ormawa, 'MPM')) {
            // Jika currentStep adalah 2, tambah 2
            if ($currentStep == 2) {
                session()->put('currentStep', $currentStep + 2);
            } elseif ($currentStep <= $updatedByStep) {
                session()->put('currentStep', $currentStep + 1);
            } elseif ($currentStep == 5) {
                $currentStep = 1;
            }
        } else {
            // Perilaku default untuk ormawa lain
            
            if ($currentStep <= $updatedByStep) {
                session()->put('currentStep', $currentStep + 1);
            } elseif ($currentStep == 5) {
                $currentStep = 1;
            }
        }

            return redirect()->route('proposal.detail', $id);
    }

    public function prevStep(Request $request, $id)
    {
        $proposal = PengajuanProposal::findOrFail($id);
        $ormawa = Ormawa::find($proposal->id_ormawa);
        // Nama ormawa yang diambil dari relasi tabel
        $ormawa = $ormawa->nama_ormawa ?? '';
        
        // Periksa jika ini adalah akses pertama kali
        $isFirstAccess = $request->input('is_first_access', false); // default false jika tidak ada
        
        if ($isFirstAccess) {
            // Lakukan sesuatu jika ini adalah akses pertama kali
            $currentStep = 7;
        } else {
            $currentStep = session()->get('currentStep', 1);
        }

        // Kondisi khusus untuk Ormawa yang bukan UKM, BEM, atau MPM
        if (str_contains($ormawa, 'UKM') || str_contains($ormawa, 'BEM') || str_contains($ormawa, 'MPM')) {
            // Jika currentStep adalah 5, kurangi 2
            if ($currentStep == 4) {
                session()->put('currentStep', $currentStep - 2);
            } elseif ($currentStep >= 1) {
                session()->put('currentStep', $currentStep - 1);
            }
        } else {
            // Perilaku default untuk ormawa lain
            if ($currentStep >= 1) {
                session()->put('currentStep', $currentStep - 1);
            } elseif ($currentStep == 0) {
                $currentStep == 6;
            }
        }


        return redirect()->route('proposal.detail', $id);
    }


    public function update(Request $request, $id_proposal)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'id_jenis_kegiatan' => 'required',
            'id_bidang_kegiatan' => 'required',
            'id_ormawa' => 'nullable',
            'file_proposal' => 'nullable|file|mimes:pdf|max:2048',
            'surat_berkegiatan_ketuplak' => 'nullable|file|mimes:pdf|max:2048',
            'surat_pernyataan_ormawa' => 'nullable|file|mimes:pdf|max:2048',
            'surat_peminjaman_sarpras' => 'nullable|file|mimes:pdf|max:2048',
            'tanggal_mulai' => 'required','date',
            'tanggal_akhir' => 'required|date',
            'dana_dipa' => 'nullable|numeric|min:0',
            'dana_swadaya' => 'nullable|numeric|min:0',
            'dana_sponsor' => 'nullable|numeric|min:0',
            'pengisi_acara' => 'nullable|string|max:255',
            'sponsorship' => 'nullable|string|max:255',
            'media_partner' => 'nullable|string|max:255',
            'jumlah_spj' => 'required|numeric|min:0',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'email_penanggung_jawab' => 'required|email|max:255',
            'no_hp_penanggung_jawab' => 'required|string|max:15',
            'poster_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'caption_poster' => 'nullable|string|max:1000',
            'jml_peserta' => 'required|integer|min:0',
            'jml_panitia' => 'required|integer|min:0',
            'link_surat_izin_ortu' => 'required|url|max:255',
        ]);

        $proposal = PengajuanProposal::find($id_proposal);

        if (!$proposal) {
            return redirect()->back()->withErrors(['error' => 'Proposal tidak ditemukan.']);
        }

        // Direktori untuk menyimpan file
        $folderPath = 'uploads/';
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath); // Membuat folder jika belum ada
        }

        // Update dan simpan file proposal
        if ($request->hasFile('file_proposal')) {
            $file = $request->file('file_proposal');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName); // Simpan file ke storage
            $proposal->file_proposal = $newFileName; // Simpan nama file ke database
        }

        // Update dan simpan surat berkegiatan ketuplak
        if ($request->hasFile('surat_berkegiatan_ketuplak')) {
            $file = $request->file('surat_berkegiatan_ketuplak');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName);
            $proposal->surat_berkegiatan_ketuplak = $newFileName;
        }

        // Update dan simpan surat pernyataan ormawa
        if ($request->hasFile('surat_pernyataan_ormawa')) {
            $file = $request->file('surat_pernyataan_ormawa');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName);
            $proposal->surat_pernyataan_ormawa = $newFileName;
        }

        // Update dan simpan surat peminjaman sarpras
        if ($request->hasFile('surat_peminjaman_sarpras')) {
            $file = $request->file('surat_peminjaman_sarpras');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName);
            $proposal->surat_peminjaman_sarpras = $newFileName;
        }

        // Update dan simpan poster kegiatan
        if ($request->hasFile('poster_kegiatan')) {
            $poster = $request->file('poster_kegiatan');
            $newFileName = time() . '_' . $poster->getClientOriginalName();
            $poster->storeAs($folderPath, $newFileName);
            $proposal->poster_kegiatan = $newFileName;
        }

        if ($request->hasFile('file_proposal')) {
            session()->flash('file_proposal_name', $request->file('file_proposal')->getClientOriginalName());
        }

        // Cari revisi terbaru berdasarkan id_proposal
        $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();

        // Pastikan latestRevision ada
        if (!$latestRevision) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada revisi yang ditemukan untuk proposal ini.']);
        }

        // Update status_revisi pada ReviewProposal menjadi 0
        $latestRevision->update(['status_revisi' => 0]);

        if ($proposal) {
            $proposal->fill([
                'nama_kegiatan' => $request->input('nama_kegiatan'),
                'tmpt_kegiatan' => $request->input('tempat_kegiatan'),
                'id_jenis_kegiatan' => $request->input('id_jenis_kegiatan'),
                'id_bidang_kegiatan' => $request->input('id_bidang_kegiatan'),
                'id_ormawa' => session('id_ormawa'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_akhir' => $request->input('tanggal_akhir'),
                'dana_dipa' => $request->input('dana_dipa', 0),
                'dana_swadaya' => $request->input('dana_swadaya', 0),
                'dana_sponsor' => $request->input('dana_sponsor', 0),
                'pengisi_acara' => $request->input('pengisi_acara'),
                'sponsorship' => $request->input('sponsorship'),
                'media_partner' => $request->input('media_partner'),
                'jumlah_spj' => $request->input('jumlah_spj', 1),
                'nama_penanggung_jawab' => $request->input('nama_penanggung_jawab'),
                'email_penanggung_jawab' => $request->input('email_penanggung_jawab'),
                'no_hp_penanggung_jawab' => $request->input('no_hp_penanggung_jawab'),
                'caption_poster' => $request->input('caption_poster'),
                'jml_peserta' => $request->input('jml_peserta', 0),
                'jml_panitia' => $request->input('jml_panitia', 0),
                'link_surat_izin_ortu' => $request->input('link_surat_izin_ortu'),
            ]);
        
            if ($proposal->save()) {
                return redirect()->route('proposal.detail', $id_proposal)->with('success', 'Data revisi berhasil diunggah.');
            }
        }        
    }

}

