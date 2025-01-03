<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use App\Models\JenisKegiatan;
use App\Models\BidangKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TambahPengajuanProposal extends Controller
{
    public function index()
    {
        $ormawas = Ormawa::all();
        $jenis_kegiatans = JenisKegiatan::all();
        $bidang_kegiatans = BidangKegiatan::all();
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
            'file_proposal' => 'required|file|mimes:pdf',
            'surat_berkegiatan_ketuplak' => 'required|file|mimes:pdf',
            'surat_pernyataan_ormawa' => 'required|file|mimes:pdf',
            'surat_kesediaan_pendampingan' => 'required|file|mimes:pdf',
            'surat_peminjaman_sarpras' => 'required|file|mimes:pdf',
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
        ]);

        $id_pengaju = session('id'); // Ambil id pengguna dari session

        $file_proposal = $request->file('file_proposal');
        $file_berkegiatan_ketuplak = $request->file('surat_berkegiatan_ketuplak');
        $file_pernyataan_ormawa = $request->file('surat_pernyataan_ormawa');
        $file_kesediaan_pembina = $request->file('surat_kesediaan_pendampingan');
        $file_peminjaman_sarpras = $request->file('surat_peminjaman_sarpras');

        $file_proposal_path = $file_proposal ? 'laraview/' . time() . '_' . $file_proposal->getClientOriginalName() : null;
        $file_berkegiatan_ketuplak_path = $file_berkegiatan_ketuplak ? 'laraview/' . time() . '_' . $file_berkegiatan_ketuplak->getClientOriginalName() : null;
        $file_pernyataan_ormawa_path = $file_pernyataan_ormawa ? 'laraview/' . time() . '_' . $file_pernyataan_ormawa->getClientOriginalName() : null;
        $file_kesediaan_pembina_path = $file_kesediaan_pembina ? 'laraview/' . time() . '_' . $file_kesediaan_pembina->getClientOriginalName() : null;
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
        if ($file_kesediaan_pembina) {
            $file_kesediaan_pembina->move(public_path('laraview'), $file_kesediaan_pembina_path);
        }
        if ($file_peminjaman_sarpras) {
            $file_peminjaman_sarpras->move(public_path('laraview'), $file_peminjaman_sarpras_path);
        }

        $query = DB::table('proposal_kegiatan')->insert([
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'tmpt_kegiatan' => $request->input('tempat_kegiatan'),
            // 'tgl_kegiatan' => $request->input('tanggal_kegiatan'),
            'file_proposal' => $file_proposal_path,
            'surat_berkegiatan_ketuplak' => $file_berkegiatan_ketuplak_path,
            'surat_pernyataan_ormawa' => $file_pernyataan_ormawa_path,
            'surat_kesediaan_pendampingan' => $file_kesediaan_pembina_path,
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
            'status_lpj' => 0, // Default LPJ status
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
        ]);

        if ($query) {
            return redirect('/pengajuan-proposal')->with('sukses', 'Data berhasil tersimpan');
        } else {
            return redirect('/pengajuan-proposal')->with('error', 'Terjadi kesalahan');
        }
    }
}
