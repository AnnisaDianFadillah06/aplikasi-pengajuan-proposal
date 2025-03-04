<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use App\Models\JenisKegiatan;
use App\Models\BidangKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification


class TambahPengajuanProposal extends Controller
{
    public function index()
    {
        try {
        $ormawas = Ormawa::all();
        // Ambil jenis kegiatan dengan status 'aktif'
        $jenis_kegiatans = JenisKegiatan::where('status', 'aktif')->get();
        // Ambil bidang kegiatan dengan status 'aktif'
        $bidang_kegiatans = BidangKegiatan::where('status', 'aktif')->get();

        return view('proposal_kegiatan.tambah_pengajuan_proposal', compact('jenis_kegiatans', 'ormawas', 'bidang_kegiatans'));
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

    public function add(Request $request) 
    {
        try {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'id_jenis_kegiatan' => 'required',
            'id_bidang_kegiatan' => 'required',
            'id_ormawa' => 'nullable',
            'file_proposal' => 'required|file|mimes:pdf|max:2048',
            'surat_berkegiatan_ketuplak' => 'required|file|mimes:pdf|max:2048',
            'surat_pernyataan_ormawa' => 'required|file|mimes:pdf|max:2048',
            'surat_peminjaman_sarpras' => 'required|file|mimes:pdf|max:2048',
            // 'tanggal_mulai' => 'nullable|date',
            'tanggal_mulai' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minDate = now()->addDays(6)->startOfDay();
                    if (Carbon::parse($value)->lt($minDate)) {
                        $fail('Tanggal kegiatan harus lebih dari 5 hari dari hari ini.');
                    }
                },
            ],
            'tanggal_akhir' => 'required|date',
            'dana_dipa' => 'nullable|numeric|min:0',
            'dana_swadaya' => 'nullable|numeric|min:0',
            'dana_sponsor' => 'nullable|numeric|min:0',
            'pengisi_acara' => 'nullable|string|max:255',
            'sponsorship' => 'nullable|string|max:255',
            'media_partner' => 'nullable|string|max:255',
            'jumlah_spj' => 'required|numeric|min:1',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'email_penanggung_jawab' => 'required|email|max:255',
            'no_hp_penanggung_jawab' => 'required|string|max:15',
            'poster_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'caption_poster' => 'nullable|string|max:1000',
            'jml_peserta' => 'required|integer|min:0',
            'jml_panitia' => 'required|integer|min:0',
            'link_surat_izin_ortu' => 'required|url|max:255',
        ]);

        $id_pengaju = session('id'); // Ambil id pengguna dari session

        $file_proposal = $request->file('file_proposal');
        $file_berkegiatan_ketuplak = $request->file('surat_berkegiatan_ketuplak');
        $file_pernyataan_ormawa = $request->file('surat_pernyataan_ormawa');
        $file_peminjaman_sarpras = $request->file('surat_peminjaman_sarpras');

        $file_proposal_path = $file_proposal ? 'laraview/' . time() . '_' . $file_proposal->getClientOriginalName() : null;
        $file_berkegiatan_ketuplak_path = $file_berkegiatan_ketuplak ? 'laraview/' . time() . '_' . $file_berkegiatan_ketuplak->getClientOriginalName() : null;
        $file_pernyataan_ormawa_path = $file_pernyataan_ormawa ? 'laraview/' . time() . '_' . $file_pernyataan_ormawa->getClientOriginalName() : null;
        $file_peminjaman_sarpras_path = $file_peminjaman_sarpras ? 'laraview/' . time() . '_' . $file_peminjaman_sarpras->getClientOriginalName() : null;

        if ($file_proposal) {
            $file_proposal->move(public_path('laraview'), $file_proposal_path);
        }
        if ($file_berkegiatan_ketuplak) {
            $file_berkegiatan_ketuplak->move(public_path('laraview'), $file_berkegiatan_ketuplak_path);
        }
        if ($file_pernyataan_ormawa) {
            $file_pernyataan_ormawa->move(public_path('laraview'), $file_pernyataan_ormawa_path);
        }
        if ($file_peminjaman_sarpras) {
            $file_peminjaman_sarpras->move(public_path('laraview'), $file_peminjaman_sarpras_path);
        }
        $poster_path = null;
        if ($request->hasFile('poster_kegiatan')) {
            $poster = $request->file('poster_kegiatan');
            $poster_path = 'laraview/' . time() . '_' . $poster->getClientOriginalName();
            $poster->move(public_path('laraview'), $poster_path);
        }

        // Tentukan nilai status_spj berdasarkan jumlah_spj
        $statusSpj = $request->input('jumlah_spj') == 0 ? 1 : 0;

        $query = DB::table('proposal_kegiatan')->insert([
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'tmpt_kegiatan' => $request->input('tempat_kegiatan'),
            // 'tgl_kegiatan' => $request->input('tanggal_kegiatan'),
            'file_proposal' => $file_proposal_path,
            'surat_berkegiatan_ketuplak' => $file_berkegiatan_ketuplak_path,
            'surat_pernyataan_ormawa' => $file_pernyataan_ormawa_path,
            'surat_peminjaman_sarpras' => $file_peminjaman_sarpras_path,
            'id_jenis_kegiatan' => $request->input('id_jenis_kegiatan'),
            'id_bidang_kegiatan' => $request->input('id_bidang_kegiatan'),
            'id_ormawa' => session('id_ormawa'),
            'id_pengguna' => $id_pengaju,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $id_pengaju,
            'updated_by' => 1,
            'status' => 0, // Default status
            'status_spj' => $statusSpj,
            'status_kegiatan' => 3, // Default kegiatan status
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            'dana_dipa' => $request->input('dana_dipa', 0),
            'dana_swadaya' => $request->input('dana_swadaya', 0),
            'dana_sponsor' => $request->input('dana_sponsor', 0),
            'pengisi_acara' => $request->input('pengisi_acara'),
            'sponsorship' => $request->input('sponsorship'),
            'media_partner' => $request->input('media_partner'),
            'jumlah_spj' => $request->input('jumlah_spj', 1),
            'nama_penanggung_jawab' => $request->input('nama_penanggung_jawab'),
            'email_penanggung_jawab' => $request->input('email_penanggung_jawab'),
            'no_hp_penanggung_jawab' => $request->input('no_hp_penanggung_jawab'),
            'poster_kegiatan' => $poster_path,
            'caption_poster' => $request->input('caption_poster'),
            'jml_peserta' => $request->input('jml_peserta', 0),
            'jml_panitia' => $request->input('jml_panitia', 0),
            'link_surat_izin_ortu' => $request->input('link_surat_izin_ortu'),
        ]);

        if ($query) {
            return redirect('/pengajuan-proposal')->with('sukses', 'Data berhasil tersimpan');
        } else {
            return redirect('/pengajuan-proposal')->with('error', 'Terjadi kesalahan');
        } 
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