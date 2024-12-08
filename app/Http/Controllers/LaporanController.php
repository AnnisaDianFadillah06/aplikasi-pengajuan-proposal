<?php

namespace App\Http\Controllers;


use App\Models\Ormawa;

use App\Models\ReviewLPJ;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProposalToken;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function show(Request $request, $id_proposal)
    {
        // Cek apakah proposal ditemukan
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }

        // mengambil review terakhir untuk mengambil proposal sedang di tahap mana
        $latestReview = ReviewLPJ::where('id_proposal', $proposal->id_proposal)
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
        $allRevision = ReviewLPJ::where('id_proposal', $proposal->id_proposal)
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
        $latestDokumen = ReviewLPJ::where('id_proposal', $proposal->id_proposal)
                            ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
                            ->orderBy('id_revisi', 'desc')
                            ->first();
                            
        return view('proposal_kegiatan.detail_laporan_pertanggungjawaban', [
            'proposal' => $proposal,
            'currentStep' => $currentStep,
            'updatedByStep' => $updatedByStep,
            'status' => $status,
            'status_lpj' => $status_lpj,
            'latestRevision' => $latestReview, // Ganti nama untuk view
            'groupedRevisions' => $allRevision,
            'latestDokumen' => $latestDokumen,
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
        $latestReview = ReviewLPJ::where('id_proposal', $proposal->id_proposal)
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
        
        // Periksa jika ini adalah akses pertama kali
        $isFirstAccess = $request->input('is_first_access', false); // default false jika tidak ada
        
        if ($isFirstAccess) {
            // Lakukan sesuatu jika ini adalah akses pertama kali
            $currentStep = 0;
        } else {
            $currentStep = session()->get('currentStep', 1);
        }
        
        // Kondisi khusus untuk Ormawa yang bukan UKM, BEM, atau MPM
        if (str_contains($ormawa, 'UKM') || str_contains($ormawa, 'BEM') || str_contains($ormawa, 'MPM')) {
            // Jika currentStep adalah 3, tambah 2
            if ($currentStep == 3) {
                session()->put('currentStep', $currentStep + 2);
            } elseif ($currentStep <= $updatedByStep || $lolos_proposal == 1) {
                session()->put('currentStep', $currentStep + 1);
            } elseif ($currentStep == 6) {
                $currentStep = 1;
            }
        } else {
            // Perilaku default untuk ormawa lain
            
            if ($currentStep <= $updatedByStep || $proposal->status_lpj == 1) {
                session()->put('currentStep', $currentStep + 1);
            } elseif ($currentStep == 6) {
                $currentStep = 1;
            }
        }

            return redirect()->route('laporan.detail', $id);
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
            if ($currentStep == 5) {
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


        return redirect()->route('laporan.detail', $id);
    }

    // bukti proposal sudah disetujui WD3 
    public function approvalProof($id_proposal)
    {
        // Cek apakah proposal ditemukan
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        if (!$proposal || $proposal->status_lpj != 1) {
            abort(404, 'Proposal belum disetujui atau data tidak ditemukan');
        }        

        // Kirim data proposal ke view bukti proposal disetujui
        return view('proposal_kegiatan.bukti_lpj_disetujui', compact('proposal'));
    }
}
