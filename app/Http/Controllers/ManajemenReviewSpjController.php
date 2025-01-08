<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace
use App\Models\ReviewSPJ;
use App\Models\Spj;
use Illuminate\Support\Facades\DB;


class ManajemenReviewSpjController extends Controller
{
    
    // Fungsi untuk menampilkan data lpj yang akan direvisi
    public function show($id_spj)
    {
        // Cari review lpj berdasarkan id_lpj
        $reviewSpj = Spj::with([
            'proposalKegiatan.jenisKegiatan', // Relasi ke `jenisKegiatan` melalui `proposal`
            'proposalKegiatan.ormawa',        // Relasi ke `ormawa` melalui `proposal`
            'proposalKegiatan.pengguna'       // Relasi ke `pengguna` melalui `proposal`
        ])
        ->where('id_spj', $id_spj)
        ->firstOrFail();
    
        // // Cari revisi terbaru berdasarkan id_proposal (ini cuman buat nampilin di tabel buat statusnya ajakan ya?)
        // // mengambil dokumen revisi terakhir
        // $latestRevision = ReviewLpj::where('id_spj', $id_spj)
        //                     ->orderBy('id_revisi', 'desc')
        //                     ->first();

        return view('proposal_kegiatan.manajemen_review_spj', compact('reviewSpj'));
    }
    

    // Fungsi untuk menyimpan data revisi ke dalam tabel revisi_lpj
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'status_revisi' => 'required',
        ]);
        $spj = Spj::find($request->input('id_spj')); // Ambil LPJ berdasarkan ID
        // Simpan data revisi ke dalam tabel revisi_file
        ReviewSPJ::create([
            'catatan_revisi' => $request->input('catatan_revisi'),
            'tgl_revisi' => now()->format('Y-m-d'),
            'id_dosen' => session('id_role'),
            'id_spj' => $request->input('id_spj'),
            'id_proposal' => $spj->id_proposal, // Ambil id_proposal terkait
            'status_revisi' => $request->input('status_revisi'),
        ]);
    
        
        if ($spj) {
            // Ambil relasi proposal kegiatan terkait
            $proposal = $spj->proposalKegiatan; // Pastikan relasi di model Spj sudah dibuat
            if ($proposal) {
                // Ambil data pengguna terkait proposal
                $pengaju = $proposal->pengguna; // Relasi ke pengguna dari proposal
                if ($pengaju && $pengaju->email) {
                    // Kirim notifikasi email
                    $data_email = [
                        'subject' => 'Revisi SPJ',
                        'sender_name' => 'proposalkupolban@gmail.com',
                        'spj_ke' => $spj->spj_ke,
                        'judul' => $proposal->nama_kegiatan, // Nama kegiatan dari proposal
                        'username' => $pengaju->username, // Username dari pengguna
                        'revisi_items' => $pengaju->username, // INI MASI DUMMY NNTI BETULKAN SESUAI CHECKBOX
                        'isi' => $request->input('catatan_revisi'), // Catatan revisi dari input
                    ];

                    Mail::to($pengaju->email)->send(new kirimEmail($data_email));
                }

                // Update status SPJ di tabel proposal kegiatan jika sampai tahap akhir (session id = 6)
                if (session()->has('id') && session('id') == 6) {
                    $proposal->status_spj = $request->input('status_revisi');
                }

                // Update updated_by jika status revisi di tabel revisi SPJ = 1
                if ($request->input('status_revisi') == 1 && session()->has('id')) {
                    $proposal->updated_by = session('id_role') + 1; // Misal role yang melakukan revisi
                }

                $proposal->save(); // Simpan perubahan pada tabel proposal kegiatan
            }
        }
    
        return redirect('/manajemen-review')
            ->with('success', 'Revisi SPJ berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');
    }
    

}