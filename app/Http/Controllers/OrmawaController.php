<?php

namespace App\Http\Controllers;
use App\Models\Ormawa;
use Illuminate\Http\Request;

class OrmawaController extends Controller
{
    public function create()
    {
        // Ambil semua data ormawa
        $ormawas = Ormawa::all();

        // Kirim data ke view
        return view('proposal_kegiatan.tambah_pengajuan_proposal', compact('ormawas'));
    }
}
