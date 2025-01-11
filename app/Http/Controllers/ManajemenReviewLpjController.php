<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace
use App\Models\ReviewLPJ;
use App\Models\Lpj;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Exception\TransportException;


class ManajemenReviewLpjController extends Controller
{
    
    // Fungsi untuk menampilkan data lpj yang akan direvisi
    public function show($id_lpj)
    {
        // Cari review lpj berdasarkan id_lpj
        $reviewLpj = Lpj::with('ormawa')
        ->where('id_lpj', $id_lpj)
        ->firstOrFail();
    
        // // Cari revisi terbaru berdasarkan id_proposal
        // // mengambil dokumen revisi terakhir
        // $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
        //                     ->whereNotNull('file_revisi') // Pastikan kolom file_revisi tidak null
        //                     ->orderBy('id_revisi', 'desc')
        //                     ->first();

        return view('proposal_kegiatan.manajemen_review_lpj', compact('reviewLpj'));
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
    
            $lpj = Lpj::find($request->input('id_lpj')); // Ambil LPJ berdasarkan ID
    
            // Simpan data revisi ke dalam tabel revisi_file
            ReviewLPJ::create([
                'catatan_revisi' => $request->input('catatan_revisi'),
                'tgl_revisi' => now()->format('Y-m-d'),
                'id_dosen' => session('id_role'),
                'id_lpj' => $request->input('id_lpj'),
                'status_revisi' => $request->input('status_revisi'),
            ]);
    
            if ($lpj) {
                // Ambil relasi proposal kegiatan terkait
                $proposal = $lpj->proposalKegiatan; // Pastikan relasi di model Lpj sudah dibuat
                if ($proposal) {
                    // Ambil data pengguna terkait proposal
                    $pengaju = $proposal->pengguna; // Relasi ke pengguna dari proposal
                    // Format dokumen yang harus direvisi menjadi string dengan pemisah newline
                    $revisi_items = $request->input('revisi_items', []);
                    $revisi_items_string = implode("\n", $revisi_items);
    
                    if ($pengaju && $pengaju->email) {
                        // Kirim notifikasi email
                        $data_email = [
                            'subject' => 'Revisi LPJ',
                            'sender_name' => 'proposalkupolban@gmail.com',
                            'username' => $pengaju->username, // Username dari pengguna
                            'revisi_items' => $revisi_items_string,
                            'jenis_lpj' => $lpj->jenis_lpj,
                            'isi' => $request->input('catatan_revisi'), // Catatan revisi dari input
                            'route' => 'lpj',
                            'status_revisi' => $request->input('status_revisi'),
                            'id_role' => session('id_role'),
                        ];
    
                        Mail::to($pengaju->email)->send(new kirimEmail($data_email));
                    }
    
                    // Update status LPJ di tabel proposal kegiatan jika sampai tahap akhir (session id = 6)
                    if (session()->has('id_role') && session('id_role') == 5) {
                        $proposal->status_lpj = $request->input('status_revisi');
                    }
    
                    // Update updated_by jika status revisi di tabel revisi LPJ = 1
                    if ($request->input('status_revisi') == 1 && session()->has('id_role')) {
                        $proposal->updated_by = session('id_role') + 1; // Misal role yang melakukan revisi
                    }
    
                    $proposal->save(); // Simpan perubahan pada tabel proposal kegiatan
                }
            }
    
            // Commit transaksi jika semua proses berhasil
            DB::commit();
    
            return redirect('/manajemen-review')
                ->with('success', 'Revisi LPJ berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');
        } catch (TransportException $e) {
            // Rollback transaksi jika pengiriman email gagal
            DB::rollBack();
    
            return redirect('/manajemen-review')
                ->with('error', 'Email gagal dikirim. Data revisi tidak disimpan. Periksa koneksi jaringan Anda.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error lain
            DB::rollBack();
    
            return redirect('/manajemen-review')
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
    

}