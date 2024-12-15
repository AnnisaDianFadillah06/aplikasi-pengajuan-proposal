<?php

namespace App\Http\Controllers;
use App\Models\PengajuanProposal;
use App\Models\ReviewProposal;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace

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

    // Fungsi untuk menampilkan data proposal yang akan direvisi
    public function historiReview($id_proposal)
    {
        // Cari review proposal berdasarkan id_proposal
        $proposal = PengajuanProposal::with('revisions.dosen')->findOrFail($id_proposal);
        return view('proposal_kegiatan.histori_review', compact('proposal'));
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

        // Perbarui status proposal
        $proposal = PengajuanProposal::find($request->input('id_proposal'));
        if ($proposal) {
            $proposal->status = $request->input('status_revisi');
            if ($proposal->status == 1 && session()->has('id')) {
                $proposal->updated_by = session('id');
            }
            $proposal->save();

            // Kirim notifikasi email
            $pengaju = $proposal->pengguna; // Asosiasi ke model Pengaju
            if ($pengaju && $pengaju->email) {
                $data_email = [
                    'subject' => 'Revisi Proposal',
                    'sender_name' => 'proposalkupolban@gmail.com',
                    'judul' => $proposal->nama_kegiatan,
                    'username' => $pengaju->username,
                    'isi' => $request->input('catatan_revisi'),
                ];
                Mail::to($pengaju->email)->send(new kirimEmail($data_email));
            }
        }

        return redirect('/manajemen-review')
    ->with('success', 'Revisi berhasil disimpan, status diperbarui, dan notifikasi email telah dikirim.');

    
    }

}