<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Reviewer;
use App\Models\PengajuanProposal;
use App\Models\SPJ;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil.
     */
    public function index(Request $request)
    {
        // $proposal = SPJ::find(1);
        // $proposal->file_spj = 'Kegiatan Bsssaru Loh';
        // $proposal->save();  // Pastikan untuk menyimpan perubahan
        
        // Asumsikan user login berdasarkan email untuk demonstrasi
        // $email = $request->user()->email; 
        // Pastikan sistem login mengirimkan data user
        // Email yang dicek
        $email = session('email'); // Ganti dengan email dari login (e.g., $request->user()->email)

        // Ambil data pengaju berdasarkan email
        $profilPengaju = Pengguna::where('email', $email)->first();

        // Cek di tabel Reviewer
        $profilReviewer = Reviewer::with('role')->where('email', $email)->first();
        
        $year = $request->input('year', date('Y'));

        if (!$profilPengaju && !$profilReviewer) {
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        // // Ambil data tanggal login terakhir (misalnya, dari kolom last_login)
        // $lastLogin = $profilPengaju->last_login ? $profilPengaju->last_login->format('d F Y, H:i') : 'Belum ada login';

        $userId = session('id'); // Ambil ID pengguna yang sedang login
        $proposals = PengajuanProposal::where('id_pengguna', $userId)->get();

        // Ambil proposal terakhir yang diajukan
        $lastProposal = PengajuanProposal::where('id_pengguna', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        $lastProposalDate = $lastProposal ? $lastProposal->created_at->format('d F Y') : 'Belum ada proposal';
        
        // Ambil SPJ terakhir yang di-upload oleh pengaju
        // $lastSpj = Spj::where('id_pengguna', $userId)
        // ->orderBy('tgl_upload', 'desc')
        // ->first();

        // $lastSpjDate = $lastSpj ? $lastSpj->tgl_upload->format('d F Y') : 'Belum ada SPJ';

        // Hitung jumlah proposal yang disetujui dan ditolak oleh reviewer
        // Hitung total proposal dengan status 1 (disetujui) berdasarkan tahun
        $totalProposalDisetujui = PengajuanProposal::whereYear('created_at', $year)
            ->where('status', 1)
            ->count();
 

        // Hitung statistik proposal untuk ditampilkan di grafik
        $proposalStats = [
            'lolos_validasi' => $proposals->where('status', 1)->count(),
            'sedang_revisi' => $proposals->where('status', 0)->count(),
            'ditolak' => $proposals->where('status', 2)->count(),
            //'lastLogin' => $lastLogin,
            'totalProposalDisetujui' => $totalProposalDisetujui,
            'lastProposalDate' => $lastProposalDate,
            'profilPengaju' => $profilPengaju,
            'profilReviewer' => $profilReviewer
        ];

        return view('proposal_kegiatan.profil_pengaju', compact('totalProposalDisetujui','profilPengaju', 'profilReviewer', 'proposalStats', 'lastProposalDate', 'profilPengaju'));
    }

}
