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
}