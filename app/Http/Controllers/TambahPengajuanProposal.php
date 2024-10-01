<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class TambahPengajuanProposal extends Controller
{
    public function index()
    {
        // Ambil semua data ormawa -- agar tampilan dropdown dinamis sesuai dengan database
        $ormawas = Ormawa::all();
        // Ambil semua data jenis kegiatan -- agar tampilan dropdown dinamis sesuai dengan database
        $jenis_kegiatans = JenisKegiatan::all();
        // Kirim data ke view
        return view('proposal_kegiatan.tambah_pengajuan_proposal', compact('jenis_kegiatans','ormawas'));
    }

    public function add(Request $request) 
    {
        $request->validate([
            'nama_kegiatan'=>'required',
            'tempat_kegiatan'=>'required',
            'tanggal_kegiatan'=>'required',
            'id_jenis_kegiatan'=>'required',
            'id_ormawa'=>'required',        //sudah id, karena pada saat form menggunakan akses ke db langsung untuk ormawa
            'file' => 'required|file|mimes:pdf',
        ]);
        
        // Simpan file yang di-upload
        $filePath = $request->file('file')->store('proposals', 'public');

        //insert ke database
        $query = DB::table('proposal_kegiatan')->insert([
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'tmpt_kegiatan' => $request->input('tempat_kegiatan'),
            'tgl_kegiatan' => $request->input('tanggal_kegiatan'),
            'file_proposal' => $filePath,
            'id_jenis_kegiatan' => $request->input('id_jenis_kegiatan'),
            'id_ormawa' => $request->input('id_ormawa'),
            'id_pengguna' => 1, //sample
            'created_at' => now(),  // Menyimpan nilai waktu saat ini
            'updated_at' => now(),   // Menyimpan nilai waktu saat ini
            'status' => 0 //awal mengumpulan diberi status 0 (menunggu)
        ]);

        if($query) {
            // return back()->with('sukses','Data berhasil tersimpan');
            return redirect('/pengajuan-proposal')->with('sukses', 'Data berhasil tersimpan');
        }else{
            // return back()->with('Gagal','Terjadi kesalahan');
            return redirect('/pengajuan-proposal')->with('Gagal','Terjadi kesalahan');
        }
        
    }
}
