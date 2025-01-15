<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ReviewLPJ;
use Illuminate\Http\Request;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use App\Models\PedomanKemahasiswaan;
use App\Models\ReviewLog;

class DashboardController extends Controller
{
    public function index_pengaju()
    {
    // Ambil semua dokumen dari database
    $documents = PedomanKemahasiswaan::select('nama_pedoman', 'file_pedoman')
    ->where('status', '1')
    ->get();
    
    $userId = session('id'); // Ambil ID pengguna yang sedang login
    $proposals = PengajuanProposal::where('id_pengguna', $userId)->get();

    // Hitung statistik proposal untuk ditampilkan di grafik
    $proposalStats = [
        'lolos_validasi' => $proposals->where('status', 1)->count(),
        'sedang_revisi' => $proposals->where('status', 0)->count(),
        'ditolak' => $proposals->where('status', 2)->count(),
    ];


    // Kirim data ke view
    return view('proposal_kegiatan.dashboard-pengaju', compact('documents', 'proposalStats'));
}

    

    // dashboard untuk reviewer
    public function index(Request $request)
    {
       
        // Mendapatkan username dan role dari sesi ===checking session===
        $username = session('username');
        $role = session('role');

        // Get the selected year from the request or default to the current year
        $year = $request->input('year', date('Y'));
    
        // Fetch proposal counts by month for the selected year
        $allProposals = PengajuanProposal::select(DB::raw('EXTRACT(MONTH FROM tanggal_mulai) as month, status, COUNT(*) as total'))
            ->whereYear('tanggal_mulai', $year) // Filter by the selected year
            ->whereIn('status', [1, 2]) // Only include approved and rejected
            ->groupBy('month', 'status')
            ->get();
        

        // Cari reviewer yang belum melakukan review lebih dari 3 hari
        $overdueReviews = ReviewLog::where('review_status', 'pending')
        ->whereDate('deadline_review', '<', Carbon::now())
        ->with(['proposal', 'reviewer'])
        ->get();

        // Format notifikasi
        $notifications = $overdueReviews->map(function ($review) {
            $namaReviewer = $review->reviewer->nama_lengkap;
            $namaProposal = $review->proposal->nama_kegiatan;
            $deadline = Carbon::parse($review->deadline_review)->format('d F Y');

            return "Perhatian! {$namaReviewer} belum mereview proposal \"{$namaProposal}\" dengan deadline {$deadline}.";
        });


        // Prepare data for the chart
        $labels1 = [];
        $data1Disetujui = [];
        $data1Ditolak = [];
    
        for ($month = 1; $month <= 12; $month++) {
            $labels1[] = date('F', mktime(0, 0, 0, $month, 1)); // Get month names
    
            $data1Disetujui[$month] = 0; // Default value
            $data1Ditolak[$month] = 0; // Default value
        }
    
        foreach ($allProposals as $proposal) {
            if ($proposal->status == 1) {
                $data1Disetujui[$proposal->month] = $proposal->total; // Store approved count
            } elseif ($proposal->status == 2) {
                $data1Ditolak[$proposal->month] = $proposal->total; // Store rejected count
            }
        }

    
        // Siapkan data untuk grafik pie (hanya untuk status 1)
        $proposalsStatus1 = PengajuanProposal::with('ormawa')
            ->whereYear('created_at', $year) // Ambil hanya untuk tahun yang dipilih
            ->where('status', 1)
            ->select('id_ormawa', DB::raw('count(*) as total'))
            ->groupBy('id_ormawa')
            ->get();

        $labels2 = [];
        $data2 = [];

        foreach ($proposalsStatus1 as $proposal) {
            $labels2[] = $proposal->ormawa->nama_ormawa; // Dapatkan nama ormawa
            $data2[] = $proposal->total;
        }

        // Ambil tahun untuk dropdown
        // Fetch years for the dropdown
        $years = PengajuanProposal::select(DB::raw('EXTRACT(YEAR FROM tanggal_mulai) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

             // Fetch total approved and rejected proposals for the selected year
        $totalDisetujui = PengajuanProposal::whereYear('tanggal_mulai', $year)
        ->where('status', 1)
        ->count();

        $totalDitolak = PengajuanProposal::whereYear('tanggal_mulai', $year)
            ->where('status', 2)
            ->count();
        
        return view('proposal_kegiatan.dashboard-reviewer', [
            'notifications' => $notifications,
            'labels1' => $labels1,
            'data1Disetujui' => array_values($data1Disetujui),
            'data1Ditolak' => array_values($data1Ditolak),
            'labels2' => $labels2,
            'data2' => $data2,
            'years' => $years,
            'selectedYear' => $year, // Kirimkan tahun yang dipilih ke view
            'totalDisetujui' => $totalDisetujui,  // Total disetujui
            'totalDitolak' => $totalDitolak,      // Total ditolak
            // 'proposal' => $proposal,
            'username' => $username, // Tambahkan ke view ===checking session===
            'role' => $role,         // Tambahkan ke view ===checking session===
        ]);
    }
}
