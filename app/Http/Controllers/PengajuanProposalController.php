<?php

namespace App\Http\Controllers;


use App\Models\PengajuanProposal;

use Illuminate\Http\Request;

class PengajuanProposalController extends Controller
{
    public function index()
    {
        $proposal = PengajuanProposal::all();
        return view('proposal_kegiatan.pengajuan_proposal', ['proposal' => $proposal]);
    }


    public function show($id_proposal)
    {
        // Cek apakah proposal ditemukan
        $proposal = PengajuanProposal::find($id_proposal);

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }

        // Jika ditemukan, kirim data ke view
        return view('proposal_kegiatan.detail_proposal', ['proposal' => $proposal]);
    }

}

