<?php

namespace App\Http\Controllers;
use App\Models\PengajuanProposal;
use App\Models\ReviewProposal;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $proposal = PengajuanProposal::all();
        return view('proposal_kegiatan.tabel_review', ['proposal' => $proposal]);
    }
    // Fungsi untuk menampilkan data proposal yang akan direvisi
    public function show($id_proposal)
    {
        // Cari review proposal berdasarkan id_proposal
        $reviewProposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();
        
        return view('proposal_kegiatan.manajemen_review', compact('reviewProposal'));
    }
    

    // Fungsi untuk menyimpan data revisi ke dalam tabel revisi_file
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input yang diperlukan untuk menyimpan revisi
        $request->validate([
            // 'catatan_revisi' => 'required|string',
            // 'tgl_revisi' => 'required|date',
            // 'id_dosen' => 'required|integer',
            // 'id_proposal' => 'required|integer',
            'status_revisi' => 'required',
        ]);

        // Menyimpan data revisi ke dalam tabel revisi_file
        ReviewProposal::create([
            'catatan_revisi' => $request->input('catatan_revisi'),
            'tgl_revisi' => now()->format('Y-m-d'),
            'id_dosen' => 1,
            'id_proposal' => $request->input('id_proposal'),
            'status_revisi' => $request->input('status_revisi'),
        ]);

        // Mengubah status di tabel proposal_pengajuan
        $proposal = PengajuanProposal::find($request->input('id_proposal'));
        if ($proposal) {
            // Cek apakah pengguna yang login memiliki ID = 6 (wd 3)
            if (session()->has('id') && session('id') == 6) {
                // Ubah status proposal sesuai input
                $proposal->status = $request->input('status_revisi');
            } elseif($request->input('status_revisi') != 1) {
                $proposal->status = $request->input('status_revisi');
            }
            
            // Periksa apakah status proposal adalah 1 sebelum menetapkan updated_by
            if ($proposal->status == 1 && session()->has('id')) {
                $proposal->updated_by = session('id');
            }


            // Simpan perubahan ke database
            $proposal->save();

        }

        // Redirect ke halaman yang sesuai, misalnya halaman daftar proposal
        return redirect()->route('proposal.index')->with('success', 'Revisi berhasil disimpan dan status proposal telah diperbarui.');
    }

}

// class komponenController extends Controller
// {

// }