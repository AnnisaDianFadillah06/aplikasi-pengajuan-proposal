<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lpj;
use App\Models\Ormawa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\BidangKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ManajemenReviewLpjController;

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
        $saveFile($request->file('file_lpj'), 'file_lpj');
        $saveFile($request->file('file_spj'), 'file_spj');
        $saveFile($request->file('file_sptb'), 'file_sptb');

        $lpj = new Lpj();

        // Set atribut-atributnya
        $lpj->id_ormawa = session('id_ormawa');
        $lpj->jenis_lpj = $request->input('jenis_lpj');
        $lpj->file_lpj = $filePaths['file_lpj'] ?? null;
        $lpj->file_spj = $filePaths['file_spj'] ?? null;
        $lpj->file_sptb = $filePaths['file_sptb'] ?? null;
        $lpj->tgl_upload = now();
        $lpj->created_at = now();
        $lpj->updated_at = now();
        $lpj->created_by = session('id');
        $lpj->updated_by = 1;
        $lpj->status_lpj = 0;

        // Simpan data ke database dan cek hasilnya
        if ($lpj->save()) {
            $proposalController = new ManajemenReviewLpjController();
            $proposalController->sendReviewNotificationLpj($lpj);
            return redirect('/pengajuan-lpj')->with('sukses', 'Data berhasil tersimpan');
        } else {
            return redirect('/pengajuan-lpj')->with('error', 'Terjadi kesalahan');
        }
    }
}
