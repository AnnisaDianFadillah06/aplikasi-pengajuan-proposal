<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use App\Models\Ormawa;
use App\Models\ReviewSPJ;
use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class SpjController extends Controller
{
    public function index($id_proposal)
    {
        try {
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

    public function formIndex($id_proposal)
    {
        try {
           return view('proposal_kegiatan.spj.form_spj', [
                'id_proposal' => $id_proposal
            ]);
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


    public function store(Request $request)
    { 
        try {
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

    // detail
    public function show(Request $request, $id_spj)
    {
        try {
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
        // ==================================================================

        // Ambil data revisi terbaru terkait proposal ini (current step)
        $allRevision = ReviewSpj::where('id_spj', $spj->id_spj)
                                        ->where('id_dosen', $currentStep) // Filter berdasarkan currentStep
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
        ]); } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    public function nextStep(Request $request, $id)
    {
        try {
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

    public function prevStep(Request $request, $id)
    {
        try {
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

        return redirect()->route('spj.detail', $id); } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(Request $request, $id)
    { 
        try {
        $request->validate([
            // 'id_proposal' => 'required|exists:proposal_kegiatan,id_proposal',
            'file_sptb' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'file_spj' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'video_kegiatan' => 'nullable|mimes:mp4|max:51200', // Maksimum 50MB
            'dokumen_berita_acara' => 'nullable|mimes:pdf|max:2048', // Maksimum 2MB
            'gambar_bukti_spj' => 'nullable|image|max:2048', // Maksimum 2MB
            'caption_video' => 'nullable|string|max:255',
        ]);

        $spj = DB::table('spj')->where('id_spj', $id)->first();

        if (!$spj) {
            return redirect()->back()->with('error', 'Data SPJ tidak ditemukan.');
        }

        $file_sptb = $request->file('file_sptb');
        $file_spj = $request->file('file_spj');
        $video_kegiatan = $request->file('video_kegiatan');
        $dokumen_berita_acara = $request->file('dokumen_berita_acara');
        $gambar_bukti_spj = $request->file('gambar_bukti_spj');

        $file_sptb_path = $spj->file_sptb;
        $file_spj_path = $spj->file_spj;
        $video_kegiatan_path = $spj->video_kegiatan;
        $dokumen_berita_acara_path = $spj->dokumen_berita_acara;
        $gambar_bukti_spj_path = $spj->gambar_bukti_spj;

        if ($file_sptb) {
            $file_sptb_path = 'laraview/' . time() . '_' . $file_sptb->getClientOriginalName();
            $file_sptb->move(public_path('laraview'), $file_sptb_path);
        }

        if ($file_spj) {
            $file_spj_path = 'laraview/' . time() . '_' . $file_spj->getClientOriginalName();
            $file_spj->move(public_path('laraview'), $file_spj_path);
        }

        if ($video_kegiatan) {
            $video_kegiatan_path = 'laraview/' . time() . '_' . $video_kegiatan->getClientOriginalName();
            $video_kegiatan->move(public_path('laraview'), $video_kegiatan_path);
        }

        if ($dokumen_berita_acara) {
            $dokumen_berita_acara_path = 'laraview/' . time() . '_' . $dokumen_berita_acara->getClientOriginalName();
            $dokumen_berita_acara->move(public_path('laraview'), $dokumen_berita_acara_path);
        }

        if ($gambar_bukti_spj) {
            $gambar_bukti_spj_path = 'laraview/' . time() . '_' . $gambar_bukti_spj->getClientOriginalName();
            $gambar_bukti_spj->move(public_path('laraview'), $gambar_bukti_spj_path);
        }

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

        DB::table('spj')->where('id_spj', $id)->update([
            'file_sptb' => $file_sptb_path,
            'file_spj' => $file_spj_path,
            'video_kegiatan' => $video_kegiatan_path,
            'dokumen_berita_acara' => $dokumen_berita_acara_path,
            'gambar_bukti_spj' => $gambar_bukti_spj_path,
            'caption_video' => $request->caption_video,
            // 'tgl_upload' => now(),
        ]);

        return redirect()->route('spj.detail', $spj->id_spj)->with('success', 'SPJ berhasil diperbarui.'); } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }
}
