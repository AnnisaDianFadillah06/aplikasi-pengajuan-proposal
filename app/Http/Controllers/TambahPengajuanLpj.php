<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lpj;
use App\Models\Ormawa;
use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\BidangKegiatan;
use Illuminate\Support\Facades\DB;

class TambahPengajuanLpj extends Controller
{
    public function index()
    {
        // Ambil id_ormawa dari session
        $idOrmawa = session('id_ormawa');

        // Periksa apakah LPJ 60% sudah ada untuk Ormawa yang sedang login
        $lpj60Exists = Lpj::whereHas('ormawa', function ($query) use ($idOrmawa) {
            $query->where('id_ormawa', $idOrmawa);
        })->where('jenis_lpj', 1)->exists();

        // Periksa apakah LPJ 100% sudah ada untuk Ormawa yang sedang login
        $lpj100Exists = Lpj::whereHas('ormawa', function ($query) use ($idOrmawa) {
            $query->where('id_ormawa', $idOrmawa);
        })->where('jenis_lpj', 2)->exists();

        // Tentukan status berdasarkan keberadaan LPJ
        if (!$lpj60Exists && !$lpj100Exists) {
            $jenisLpjUntukDiisi = 0; // Belum ada LPJ 60% dan 100%
        } elseif ($lpj60Exists && !$lpj100Exists) {
            $jenisLpjUntukDiisi = 1; // Sudah ada LPJ 60%
        } elseif ($lpj100Exists && !$lpj60Exists) {
            $jenisLpjUntukDiisi = 2; // Sudah ada LPJ 100%
        }


        return view('proposal_kegiatan.tambah_pengajuan_lpj', compact('jenisLpjUntukDiisi'));
    }

    public function add(Request $request) 
    {
        $request->validate([
            'jenis_lpj' => 'required',
            'file_lpj' => 'required|file|mimes:pdf|max:2048',
            'file_spj' => 'required|file|mimes:pdf|max:2048',
            'file_sptb' => 'required|file|mimes:pdf|max:2048',
        ]);
    
        // File LPJ
        $fileLpj = $request->file('file_lpj');
        $fileLpjPath = $fileLpj ? 'uploads/lpj/' . time() . '_' . $fileLpj->getClientOriginalName() : null;

        if ($fileLpj) {
            $fileLpj->move(public_path('uploads/lpj'), $fileLpjPath);
        }

        // File SPJ
        $fileSpj = $request->file('file_spj');
        $fileSpjPath = $fileSpj ? 'uploads/spj/' . time() . '_' . $fileSpj->getClientOriginalName() : null;

        if ($fileSpj) {
            $fileSpj->move(public_path('uploads/spj'), $fileSpjPath);
        }

        // File SPTB
        $fileSptb = $request->file('file_sptb');
        $fileSptbPath = $fileSptb ? 'uploads/sptb/' . time() . '_' . $fileSptb->getClientOriginalName() : null;

        if ($fileSptb) {
            $fileSptb->move(public_path('uploads/sptb'), $fileSptbPath);
        }

        $query = DB::table('lpj')->insert([
            'id_ormawa' => session('id_ormawa'),
            'jenis_lpj' => $request->input('jenis_lpj'),
            'file_lpj' => $fileLpjPath,
            'file_spj' => $fileSpjPath,
            'file_sptb' => $fileSptbPath,
            'tgl_upload' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => session('id'),
            'updated_by' => 1,
            'status_spj' => 0,
        ]);

        if ($query) {
            return redirect('/pengajuan-lpj')->with('sukses', 'Data berhasil tersimpan');
        } else {
            return redirect('/pengajuan-lpj')->with('error', 'Terjadi kesalahan');
        }
    }
}
