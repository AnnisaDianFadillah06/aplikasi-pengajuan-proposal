<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use App\Models\Ormawa;
use App\Models\ReviewSPJ;
use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $belumBerjalan = $proposal->updated_by != 6 || $proposal->status != 1;

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
            'belumBerjalan' => $belumBerjalan,
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
            'dokumen_berita_acara' => 'required|mimes:pdf|max:2048', // Maksimum 2MB
            'gambar_bukti_spj' => 'nullable|image|max:2048', // Maksimum 2MB
            'caption_video' => 'nullable|string|max:255',
        ]);

        // Folder penyimpanan
        $basePath = 'uploads/'; // Path relatif untuk Laravel Storage
        if (!Storage::exists($basePath)) {
            Storage::makeDirectory($basePath); // Membuat folder jika belum ada
        }

        $filePaths = [];
        
        // Menyimpan file di folder uploads/spj/{userId}/...
        if ($request->hasFile('file_sptb')) {
            $file = $request->file('file_sptb');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($basePath, $newFileName);
            $filePaths['file_sptb'] = $newFileName;
        }
    
        if ($request->hasFile('file_spj')) {
            $file = $request->file('file_spj');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $filePaths['file_spj'] = $file->storeAs($basePath, $newFileName);
            $filePaths['file_spj'] = $newFileName;
            }
            
        if ($request->hasFile('video_kegiatan')) {
            $file = $request->file('video_kegiatan');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $filePaths['video_kegiatan'] = $file->storeAs($basePath, $newFileName);
            $filePaths['video_kegiatan'] = $newFileName;
        }
    
        if ($request->hasFile('dokumen_berita_acara')) {
            $file = $request->file('dokumen_berita_acara');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $filePaths['dokumen_berita_acara'] = $file->storeAs($basePath, $newFileName);
            $filePaths['dokumen_berita_acara'] = $newFileName;
        }
    
        if ($request->hasFile('gambar_bukti_spj')) {
            $file = $request->file('gambar_bukti_spj');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $filePaths['gambar_bukti_spj'] = $file->storeAs($basePath, $newFileName);
            $filePaths['gambar_bukti_spj'] = $newFileName;
        }

        // menghitung spj ke berapa
        $spjKe = DB::table('spj')
            ->where('id_proposal', $request->id_proposal)
            ->max('spj_ke') + 1;

        $spj = new Spj();

        // Set atribut-atributnya
        $spj->id_proposal = $request->id_proposal; // Pastikan id_proposal dikirim melalui request
        $spj->file_sptb = $filePaths['file_sptb'] ?? null;
        $spj->file_spj = $filePaths['file_spj'] ?? null;
        $spj->spj_ke = $spjKe;
        $spj->video_kegiatan = $filePaths['video_kegiatan'] ?? null;
        $spj->dokumen_berita_acara = $filePaths['dokumen_berita_acara'] ?? null;
        $spj->gambar_bukti_spj = $filePaths['gambar_bukti_spj'] ?? null;
        $spj->caption_video = $request->caption_video;
        $spj->status = 0;
        $spj->tgl_upload = now();
        $spj->created_by = session('id');
        $spj->updated_by = 1;

        // Simpan data ke database dan cek hasilnya
        if ($spj->save()) {
            return redirect()->route('spj.index', $request->id_proposal)->with('success', 'SPJ berhasil diunggah.');
        } else {
            return redirect()->route('spj.index', $request->id_proposal)->with('error', 'Terjadi kesalahan saat mengunggah SPJ.');
        }
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

        // ==================================================================
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
            $updatedByStep = $spj->updated_by;
            $status = $spj->status;
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
        // ==================================================================

        // Ambil data revisi terbaru terkait proposal ini (current step)
        $allRevision = ReviewSpj::where('id_spj', $spj->id_spj)
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


        return view('proposal_kegiatan.spj.detail_spj', [
            'proposal' => $proposal,
            'spj' => $spj,
            'status' => $status,
            'filePath' => $filePath,
            'nama_ormawa' => $nama_ormawa,
            'updatedByStep' => $updatedByStep,
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

        } else {
            $updatedByStep = $spj->updated_by;
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

        return redirect()->route('spj.detail', $id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id_proposal' => 'required|exists:proposal_kegiatan,id_proposal',
            'file_sptb' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'file_spj' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'video_kegiatan' => 'nullable|mimes:mp4|max:51200', // Maksimum 50MB
            'dokumen_berita_acara' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'gambar_bukti_spj' => 'nullable|image|max:2048', // Maksimum 2MB
            'caption_video' => 'nullable|string|max:255',
        ]);

        $spj = Spj::findOrFail($id);

        if (!$spj) {
            return redirect()->back()->with('error', 'Data SPJ tidak ditemukan.');
        }

        // Direktori untuk menyimpan file
        $folderPath = 'uploads/';
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath); // Membuat folder jika belum ada
        }

        // Update dan simpan file
        if ($request->hasFile('file_sptb')) {
            $file = $request->file('file_sptb');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName); // Simpan file ke storage
            $spj->file_sptb = $newFileName; // Simpan nama file ke database
        }

        if ($request->hasFile('file_spj')) {
            $file = $request->file('file_spj');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName); // Simpan file ke storage
            $spj->file_spj = $newFileName; // Simpan nama file ke database
        }

        if ($request->hasFile('video_kegiatan')) {
            $file = $request->file('video_kegiatan');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName); // Simpan file ke storage
            $spj->video_kegiatan = $newFileName; // Simpan nama file ke database
        }

        if ($request->hasFile('dokumen_berita_acara')) {
            $file = $request->file('dokumen_berita_acara');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName); // Simpan file ke storage
            $spj->dokumen_berita_acara = $newFileName; // Simpan nama file ke database
        }

        if ($request->hasFile('gambar_bukti_spj')) {
            $file = $request->file('gambar_bukti_spj');
            $newFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($folderPath, $newFileName); // Simpan file ke storage
            $spj->gambar_bukti_spj = $newFileName; // Simpan nama file ke database
        }

        // Update data lainnya
        $spj->caption_video = $request->input('caption_video', $spj->caption_video);
        $spj->save();

        // mengambil review terakhir untuk mengambil proposal sedang di tahap mana
        $latestRevision = ReviewSpj::where('id_spj', $spj->id_spj)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();

        // Pastikan latestRevision ada
        if (!$latestRevision) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada revisi yang ditemukan untuk proposal ini.']);
        }

        // Update status_revisi pada ReviewProposal menjadi 0
        $latestRevision->update(['status_revisi' => 0]);

        return redirect()->route('spj.detail', $spj->id_spj)->with('success', 'SPJ berhasil diperbarui.');
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
