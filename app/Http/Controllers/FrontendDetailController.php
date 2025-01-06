<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanProposal;

class FrontendDetailController extends Controller
{
    public function show($id_proposal)
    {
        // Cari proposal berdasarkan ID
        $proposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }
    
        return view('proposal_kegiatan.frontend_detail', compact('proposal'));
    }    
}
