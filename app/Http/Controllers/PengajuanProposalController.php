<?php

namespace App\Http\Controllers;

use App\Models\Proposal; // Impor model Proposal
use Illuminate\Http\Request;

class PengajuanProposalController extends Controller
{
    public function index()
    {
        return view('proposal_kegiatan.manajemen_review');
    }
}
