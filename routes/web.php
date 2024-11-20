<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanProposalController;
use App\Http\Controllers\HistoriPengajuanReviewerController;
use App\Http\Controllers\HistoriPengajuanController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\BidangKegiatanController;
use App\Http\Controllers\OrganisasiMahasiswaController;

use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TambahPengajuanProposal;

Route::get('/', function () {
    return view('welcome');
});

// Route ANNISA DIAN FADILLAH
Route::get('/manajemen-review', [ReviewController::class, 'index'])->name('proposal.index');
Route::get('/detail-review/{reviewProposal}', [ReviewController::class, 'show'])->name('proposal.show');
// Rute untuk menyimpan data revisi ke dalam tabel revisi_file
Route::post('/manajemen-review/store', [ReviewController::class, 'store'])->name('proposal.store');


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
Route::get('/histori-pengajuan', [HistoriPengajuanController::class, 'index'])->name('histori.pengajuan');
Route::get('/download-pdf', [HistoriPengajuanController::class, 'downloadPDF'])->name('download.pdf');

Route::get('/histori-pengajuan-reviewer', [HistoriPengajuanReviewerController::class, 'index'])->name('histori.pengajuan-reviewer');
Route::get('/download-pdf', [HistoriPengajuanReviewerController::class, 'downloadPDF'])->name('download.pdf');

Route::get('/jenis-kegiatan', [JenisKegiatanController::class, 'index'])->name('jenis-kegiatan.index');
Route::post('/jenis-kegiatan/store', [JenisKegiatanController::class, 'store'])->name('jenis-kegiatan.store');
Route::put('/update-jenis-kegiatan/{id}', [JenisKegiatanController::class, 'update'])->name('jenis-kegiatan.update');

Route::get('/bidang-kegiatan', [BidangKegiatanController::class, 'index'])->name('bidang-kegiatan.index');
Route::post('/bidang-kegiatan/store', [BidangKegiatanController::class, 'store'])->name('bidang-kegiatan.store');
Route::put('/update-bidang-kegiatan/{id}', [BidangKegiatanController::class, 'update'])->name('bidang-kegiatan.update');

Route::get('/organisasi-mahasiswa', [OrganisasiMahasiswaController::class, 'index'])->name('organisasi-mahasiswa.index');
Route::post('/organisasi-mahasiswa/store', [OrganisasiMahasiswaController::class, 'store'])->name('organisasi-mahasiswa.store');
Route::put('/update-organisasi-mahasiswa/{id}', [OrganisasiMahasiswaController::class, 'update'])->name('organisasi-mahasiswa.update');


// Route TEMPLATE
Route::get('/profile', function () {
    return view('profile');
});

Route::get('/billing', function () {
    return view('billing');
});

// Route Timothy Elroy
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/dashboard-reviewer', function () {
    return view('dashboard-reviewer');
});

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