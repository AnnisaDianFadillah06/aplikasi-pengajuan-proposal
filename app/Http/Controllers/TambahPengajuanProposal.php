<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class TambahPengajuanProposal extends Controller
{
    public function index()
    {
        return view('proposal_kegiatan.tambah_pengajuan_proposal');
    }

    public function add(Request $request) 
    {
        $request->validate([
            'nama_kegiatan'=>'required',
            'tempat_kegiatan'=>'required',
            'tanggal_kegiatan'=>'required',
            'jenis_kegiatan'=>'required',
            'ormawa'=>'required',
            'file' => 'required|file|mimes:pdf',
        ]);

        // Konversi jenis kegiatan ke ID yang sesuai
        $id_jenis_kegiatan = null;
        switch($request->input('jenis_kegiatan')) {
            case 'Penalaran dan Keilmuan':
                $id_jenis_kegiatan = 1;
                break;
            case 'Pengabdian':
                $id_jenis_kegiatan = 2;
                break;
            case 'Peminatan':
                $id_jenis_kegiatan = 3;
                break;
            default:
                return back()->with('gagal', 'Jenis kegiatan tidak valid');
        }
        
        // Simpan file yang di-upload
        $filePath = $request->file('file')->store('proposals', 'public');

        //insert ke database
        $query = DB::table('proposal_kegiatan')->insert([
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'tmpt_kegiatan' => $request->input('tempat_kegiatan'),
            'tgl_kegiatan' => $request->input('tanggal_kegiatan'),
            'id_jenis_kegiatan' => $id_jenis_kegiatan,
            // 'id_ormawa' => $request->input('ormawa'),
            'id_ormawa' => 1, //sample
            'id_pengguna' => 1, //sample
            'file_proposal' => $filePath,
            'created_at' => now(),  // Menyimpan nilai waktu saat ini
            'updated_at' => now()   // Menyimpan nilai waktu saat ini
        ]);

        if($query) {
            return back()->with('sukses','Data berhasil tersimpan');
        }else{
            return back()->with('Gagal','Terjadi kesalahan');
        }
        
    }
}
