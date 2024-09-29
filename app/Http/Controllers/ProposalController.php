<?php

namespace App\Http\Controllers;

use App\Models\Proposal; // Impor model Proposal
use Illuminate\Http\Request;

class ProposalController extends Controller
{
        public function index(Request $request)
    {
        // Ambil hanya kolom yang diperlukan
        $proposals = Proposal::select('id_proposal', 'nama_kegiatan', 'tgl_kegiatan', 'status_proposal', 'tgl_pengajuan')
        ->get();

        // Kembalikan hasil ke view
        return view('proposal_kegiatan.pengajuan_kegiatan', compact('proposals'));
    }
    
}