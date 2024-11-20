<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrmawaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\CountdownController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewerAuthController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\MahasiswaAuthController;
use App\Http\Controllers\TambahPengajuanProposal;
use App\Http\Controllers\HistoriPengajuanController;
use App\Http\Controllers\PengajuanProposalController;
use App\Http\Controllers\PedomanKemahasiswaanController;

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

// Route::get('/countdown', function () {
//     return view('proposal_kegiatan.countdown_form');
// });

// routes/web.php
Route::get('/countdown', [CountdownController::class, 'showForm'])->name('proposal_kegiatan.countdown_form');
Route::post('/countdown', [CountdownController::class, 'setCountdown'])->name('proposal_kegiatan.countdown_form');

// Route DHEA PUTRI ANANDA
Route::get('/modal', function () {
    return view('proposal_kegiatan.komponen-modal'); // Pastikan ini benar
});

Route::get('/profil-pengaju', function () {
    return view('proposal_kegiatan.profil_pengaju'); // Pastikan ini benar
});

Route::get('/daftar-ormawa', function () {
    return view('proposal_kegiatan.daftar_ormawa'); // Pastikan ini benar
});
Route::get('/bidang-kegiatan', function () {
    return view('proposal_kegiatan.bidang_kegiatan'); // Pastikan ini benar
});
Route::get('/daftar-pedoman', function () {
    return view('proposal_kegiatan.daftar_pedoman'); // Pastikan ini benar
});
Route::get('/notifikasi', function () {
    return view('proposal_kegiatan.notifikasi'); // Pastikan ini benar
});

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


// ========================================================================================
// AUTHENTICATION ROUTES ==================================================================
Route::controller(AuthController::class)->group(function () {
    // Route::get('/login', 'index')->name('login');
    Route::get('/login-mahasiswa', [AuthController::class, 'showLoginFormMahasiswa'])->name('login.mahasiswa');
    Route::get('/login-dosen', [AuthController::class, 'showLoginFormDosen'])->name('login.dosen');
    
    // Route::post('/login', 'login')->name('login.submit');
    Route::post('/login-mahasiswa', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa.submit');
    Route::get('/check-pengaju', [MahasiswaAuthController::class, 'checkPengaju'])->name('check.pengaju');
    Route::post('/login-dosen', [AuthController::class, 'loginDosen'])->name('login.dosen.submit');
    Route::get('/check-reviewer', [ReviewerAuthController::class, 'checkReviewer'])->name('check.reviewer');

    // Forgot password process
    Route::post('/forgot-password', 'forgotPassword')->name('password.forgot');
    Route::post('/verify-code', 'verifyCode')->name('password.verifyCode');
    Route::get('/reset-password', 'showResetPasswordForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');

    // Logout route should be outside the '/home' route
    Route::post('/logout', 'logout')->name('logout');
});
//---------------------------------------------------------------------------------------

// ================================================================================ Untuk ngebatasin akses antar user (masi dikomen biar ga ganggu pengembangan)
// ============= Penggunaan Middleware untuk Pembatasan Akses =====================
// // Protected routes for mahasiswa
// Route::middleware(['auth:mahasiswa'])->group(function () {
//     Route::get('/dashboard-pengaju', function () {
//         return view('dashboard-pengaju');
//     });
// });

// // Protected routes for dosen
// Route::middleware(['auth:dosen'])->group(function () {
//     Route::get('/dashboard-reviewer', [DashboardController::class, 'index']);
// });

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