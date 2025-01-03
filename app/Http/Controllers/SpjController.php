<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use App\Models\Ormawa;
use App\Models\ReviewSPJ;
use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;

class SpjController extends Controller
{
    public function index($id_proposal)
    {
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // ambil data proposal by id
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        // Ambil semua spj pengguna
        $spjs = Spj::where('id_proposal', $id_proposal)->get();

        // Periksa apakah jumlah SPJ telah mencapai jumlah_spj
        $canUpload = $spjs->count() < $proposal->jumlah_spj;

        // Ambil semua revisi terbaru untuk setiap proposal
        $latestReviews = ReviewSPJ::whereIn('id_spj', $spjs->pluck('id_spj'))
            ->orderBy('id_spj')
            ->orderBy('id_revisi', 'desc')
            ->get()
            ->groupBy('id_proposal')
            ->map(function ($revisions) {
                return $revisions->first(); // Ambil revisi terbaru dari setiap proposal
            });

        return view('proposal_kegiatan.spj.tabel_spj', [
            'proposal' => $proposal,
            'spjs' => $spjs,
            'latestReviews' => $latestReviews,
            'canUpload' => $canUpload,
        ]);
    }

    public function formIndex($id_proposal)
    {
        return view('proposal_kegiatan.spj.form_spj', [
            'id_proposal' => $id_proposal
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_proposal' => 'required|exists:proposal_kegiatan,id_proposal',
            'file_sptb' => 'required|mimes:pdf|max:2048', // Maksimum 2MB
            'file_spj' => 'required|mimes:pdf|max:2048', // Maksimum 2MB
            'video_kegiatan' => 'nullable|mimes:mp4|max:51200', // Maksimum 50MB
            'dokumen_berita_acara' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'gambar_bukti_spj' => 'nullable|image|max:2048', // Maksimum 2MB
            'caption_video' => 'nullable|string|max:255',
        ]);

        $file_sptb = $request->file('file_sptb');
        $file_spj = $request->file('file_spj');
        $video_kegiatan = $request->file('video_kegiatan');
        $dokumen_berita_acara = $request->file('dokumen_berita_acara');
        $gambar_bukti_spj = $request->file('gambar_bukti_spj');

        $file_sptb_path = $file_sptb ? 'laraview/' . time() . '_' . $file_sptb->getClientOriginalName() : null;
        $file_spj_path = $file_spj ? 'laraview/' . time() . '_' . $file_spj->getClientOriginalName() : null;
        $video_kegiatan_path = $video_kegiatan ? 'laraview/' . time() . '_' . $video_kegiatan->getClientOriginalName() : null;
        $dokumen_berita_acara_path = $dokumen_berita_acara ? 'laraview/' . time() . '_' . $dokumen_berita_acara->getClientOriginalName() : null;
        $gambar_bukti_spj_path = $gambar_bukti_spj ? 'laraview/' . time() . '_' . $gambar_bukti_spj->getClientOriginalName() : null;

        if ($file_sptb) {
            $file_sptb->move(public_path('laraview'), $file_sptb_path);
        }
        if ($file_spj) {
            $file_spj->move(public_path('laraview'), $file_spj_path);
        }
        if ($video_kegiatan) {
            $video_kegiatan->move(public_path('laraview'), $video_kegiatan_path);
        }
        if ($dokumen_berita_acara) {
            $dokumen_berita_acara->move(public_path('laraview'), $dokumen_berita_acara_path);
        }
        if ($gambar_bukti_spj) {
            $gambar_bukti_spj->move(public_path('laraview'), $gambar_bukti_spj_path);
        }

        // menghitung spj ke berapa
        $spjKe = DB::table('spj')
            ->where('id_proposal', $request->id_proposal)
            ->max('spj_ke') + 1;

        DB::table('spj')->insert([
            'id_proposal' => $request->id_proposal, // Pastikan id_proposal dikirim melalui request
            'file_sptb' => $file_sptb_path,
            'file_spj' => $file_spj_path,
            'spj_ke' => $spjKe,
            'video_kegiatan' => $video_kegiatan_path,
            'dokumen_berita_acara' => $dokumen_berita_acara_path,
            'gambar_bukti_spj' => $gambar_bukti_spj_path,
            'caption_video' => $request->caption_video,
            'status' => 0,
            'tgl_upload' => now(),
            'created_by' => session('id'),
            'updated_by' => 1,
        ]);

        return redirect()->route('spj.index', $request->id_proposal)->with('success', 'SPJ berhasil diunggah.');
    }

    // detail
    public function show(Request $request, $id_spj)
    {
        // Ambil data SPJ berdasarkan ID
        $spj = Spj::findOrFail($id_spj);
        
        // Ambil proposal terkait SPJ
        $proposal = $spj->proposalKegiatan;

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }


        // Ambil data reviewer dan ormawa terkait
        $ormawa = Ormawa::find($proposal->id_ormawa);
        $nama_ormawa = $ormawa->nama_ormawa ?? '';
        $status = $spj->status;
        $updatedByStep = $spj->updated_by;
        $currentStep = $spj->updated_by;

        // Tentukan file SPJ yang akan digunakan
        $filePath = $spj->file_spj;
        $filePathBeritaAcara = $spj->dokumen_berita_acara;
        $filePathBuktiSpj = $spj->gambar_bukti_spj;
        $filePathVideoKegiatan = $spj->video_kegiatan;
        $filePathSptb = $spj->file_sptb;

        // mengambil review terakhir untuk mengambil proposal sedang di tahap mana
        $latestReview = ReviewSpj::where('id_spj', $spj->id_spj)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();
        
        // assign var updatedByStep sesuai kondisi status pada tabel revisi file
        if ($latestReview) {
            $updatedByStep = $latestReview->status_revisi == 1 
                ? $latestReview->id_dosen + 1 
                : $latestReview->id_dosen;

            $status = $latestReview->status_revisi == 1 
                ? 0 
                : $latestReview->status_revisi;
        } else {
            $updatedByStep = 1;
            $status = 0;
        }

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

        // Ambil data revisi terbaru terkait proposal ini (current step)
        $allRevision = ReviewSpj::where('id_spj', $spj->id_spj)
                                        ->where('id_dosen', $currentStep) // Filter berdasarkan currentStep
                                        ->select(
                                            'id_dosen',
                                            DB::raw('STRING_AGG(catatan_revisi, \' | \') as catatan_revisi'), // Gabungkan dengan delimiter ' | '
                                            DB::raw('MAX(tgl_revisi) as last_revisi')
                                        )
                                        ->groupBy('id_dosen')
                                        ->orderBy('last_revisi', 'desc')
                                        ->first(); // Hanya satu grup untuk reviewer pada tahap ini
        
        // mengambil dokumen revisi terakhir
        $latestDokumen = ReviewSpj::where('id_spj', $spj->id_spj)
                            ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
                            ->orderBy('id_revisi', 'desc')
                            ->first();


        return view('proposal_kegiatan.spj.detail_spj', [
            'proposal' => $proposal,
            'spj' => $spj,
            'updatedByStep' => $updatedByStep,
            'status' => $status,
            'filePath' => $filePath,
            'nama_ormawa' => $nama_ormawa,
            'currentStep' => $currentStep,
            'filePathBeritaAcara' => $filePathBeritaAcara,
            'filePathBuktiSpj' => $filePathBuktiSpj,
            'filePathVideoKegiatan' => $filePathVideoKegiatan,
            'filePathSptb' => $filePathSptb,
            'latestRevision' => $latestReview, // Ganti nama untuk view
            'groupedRevisions' => $allRevision,
        ]);
    }

    public function nextStep(Request $request, $id)
    {
        // Ambil data SPJ berdasarkan ID
        $spj = Spj::findOrFail($id);
        $currentStep = session()->get('currentStep', 1);
        $ormawa = Ormawa::find($spj->id_ormawa);
        // Nama ormawa yang diambil dari relasi tabel
        $ormawa = $ormawa->nama_ormawa ?? '';

        //untuk mengetahui proposal sedang di tahap mana (menentukan updatedbystep)
        $latestReview = ReviewSpj::where('id_spj', $spj->id_spj)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();

        if ($latestReview) {
            $updatedByStep = $latestReview->status_revisi == 1 
                ? $latestReview->id_dosen + 1 
                : $latestReview->id_dosen;

            $status = $latestReview->status_revisi == 1 
                ? 0 
                : $latestReview->status_revisi;
        } else {
            $updatedByStep = 1;
            $status = 0;
        }
        
        // Jika currentStep adalah 2, tambah 2
        if ($currentStep == 2) {
            session()->put('currentStep', $currentStep + 2);
        } elseif ($currentStep <= $updatedByStep) {
            session()->put('currentStep', $currentStep + 1);
        } 
        
        return redirect()->route('spj.detail', $id);
    }

    public function prevStep(Request $request, $id)
    {
        // Ambil data SPJ berdasarkan ID
        $spj = Spj::findOrFail($id);
        $currentStep = session()->get('currentStep', 1);
        $ormawa = Ormawa::find($spj->id_ormawa);
        
        $ormawa = $ormawa->nama_ormawa ?? '';
        
        // Periksa jika ini adalah akses pertama kali
        $isFirstAccess = $request->input('is_first_access', false); // default false jika tidak ada
        
        if ($isFirstAccess) {
            // Lakukan sesuatu jika ini adalah akses pertama kali
            $currentStep = 7;
        } else {
            $currentStep = session()->get('currentStep', 1);
        }

        // Jika currentStep adalah 5, kurangi 2
        if ($currentStep == 5) {
            session()->put('currentStep', $currentStep - 3);
        } elseif ($currentStep >= 1) {
            session()->put('currentStep', $currentStep - 1);
        }

        return redirect()->route('spj.detail', $id);
    }

    // // upload pdf revisi
    // public function uploadFile(Request $request, $id_proposal)
    // {
    //     // Validasi file
    //     $request->validate([
    //         'file_revisian' => 'required|file|mimes:pdf,doc,docx|max:2048',
    //     ]);

    //     // Cari proposal berdasarkan id_proposal
    //     // $proposal = PengajuanProposal::findOrFail($id_proposal);

    //     // Cari revisi terbaru berdasarkan id_proposal
    //     $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
    //                                     // ->orderBy('tgl_revisi', 'desc')
    //                                     ->orderBy('id_revisi', 'desc')
    //                                     ->first();

    //     // Pastikan latestRevision ada
    //     if (!$latestRevision) {
    //         return redirect()->back()->withErrors(['error' => 'Tidak ada revisi yang ditemukan untuk proposal ini.']);
    //     }

    //     // Proses upload file
    //     if ($request->hasFile('file_revisian')) {
    //         // Simpan file ke folder tertentu (misal: `revisi_files`)
    //         $file = $request->file('file_revisian');
    //         $fileName = time().'_'.$file->getClientOriginalName(); // Generate nama file unik
    //         $filePath = 'laraview/' . $fileName; // Path untuk disimpan di public/laraview
            
    //         // Simpan file langsung ke folder public/laraview
    //         $file->move(public_path('laraview'), $fileName);
            
    //         // Update kolom file_revisi dengan path file yang baru diunggah
    //         $latestRevision->update(['file_revisi' => $filePath]);

    //         // Update status pada PengajuanProposal menjadi 0
    //         // $proposal->update(['status' => 0]);

    //         // Update status_revisi pada ReviewProposal menjadi 0
    //         $latestRevision->update(['status_revisi' => 0]);
    //     }

    //     return redirect()->route('proposal.detail', $id_proposal)->with('success', 'File revisi berhasil diunggah.');
    // }

}
