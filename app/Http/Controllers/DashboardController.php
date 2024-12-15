<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ReviewLPJ;
use Illuminate\Http\Request;
use App\Models\ReviewProposal;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use App\Models\PedomanKemahasiswaan;

class DashboardController extends Controller
{
    public function index_pengaju()
    {
    // Cek apakah countdown_end_time dan countdown_title ada di session
    $endTime = session('countdown_end_time');
    $title = session('countdown_title');

    // Debugging: Menampilkan nilai session untuk memastikan sudah ada
    // dd($endTime, $title);

    // Jika session kosong, beri nilai default dan lanjutkan
    if (!$endTime || !$title) {
        // Misalnya, beri nilai default jika session kosong
        $endTime = Carbon::now()->addDays(1); // Atau waktu lain sesuai kebutuhan
        $title = 'Judul Default'; // Sesuaikan judul default Anda

        // Anda bisa menambahkan pesan untuk memberitahu pengguna jika waktu countdown belum diset
        session(['countdown_end_time' => $endTime, 'countdown_title' => $title]);
    }

    // Ubah $endTime menjadi objek Carbon
    $end = Carbon::parse($endTime);
    $now = Carbon::now('Asia/Jakarta'); // Menentukan zona waktu Jakarta

    // Hitung sisa waktu
    $remainingTime = $now->diffInSeconds($end, false); // false untuk nilai negatif

    // Menentukan apakah pengajuan sudah ditutup
    $isClosed = false;
    if ($now->greaterThanOrEqualTo($end)) {
        // Jika waktu habis, hapus data dari session
        session()->forget(['countdown_title', 'countdown_end_time']);
        $remainingTime = null;
        $isClosed = true;
    }

    // Ambil semua dokumen dari database
    $documents = PedomanKemahasiswaan::select('nama_pedoman', 'file_pedoman')->get();
    $userId = session('id'); // Ambil ID pengguna yang sedang login
    $proposals = PengajuanProposal::where('id_pengguna', $userId)->get();

    // Hitung statistik proposal untuk ditampilkan di grafik
    $proposalStats = [
        'lolos_validasi' => $proposals->where('status', 1)->count(),
        'sedang_revisi' => $proposals->where('status', 0)->count(),
        'ditolak' => $proposals->where('status', 2)->count(),
    ];


    // Kirim data ke view
    return view('proposal_kegiatan.dashboard-pengaju', compact('documents', 'remainingTime', 'isClosed', 'title', 'proposalStats'));
}

    

    // dashboard untuk reviewer
    public function index(Request $request)
    {
        // Cek apakah countdown_end_time dan countdown_title ada di session
    $endTime = session('countdown_end_time');
    $title = session('countdown_title');

    // Debugging: Menampilkan nilai session untuk memastikan sudah ada
    // dd($endTime, $title);

    // Jika session kosong, beri nilai default dan lanjutkan
    if (!$endTime || !$title) {
        // Misalnya, beri nilai default jika session kosong
        $endTime = Carbon::now()->addDays(1); // Atau waktu lain sesuai kebutuhan
        $title = 'Judul Default'; // Sesuaikan judul default Anda

        // Anda bisa menambahkan pesan untuk memberitahu pengguna jika waktu countdown belum diset
        session(['countdown_end_time' => $endTime, 'countdown_title' => $title]);
    }

    // Ubah $endTime menjadi objek Carbon
    $end = Carbon::parse($endTime);
    $now = Carbon::now('Asia/Jakarta'); // Menentukan zona waktu Jakarta

    // Hitung sisa waktu
    $remainingTime = $now->diffInSeconds($end, false); // false untuk nilai negatif

    // Menentukan apakah pengajuan sudah ditutup
    $isClosed = false;
    if ($now->greaterThanOrEqualTo($end)) {
        // Jika waktu habis, hapus data dari session
        session()->forget(['countdown_title', 'countdown_end_time']);
        $remainingTime = null;
        $isClosed = true;
    }

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

        // $proposal = PengajuanProposal::where('status', 0)->get();
        
        // Ambil ID dari sesi
        $sessionId = session('id');

        if (!$sessionId) {
            // Tangani kasus jika sesi 'id' tidak ada
            abort(403, 'Session ID tidak ditemukan.');
        }
        
        // Ambil semua proposal dengan status_lpj != 1 yang sesuai dengan kondisi
        $proposals = PengajuanProposal::where('updated_by', $sessionId)
                                    ->where('status_lpj', '!=', 1)
                                    ->get();

        // Ambil semua proposal dengan status_lpj = 1
        $lpjs = PengajuanProposal::where('updated_by', $sessionId)
                                ->where('status_lpj', 1)
                                ->get();


        // Ambil revisi terbaru untuk setiap proposal
        $latestRevisions = ReviewProposal::whereIn('id_proposal', $proposals->pluck('id_proposal'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_proposal');
        
        // Ambil revisi terbaru untuk setiap LPJ
        $latestRevisionsLpjs = ReviewLPJ::whereIn('id_proposal', $lpjs->pluck('id_proposal'))
                                        ->orderBy('id_revisi', 'desc')
                                        ->get()
                                        ->groupBy('id_proposal');

        // Gabungkan proposal dengan revisi terakhir
        foreach ($proposals as $proposal) {
            $proposal->latestRevision = $latestRevisions->get($proposal->id_proposal)?->first(); // Ambil revisi terakhir atau null
        }

        // Gabungkan LPJ dengan revisi terakhir
        foreach ($lpjs as $lpj) {
            $lpj->latestRevision = $latestRevisionsLpjs->get($lpj->id_proposal)?->first(); // Ambil revisi terakhir atau null
        }
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
            // 'proposal' => $proposal,
            'username' => $username, // Tambahkan ke view ===checking session===
            'role' => $role,         // Tambahkan ke view ===checking session===
            'proposals' => $proposals,
            'lpjs' => $lpjs,
            'sessionId' => $sessionId, // Kirim sessionId ke view
            'remainingTime' => $remainingTime, 'isClosed', 'title'
        ]);
    }
}
