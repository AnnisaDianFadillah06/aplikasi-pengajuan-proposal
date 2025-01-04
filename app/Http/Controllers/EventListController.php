<?php

namespace App\Http\Controllers;

use App\Models\PengajuanProposal;

use Illuminate\Http\Request;

class EventListController extends Controller
{
    public function index(Request $request)
    {
        // Ambil hanya kolom yang diperlukan
        $proposals = PengajuanProposal::select('id_proposal', 'nama_kegiatan', 'tanggal_mulai', 'tmpt_kegiatan', 'status_kegiatan')
        ->whereIn('status_kegiatan', [1, 2, 3]) // Filter berdasarkan status
        ->orderBy('status_kegiatan', 'asc') // Urutkan berdasarkan status_kegiatan secara ascending
        ->get();

        // Kembalikan hasil ke view
        return view('proposal_kegiatan.event_list', compact('proposals'));
    }

    public function show(Request $request, $id_proposal)
    {
        // Cek apakah proposal ditemukan
        $proposal = PengajuanProposal::findOrFail($id_proposal);

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }
        
        return view('proposal_kegiatan.detail_kegiatan', compact('proposal'));
    }
}
