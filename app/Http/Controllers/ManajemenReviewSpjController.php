<?php

namespace App\Http\Controllers;
use App\Models\Spj;
use App\Models\Ormawa;
use App\Models\ReviewSPJ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;
use App\Mail\notifikasiReviewerSpj;
use App\Mail\kirimEmail;
use App\Models\Reviewer;


class ManajemenReviewSpjController extends Controller
{
    
    // Fungsi untuk menampilkan data lpj yang akan direvisi
    public function show($id_spj)
    {
        // Cari review lpj berdasarkan id_lpj
        $reviewSpj = Spj::with([
            'proposalKegiatan.jenisKegiatan', // Relasi ke `jenisKegiatan` melalui `proposal`
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
    

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'status_revisi' => 'required',
        ]);
    
        try {
            // Mulai transaksi database
            DB::beginTransaction();
    
            $spj = Spj::find($request->input('id_spj')); // Ambil SPJ berdasarkan ID
    
            // Simpan data revisi ke dalam tabel revisi_file
            ReviewSPJ::create([
                'catatan_revisi' => $request->input('catatan_revisi'),
                'tgl_revisi' => now()->format('Y-m-d'),
                'id_dosen' => session('id_role'),
                'id_spj' => $request->input('id_spj'),
                'status_revisi' => $request->input('status_revisi'),
            ]);
    
            if ($spj) {
                // Ambil relasi proposal kegiatan terkait
                $proposal = $spj->proposalKegiatan; // Pastikan relasi di model Spj sudah dibuat
                if ($proposal) {
                    // Ambil data pengguna terkait proposal
                    $pengajuList = $proposal->pengaju; // Relasi ke pengaju dari proposal
                    // Format dokumen yang harus direvisi menjadi string dengan pemisah newline
                    $revisi_items = $request->input('revisi_items', []);
                    $revisi_items_string = implode("\n", $revisi_items);
                    foreach ($pengajuList as $pengaju) {
                    if ($pengaju && $pengaju->email) {
                        // Kirim notifikasi email
                        $data_email = [
                            'subject' => 'Revisi SPJ',
                            'sender_name' => 'proposalkupolban@gmail.com',
                            'spj_ke' => $spj->spj_ke,
                            'judul' => $proposal->nama_kegiatan, // Nama kegiatan dari proposal
                            'username' => $pengaju->username, // Username dari pengguna
                            'revisi_items' => $revisi_items_string,
                            'isi' => $request->input('catatan_revisi'), // Catatan revisi dari input
                            'route' => 'spj',
                            'status_revisi' => $request->input('status_revisi'),
                            'id_role' => session('id_role'),
                        ];
    
                        Mail::to($pengaju->email)->send(new kirimEmail($data_email));
                    }
                }

                // Ambil data ormawa proposal terkait
                $ormawa = Ormawa::find($proposal->id_ormawa);

                // Nama ormawa yang diambil dari relasi tabel
                $nama_ormawa = $ormawa->nama_ormawa ?? '';
    
                    // Update status SPJ di tabel proposal kegiatan jika sampai tahap akhir (session id = 6)
                    if (session()->has('id_role') && session('id_role') == 5) {
                        $spj->status = $request->input('status_revisi'); //tabel spj (1,2,3)
                        $proposal->status_spj = $request->input('status_revisi'); //tabel proposal kegiatan (0,1)
                    }
    
                    // Update updated_by jika status revisi di tabel revisi SPJ = 1
                    // Update updated_by jika status revisi = 1
                    if ($request->input('status_revisi') == 1 && session()->has('id_role')) {
                        // Kondisi khusus untuk Ormawa UKM, BEM, atau MPM
                        if (str_contains($nama_ormawa, 'UKM') || str_contains($nama_ormawa, 'BEM') || str_contains($nama_ormawa, 'MPM')) {
                            $spj->updated_by = session('id_role') + 2;
                        } else {
                            // Kondisi default untuk Ormawa lainnya
                            $spj->updated_by = session('id_role') + 1;
                        }
                    }
    
                    $spj->save(); 
                    $proposal->save(); // Simpan perubahan pada tabel spj
                }
            }
    
            // Commit transaksi jika semua proses berhasil
            DB::commit();
    
            return redirect('/manajemen-review')
                ->with('success', 'Revisi SPJ berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');
        } catch (TransportException $e) {
            // Rollback transaksi jika pengiriman email gagal
            DB::rollBack();
    
            return redirect('/manajemen-review')
                ->with('error', 'Email gagal dikirim. Data revisi tidak disimpan. Periksa koneksi jaringan Anda.');
        } 
    }

    public function getReviewerEmail($roleId)
    {
        // Ambil email reviewer berdasarkan role_id
        $reviewerEmails = Reviewer::where('id_role', $roleId)->pluck('email');
        return $reviewerEmails;
    }

    // Method ini bisa dipanggil di event Lpj
    public function sendReviewNotificationSpj($spj)
    {
        // Ambil email reviewer berdasarkan updated_by yang ada pada proposal
        $reviewerEmails = $this->getReviewerEmail($spj->updated_by);

        // Siapkan data untuk email
        $data_email = [
            'judul' => $spj->proposalKegiatan->nama_kegiatan,
        ];

        // Kirim email ke semua reviewer
        foreach ($reviewerEmails as $email) {
            Mail::to($email)->send(new notifikasiReviewerSpj($data_email));
        }
    }
    
}