<?php

namespace App\Http\Controllers;

use App\Models\PedomanKemahasiswaan;
use App\Models\PengajuanProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index_pengaju()
    {
        $documents = PedomanKemahasiswaan::all(); // Ambil semua dokumen dari database
        return view('proposal_kegiatan.dashboard-pengaju', compact('documents'));
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
        $allProposals = PengajuanProposal::select(DB::raw('EXTRACT(MONTH FROM tgl_kegiatan) as month, status, COUNT(*) as total'))
            ->whereYear('tgl_kegiatan', $year) // Filter by the selected year
            ->whereIn('status', [1, 2]) // Only include approved and rejected
            ->groupBy('month', 'status')
            ->get();
    
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
    
        // Fetch years for the dropdown
        $years = PengajuanProposal::select(DB::raw('EXTRACT(YEAR FROM tgl_kegiatan) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    

    
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
        $years = PengajuanProposal::select(DB::raw('EXTRACT(YEAR FROM tgl_kegiatan) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

             // Fetch total approved and rejected proposals for the selected year
        $totalDisetujui = PengajuanProposal::whereYear('tgl_kegiatan', $year)
        ->where('status', 1)
        ->count();

        $totalDitolak = PengajuanProposal::whereYear('tgl_kegiatan', $year)
            ->where('status', 2)
            ->count();

        $proposal = PengajuanProposal::where('status', 0)->get();
        return view('proposal_kegiatan.dashboard-reviewer', [
            'labels1' => $labels1,
            'data1Disetujui' => array_values($data1Disetujui),
            'data1Ditolak' => array_values($data1Ditolak),
            'labels2' => $labels2,
            'data2' => $data2,
            'years' => $years,
            'selectedYear' => $year, // Kirimkan tahun yang dipilih ke view
            'totalDisetujui' => $totalDisetujui,  // Total disetujui
            'totalDitolak' => $totalDitolak,      // Total ditolak
            'proposal' => $proposal,
            'username' => $username, // Tambahkan ke view ===checking session===
            'role' => $role,         // Tambahkan ke view ===checking session===
        ]);
    }
    public function dashboard()
    {
        return view('dashboard'); // Nama file Blade untuk dashboard
    }
}
