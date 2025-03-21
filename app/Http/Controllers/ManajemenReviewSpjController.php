<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace
use App\Models\ReviewSPJ;
use App\Models\Spj;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Exception\TransportException;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class ManajemenReviewSpjController extends Controller
{
    
    // Fungsi untuk menampilkan data lpj yang akan direvisi
    public function show($id_spj)
    {
        try {
        // Cari review lpj berdasarkan id_lpj
        $reviewSpj = Spj::with([
            'proposalKegiatan.jenisKegiatan', // Relasi ke `jenisKegiatan` melalui `proposal`
            'proposalKegiatan.pengguna'       // Relasi ke `pengguna` melalui `proposal`
        ])
        ->where('id_spj', $id_spj)
        ->firstOrFail();

        return view('proposal_kegiatan.manajemen_review_spj', compact('reviewSpj')); } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
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
    
                    if (session()->has('id_role') && session('id_role') == 5 && $request->input('status_revisi') == 1) {
                        $proposal->status_spj = 1;
                        $spj->status = $request->input('status_revisi'); //tabel spj (1,2,3)
                    }
    
                    // Update updated_by jika status revisi di tabel revisi SPJ = 1
                    if ($request->input('status_revisi') == 1 && session()->has('id_role')) {
                        $spj->updated_by = session('id_role') + 1; // Misal role yang melakukan revisi
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
    
}