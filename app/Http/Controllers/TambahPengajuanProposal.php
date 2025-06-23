<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ormawa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\BidangKegiatan;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ReviewController;

class TambahPengajuanProposal extends Controller
{
    public function index()
    {
        $ormawas = Ormawa::all();
        // Ambil jenis kegiatan dengan status 'aktif'
        $jenis_kegiatans = JenisKegiatan::where('status', 'aktif')->get();
        // Ambil bidang kegiatan dengan status 'aktif'
        $bidang_kegiatans = BidangKegiatan::where('status', 'aktif')->get();

        return view('proposal_kegiatan.tambah_pengajuan_proposal', compact('jenis_kegiatans', 'ormawas', 'bidang_kegiatans'));
    }

    public function add(Request $request) 
    {
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
                    $minDate = now()->addDays(14)->startOfDay();
                    if (Carbon::parse($value)->lt($minDate)) {
                        $fail('Tanggal kegiatan harus lebih dari 14 hari dari hari ini.');
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
            'no_hp_penanggung_jawab' => [
                'required',
                'string',
                'regex:/^[0-9]{10,15}$/', // Hanya angka, panjang 10-15 karakter
            ],
            'poster_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'caption_poster' => 'nullable|string|max:1000',
            'jml_peserta' => 'required|integer|min:0',
            'jml_panitia' => 'required|integer|min:0',
            'link_surat_izin_ortu' => 'required|url|max:255',
        ], [
            'no_hp_penanggung_jawab.required' => 'Nomor HP penanggung jawab wajib diisi.',
            'no_hp_penanggung_jawab.regex' => 'Nomor HP harus berupa angka dan memiliki panjang antara 10 hingga 15 karakter.',
        ]);

        $id_pengaju = session('id'); // Ambil id pengguna dari session

        $basePath = 'uploads/';
        if (!Storage::exists($basePath)) {
            Storage::makeDirectory($basePath); // Membuat folder jika belum ada
        }

        $filePaths = [];

        // Fungsi untuk menyimpan file dan menghasilkan nama file
        $saveFile = function ($file, $key) use ($basePath, &$filePaths) {
            if ($file) {
                $newFileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '_') . '.' . $file->getClientOriginalExtension();
                $file->storeAs($basePath, $newFileName);
                $filePaths[$key] = $newFileName; // Simpan nama file saja
            }
        };

        // Simpan setiap file
        $saveFile($request->file('file_proposal'), 'file_proposal');
        $saveFile($request->file('surat_berkegiatan_ketuplak'), 'surat_berkegiatan_ketuplak');
        $saveFile($request->file('surat_pernyataan_ormawa'), 'surat_pernyataan_ormawa');
        $saveFile($request->file('surat_peminjaman_sarpras'), 'surat_peminjaman_sarpras');

        // Optional: Simpan poster jika ada
        $posterPath = null;
        if ($request->hasFile('poster_kegiatan')) {
            $poster = $request->file('poster_kegiatan');
            $newPosterName = time() . '_' . Str::slug(pathinfo($poster->getClientOriginalName(), PATHINFO_FILENAME), '_') . '.' . $poster->getClientOriginalExtension();
            $poster->storeAs($basePath, $newPosterName);
            $posterPath = $newPosterName; // Simpan nama file saja
        }

        // Tentukan nilai status_spj berdasarkan jumlah_spj
        $statusSpj = $request->input('jumlah_spj') == 0 ? 1 : 0;

        $pengajuan = new PengajuanProposal();

        // Set atribut-atributnya
        $pengajuan->nama_kegiatan = $request->input('nama_kegiatan');
        $pengajuan->tmpt_kegiatan = $request->input('tempat_kegiatan');
        // $pengajuan->tgl_kegiatan = $request->input('tanggal_kegiatan');
         $pengajuan->file_proposal = $filePaths['file_proposal'] ?? null;
        $pengajuan->surat_berkegiatan_ketuplak = $filePaths['surat_berkegiatan_ketuplak'] ?? null;
        $pengajuan->surat_pernyataan_ormawa = $filePaths['surat_pernyataan_ormawa'] ?? null;
        $pengajuan->surat_peminjaman_sarpras = $filePaths['surat_peminjaman_sarpras'] ?? null;
        $pengajuan->id_jenis_kegiatan = $request->input('id_jenis_kegiatan');
        $pengajuan->id_bidang_kegiatan = $request->input('id_bidang_kegiatan');
        $pengajuan->id_ormawa = session('id_ormawa');
        $pengajuan->id_pengguna = $id_pengaju;
        $pengajuan->created_at = now();
        $pengajuan->updated_at = now();
        $pengajuan->created_by = $id_pengaju;
        $pengajuan->updated_by = 1;
        $pengajuan->status = 0; // Default status
        $pengajuan->status_spj = $statusSpj;
        $pengajuan->status_kegiatan = 3; // Default kegiatan status
        $pengajuan->tanggal_mulai = $request->input('tanggal_mulai');
        $pengajuan->tanggal_akhir = $request->input('tanggal_akhir');
        $pengajuan->dana_dipa = $request->input('dana_dipa', 0);
        $pengajuan->dana_swadaya = $request->input('dana_swadaya', 0);
        $pengajuan->dana_sponsor = $request->input('dana_sponsor', 0);
        $pengajuan->pengisi_acara = $request->input('pengisi_acara');
        $pengajuan->sponsorship = $request->input('sponsorship');
        $pengajuan->media_partner = $request->input('media_partner');
        $pengajuan->jumlah_spj = $request->input('jumlah_spj', 1);
        $pengajuan->nama_penanggung_jawab = $request->input('nama_penanggung_jawab');
        $pengajuan->email_penanggung_jawab = $request->input('email_penanggung_jawab');
        $pengajuan->no_hp_penanggung_jawab = $request->input('no_hp_penanggung_jawab');
        $pengajuan->poster_kegiatan = $posterPath;
        $pengajuan->caption_poster = $request->input('caption_poster');
        $pengajuan->jml_peserta = $request->input('jml_peserta', 0);
        $pengajuan->jml_panitia = $request->input('jml_panitia', 0);
        $pengajuan->link_surat_izin_ortu = $request->input('link_surat_izin_ortu');

        // Simpan data ke database
        $pengajuan->save();
        // Simpan data ke database dan cek hasilnya
        if ($pengajuan->save()) {
            $proposalController = new ReviewController();
            $proposalController->sendReviewNotificationProposal($pengajuan);
            return redirect('/pengajuan-proposal')->with('sukses', 'Data berhasil tersimpan');
        } else {
            return redirect('/pengajuan-proposal')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
}
