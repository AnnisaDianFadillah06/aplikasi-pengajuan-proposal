<?php

namespace App\Http\Controllers;

use App\Models\Lpj;
use App\Models\Ormawa;
use App\Models\ReviewLPJ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanLpjController extends Controller
{
    public function index()
    {
        // Ambil ID dari sesi
        $sessionId = session('id_ormawa');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }

        // Ambil LPJ yang id_pengguna pada tabel pengajuan proposal-nya sama dengan id pengguna yang sedang login
        $lpjs = Lpj::whereHas('ormawa', function ($query) use ($sessionId) {
            $query->where('id_ormawa', $sessionId);
        })->get();

        // Ambil semua revisi terbaru untuk setiap proposal
        $latestReviews = ReviewLPJ::whereIn('id_lpj', $lpjs->pluck('id_lpj'))
            ->orderBy('id_lpj')
            ->orderBy('id_lpj', 'desc')
            ->get()
            ->groupBy('id_lpj')
            ->map(function ($revisions) {
                return $revisions->first(); // Ambil revisi terbaru dari setiap proposal
            });

        return view('proposal_kegiatan.pengajuan_lpj', [
            'lpjs' => $lpjs,
            'latestReviews' => $latestReviews
        ]);
    }

    public function show(Request $request, $id_lpj)
    {
        // Cek apakah LPJ ditemukan
        $lpj = Lpj::findOrFail($id_lpj);

        if (!$lpj) {
            abort(404, 'LPJ tidak ditemukan');
        }

        // Ambil data ormawa terkait
        $ormawa = DB::table('ormawa')->where('id_ormawa', $lpj->id_ormawa)->first();
        $nama_ormawa = $ormawa->nama_ormawa ?? '';

        // File LPJ, SPJ, dan SPTB
        $fileLpjPath = $lpj->file_lpj;
        $fileSpjPath = $lpj->file_spj;
        $fileSptbPath = $lpj->file_sptb;

        // =======================================================
        // mengambil review terakhir untuk mengambil proposal sedang di tahap mana
        $latestReview = ReviewLpj::where('id_lpj', $lpj->id_lpj)
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
        // =======================================================

        // Ambil data revisi terbaru terkait proposal ini (current step)
        $allRevision = ReviewLpj::where('id_lpj', $lpj->id_lpj)
                                        ->where('id_dosen', $currentStep) // Filter berdasarkan currentStep
                                        ->select(
                                            'id_dosen',
                                            DB::raw('STRING_AGG(catatan_revisi, \' | \') as catatan_revisi'), // Gabungkan dengan delimiter ' | '
                                            DB::raw('MAX(tgl_revisi) as last_revisi')
                                        )
                                        ->groupBy('id_dosen')
                                        ->orderBy('last_revisi', 'desc')
                                        ->first(); // Hanya satu grup untuk reviewer pada tahap ini
        
        return view('proposal_kegiatan.lpj.detail_lpj', [
            'lpj' => $lpj,
            'nama_ormawa' => $nama_ormawa,
            'status' => $status,
            'updatedByStep' => $updatedByStep,
            'currentStep' => $currentStep,
            'fileLpjPath' => $fileLpjPath,
            'fileSpjPath' => $fileSpjPath,
            'fileSptbPath' => $fileSptbPath,
            'currentStep' => $currentStep,
            'groupedRevisions' => $allRevision,
        ]);
    }

    public function nextStep(Request $request, $id)
    {
        $lpj = Lpj::findOrFail($id);
        $currentStep = session()->get('currentStep', 1);
        $ormawa = Ormawa::find($lpj->id_ormawa);
        // Nama ormawa yang diambil dari relasi tabel
        $ormawa = $ormawa->nama_ormawa ?? '';

        //untuk mengetahui proposal sedang di tahap mana (menentukan updatedbystep)
        $latestReview = ReviewLpj::where('id_lpj', $lpj->id_lpj)
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

            return redirect()->route('lpj.detail', $id);
    }

    public function prevStep(Request $request, $id)
    {
        $lpj = Lpj::findOrFail($id);
        $currentStep = session()->get('currentStep', 1);
        $ormawa = Ormawa::find($lpj->id_ormawa);
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


        return redirect()->route('lpj.detail', $id);
    }
}
