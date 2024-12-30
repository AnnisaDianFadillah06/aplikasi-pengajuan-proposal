<?php

namespace App\Http\Controllers;


use App\Models\Ormawa;
use App\Models\Reviewer;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProposalToken;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;

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

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }

        // mengambil review terakhir untuk mengambil proposal sedang di tahap mana
        $latestReview = ReviewProposal::where('id_proposal', $proposal->id_proposal)
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

        // Ambil data revisi terbaru terkait proposal ini (current step)
        $allRevision = ReviewProposal::where('id_proposal', $proposal->id_proposal)
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
        $latestDokumen = ReviewProposal::where('id_proposal', $proposal->id_proposal)
                            ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
                            ->orderBy('id_revisi', 'desc')
                            ->first();

        // Ambil data reviewer dan ormawa terkait
        $ormawa = Ormawa::find($proposal->id_ormawa);

        // Nama ormawa yang diambil dari relasi tabel
        $nama_ormawa = $ormawa->nama_ormawa ?? '';

        // File proposal
        $filePath = $latestDokumen && $latestDokumen->file_revisi 
                    ? $latestDokumen->file_revisi 
                    : $proposal->file_proposal;
                            
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
        ]);
    }

    public function nextStep(Request $request, $id)
    {
        $proposal = PengajuanProposal::findOrFail($id);
        $currentStep = session()->get('currentStep', 1);
        $ormawa = Ormawa::find($proposal->id_ormawa);
        // Nama ormawa yang diambil dari relasi tabel
        $ormawa = $ormawa->nama_ormawa ?? '';
        $lolos_proposal = $proposal->status_lpj;

        //untuk mengetahui proposal sedang di tahap mana (menentukan updatedbystep)
        $latestReview = ReviewProposal::where('id_proposal', $proposal->id_proposal)
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

        // Kondisi khusus untuk Ormawa yang bukan UKM, BEM, atau MPM
        if (str_contains($ormawa, 'UKM') || str_contains($ormawa, 'BEM') || str_contains($ormawa, 'MPM')) {
            // Jika currentStep adalah 2, tambah 2
            if ($currentStep == 2) {
                session()->put('currentStep', $currentStep + 2);
            } elseif ($currentStep <= $updatedByStep || $lolos_proposal == 1) {
                session()->put('currentStep', $currentStep + 1);
            } elseif ($currentStep == 5) {
                $currentStep = 1;
            }
        } else {
            // Perilaku default untuk ormawa lain
            
            if ($currentStep <= $updatedByStep || $proposal->status_lpj == 1) {
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

    // upload pdf revisi
    public function uploadFile(Request $request, $id_proposal)
    {
        // Validasi file
        $request->validate([
            'file_revisian' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Cari proposal berdasarkan id_proposal
        // $proposal = PengajuanProposal::findOrFail($id_proposal);

        // Cari revisi terbaru berdasarkan id_proposal
        $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();

        // Pastikan latestRevision ada
        if (!$latestRevision) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada revisi yang ditemukan untuk proposal ini.']);
        }

        // Proses upload file
        if ($request->hasFile('file_revisian')) {
            // Simpan file ke folder tertentu (misal: `revisi_files`)
            $file = $request->file('file_revisian');
            $fileName = time().'_'.$file->getClientOriginalName(); // Generate nama file unik
            $filePath = 'laraview/' . $fileName; // Path untuk disimpan di public/laraview
            
            // Simpan file langsung ke folder public/laraview
            $file->move(public_path('laraview'), $fileName);
            
            // Update kolom file_revisi dengan path file yang baru diunggah
            $latestRevision->update(['file_revisi' => $filePath]);

            // Update status pada PengajuanProposal menjadi 0
            // $proposal->update(['status' => 0]);

            // Update status_revisi pada ReviewProposal menjadi 0
            $latestRevision->update(['status_revisi' => 0]);
        }

        return redirect()->route('proposal.detail', $id_proposal)->with('success', 'File revisi berhasil diunggah.');
    }

    // Membuat Token Unik untuk Setiap Proposal
    public function generateLinkForProposal($id_proposal)
    {
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        // Generate a unique token
        $token = Str::random(32);

        // Simpan token dalam tabel proposal_tokens
        ProposalToken::create([
            'proposal_id' => $id_proposal,
            'token' => $token,
        ]);

        // Redirect ke halaman bukti disetujui dengan token
        return redirect()->route('proposal.approvalProofWithToken', ['token' => $token]);
    }

    // bukti proposal sudah disetujui WD3 
    public function approvalProofWithToken($token)
    {
        // Cari token di database
        $tokenRecord = DB::table('proposal_tokens')->where('token', $token)->first();

        if (!$tokenRecord) {
            abort(404, 'Link tidak valid atau sudah kadaluarsa.');
        }

        // Ambil proposal berdasarkan ID yang terkait dengan token
        $proposal = PengajuanProposal::findOrFail($tokenRecord->proposal_id);

        // Kirim data proposal ke view bukti proposal disetujui
        return view('proposal_kegiatan.bukti_disetujui', compact('proposal'));
    }

    // show form LPJ
    public function formLPJ($id_proposal)
    {
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        // Update status proposal untuk tahap pengajuan laporan pertanggung jawaban
        $proposal->status = 1;
        $proposal->updated_by = 1;
        $proposal->status_lpj = 1;
        $proposal->status_approve_lpj = 0;
        $proposal->save();

        // Redirect ke halaman pengajuan laporan pertanggung jawaban
        return view('proposal_kegiatan.form_lpj', compact('proposal'));
    }

    // Submit LPJ
    public function submitLPJ(Request $request, $id_proposal)
    {
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        // Validasi dan upload file laporan pertanggung jawaban
        $request->validate([
            'report_file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        // Simpan file laporan pertanggung jawaban
        if ($request->hasFile('report_file')) {
            $file = $request->file('report_file');
            $fileName = time().'_'.$file->getClientOriginalName(); // Generate nama file unik
            $filePath = 'laraview/' . $fileName; // Path untuk disimpan di public/laraview

            // Simpan file langsung ke folder public/laraview
            $file->move(public_path('laraview'), $fileName);
            
            // update kolom file_lpj
            $proposal->update(['file_lpj' => $filePath]);
        }

        // return redirect()->route('proposal.detail', $proposal->id_proposal)->with('success', 'Laporan pertanggung jawaban berhasil diajukan.');
        return redirect()->route('laporan.detail', [
            'id' => $proposal->id_proposal,
            'is_first_access' => true, // Menambahkan ke query string 
            ])->with('success', 'Laporan pertanggungjawaban berhasil diajukan.');
    }
}

