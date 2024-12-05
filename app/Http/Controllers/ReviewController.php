<?php

namespace App\Http\Controllers;
use App\Models\PengajuanProposal;
use App\Models\ReviewProposal;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }
    
        // Ambil proposal berdasarkan kondisi
        $proposal = PengajuanProposal::where('updated_by', $sessionId)->get();

        // Return ke tampilan
        return view('proposal_kegiatan.tabel_review', ['proposal' => $proposal]);
    }
    // Fungsi untuk menampilkan data proposal yang akan direvisi
    public function show($id_proposal)
    {
        // Cari review proposal berdasarkan id_proposal
        $reviewProposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();
        
        // Cari revisi terbaru berdasarkan id_proposal
        $latestRevision = ReviewProposal::where('id_proposal', $id_proposal)
                                        // ->orderBy('tgl_revisi', 'desc')
                                        ->orderBy('id_revisi', 'desc')
                                        ->first();

        // Pastikan latestRevision ada
        if (!$latestRevision) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada revisi yang ditemukan untuk proposal ini.']);
        }

        return view('proposal_kegiatan.manajemen_review', compact('reviewProposal','latestRevision'));
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
            'id_dosen' => session('id'),
            'id_proposal' => $request->input('id_proposal'),
            'status_revisi' => $request->input('status_revisi'),
        ]);

        // Mengubah status di tabel proposal_pengajuan
        $proposal = PengajuanProposal::find($request->input('id_proposal'));
        if ($proposal) {
            // Cek apakah pengguna yang login memiliki ID = 6 (wd 3) === status disetujui hanya jika sudah sampai di wd3
            if (session()->has('id') && session('id') == 6) {
                // Ubah status proposal sesuai input
                $proposal->status = $request->input('status_revisi');
            }
            
            // Periksa apakah status proposal adalah 1 sebelum menetapkan updated_by
            if ($request->input('status_revisi') == 1 && session()->has('id')) {
                $proposal->updated_by = session('id') + 1 ;
            }
            

            // Simpan perubahan ke database
            $proposal->save();

        }

        // Redirect ke halaman yang sesuai, misalnya halaman daftar proposal
        return redirect()->route('proposal.index')->with('success', 'Revisi berhasil disimpan dan status proposal telah diperbarui.');
    }

}