<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanProposalController;
use App\Http\Controllers\HistoriPengajuanController;
use App\Http\Controllers\PedomanKemahasiswaanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\OrmawaController;

use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TambahPengajuanProposal;

Route::get('/', function () {
    return view('welcome');
});

// Route ANNISA DIAN FADILLAH
Route::get('/jenis-kegiatan', [JenisKegiatanController::class, 'index']);
Route::get('/manajemen-review', [ReviewController::class, 'index'])->name('proposal.index');
Route::get('/detail-review/{reviewProposal}', [ReviewController::class, 'show'])->name('proposal.show');
// Rute untuk menyimpan data revisi ke dalam tabel revisi_file
Route::post('/manajemen-review/store', [ReviewController::class, 'store'])->name('proposal.store');
Route::get('/organisasi-mahasiswa', [OrmawaController::class, 'index']);
Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('proposal_kegiatan.getChartData');
Route::get('/pedoman-kemahasiswaan', [PedomanKemahasiswaanController::class, 'index'])->name('pedoman.index'); // Untuk menampilkan data
Route::post('/pedoman', [PedomanKemahasiswaanController::class, 'store'])->name('pedoman.store'); // Untuk menyimpan data baru
Route::put('/pedoman/{id}', [PedomanKemahasiswaanController::class, 'update'])->name('pedoman.update'); // Untuk memperbarui data
Route::delete('/pedoman/{id}', [PedomanKemahasiswaanController::class, 'destroy'])->name('pedoman.destroy'); // Untuk menghapus data

Route::get('/countdown', function () {
    return view('proposal_kegiatan.countdown_form');
});

// Route DHEA PUTRI ANANDA
Route::get('/modal', function () {
    return view('proposal_kegiatan.komponen-modal'); // Pastikan ini benar
});
// Route::get('/modal', [ProposalController::class, 'index']) 
// ->name('pengajuan.kegiatan');

//Route M. HARISH AL-R.
Route::get('/pengajuan-proposal', [PengajuanProposalController::class, 'index']);

Route::get('/tambah-pengajuan-proposal', [TambahPengajuanProposal::class, 'index']);
Route::post('/add', [TambahPengajuanProposal::class, 'add']);

Route::get('/detail-proposal/{id_proposal}', [PengajuanProposalController::class, 'show'])->name('proposal.detail'); //route untuk detail_proposal

// Route Angel
Route::get('/histori-pengajuan', [HistoriPengajuanController::class, 'index'])
->name('histori.pengajuan');
Route::get('/download-pdf', [HistoriPengajuanController::class, 'downloadPDF'])
->name('download.pdf');


// Route TEMPLATE
Route::get('/profile', function () {
    return view('profile');
});

Route::get('/billing', function () {
    return view('billing');
});

// Route Timothy Elroy
Route::get('/dashboard-pengaju', [DashboardController::class, 'index_pengaju'])->name('proposal_kegiatan.dashboard-pengaju');
Route::get('/dashboard-reviewer', [DashboardController::class, 'index'])->name('proposal_kegiatan.dashboard-reviewer');
//--------------

Route::get('/rtl', function () {
    return view('rtl');
}); 
Route::get('/sign-in', function () {
    return view('sign-in');
});
Route::get('/sign-up', function () {
    return view('sign-up');
});
Route::get('/tables', function () {
    return view('tables');
});
Route::get('/virtual-reality', function () {
    return view('virtual-reality');
});