<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace
use App\Models\ReviewLPJ;
use App\Models\Lpj;
use Illuminate\Support\Facades\DB;


class LpjController extends Controller
{
    
    // Fungsi untuk menampilkan data lpj yang akan direvisi
    public function show($id_lpj)
    {
        // Cari review lpj berdasarkan id_lpj
        $lpjterpilih = Lpj::with([
            'proposalKegiatan.jenisKegiatan', // Relasi ke `jenisKegiatan` melalui `proposal`
            'proposalKegiatan.ormawa',        // Relasi ke `ormawa` melalui `proposal`
            'proposalKegiatan.pengguna'       // Relasi ke `pengguna` melalui `proposal`
        ])
        ->where('id_lpj', $id_lpj)
        ->firstOrFail();
    
        // // Cari revisi terbaru berdasarkan id_proposal
        // // mengambil dokumen revisi terakhir
        // $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
        //                     ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
        //                     ->orderBy('id_revisi', 'desc')
        //                     ->first();

        return view('proposal_kegiatan.manajemen_review_lpj', compact('lpjterpilih'));
    }
    

    // Fungsi untuk menyimpan data revisi ke dalam tabel revisi_lpj
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'status_revisi' => 'required',
        ]);
        $lpj = LPJ::find($request->input('id_lpj')); // Ambil LPJ berdasarkan ID
        // Simpan data revisi ke dalam tabel revisi_file
        ReviewLPJ::create([
            'catatan_revisi' => $request->input('catatan_revisi'),
            'tgl_revisi' => now()->format('Y-m-d'),
            'id_dosen' => session('id_role'),
            'id_lpj' => $request->input('id_lpj'),
            'id_proposal' => $lpj->id_proposal, // Ambil id_proposal terkait
            'status_revisi' => $request->input('status_revisi'),
        ]);
    
        
        if ($lpj) {
            // Ambil relasi proposal kegiatan terkait
            $proposal = $lpj->proposalKegiatan; // Pastikan relasi di model Lpj sudah dibuat
            if ($proposal) {
                // Ambil data pengguna terkait proposal
                $pengaju = $proposal->pengguna; // Relasi ke pengguna dari proposal
                if ($pengaju && $pengaju->email) {
                    // Kirim notifikasi email
                    $data_email = [
                        'subject' => 'Revisi LPJ',
                        'sender_name' => 'proposalkupolban@gmail.com',
                        'judul' => $proposal->nama_kegiatan, // Nama kegiatan dari proposal
                        'username' => $pengaju->username, // Username dari pengguna
                        'revisi_items' => $pengaju->username, // INI MASI DUMMY NNTI BETULKAN SESUAI CHECKBOX
                        'isi' => $request->input('catatan_revisi'), // Catatan revisi dari input
                    ];

                    Mail::to($pengaju->email)->send(new kirimEmail($data_email));
                }

                // Update status LPJ di tabel proposal kegiatan jika sampai tahap akhir (session id = 6)
                if (session()->has('id') && session('id') == 6) {
                    $proposal->status_lpj = $request->input('status_revisi');
                }

                // Update updated_by jika status revisi di tabel revisi LPJ = 1
                if ($request->input('status_revisi') == 1 && session()->has('id')) {
                    $proposal->updated_by = session('id_role') + 1; // Misal role yang melakukan revisi
                }

                $proposal->save(); // Simpan perubahan pada tabel proposal kegiatan
            }
        }
    
        return redirect('/manajemen-review')
            ->with('success', 'Revisi LPJ berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');
    }
    

}