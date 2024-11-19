<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrmawaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewerAuthController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\MahasiswaAuthController;
use App\Http\Controllers\TambahPengajuanProposal;
use App\Http\Controllers\HistoriPengajuanController;
use App\Http\Controllers\PengajuanProposalController;

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

// Route untuk menampilkan detail proposal dengan navigasi multipage
Route::get('/detail-proposal/{id_proposal}', [PengajuanProposalController::class, 'show'])->name('proposal.detail'); //route untuk detail_proposal
// Route untuk Next Step dan Previous Step
Route::post('/detail-proposal/{id_proposal}/next', [PengajuanProposalController::class, 'nextStep'])->name('proposal.nextStep');
Route::post('/detail-proposal/{id_proposal}/prev', [PengajuanProposalController::class, 'prevStep'])->name('proposal.prevStep');
// Upload revisi
Route::post('/upload-file/{id_proposal}', [PengajuanProposalController::class, 'uploadFile'])->name('proposal.uploadFileRevisi');
// Bukti proposal disetujui WD3
Route::get('/proposal/{id_proposal}/approval-proof', [PengajuanProposalController::class, 'approvalProof'])->name('proposal.approvalProof');
//Masuk tahap LPJ
Route::post('/proposal/{id_proposal}/form-lpj', [PengajuanProposalController::class, 'formLPJ'])->name('proposal.formLPJ');
// submit LPJ
Route::post('/proposal/{id_proposal}/submit-lpj', [PengajuanProposalController::class, 'submitLPJ'])->name('proposal.submitLPJ');
// Route untuk menampilkan detail lpj dengan navigasi
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.detail');
// Route untuk Next Step dan Previous Step
Route::post('/detail-laporan/{id_proposal}/next', [LaporanController::class, 'nextStep'])->name('laporan.nextStep');
Route::post('/detail-laporan/{id_proposal}/prev', [LaporanController::class, 'prevStep'])->name('laporan.prevStep');
// Bukti LPJ disetujui WD3
Route::get('/proposal/{id_proposal}/approval-proof', [LaporanController::class, 'approvalProof'])->name('laporan.approvalProof');

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
Route::get('/dashboard-pengaju', function () {
    return view('dashboard-pengaju');
});

Route::get('/dashboard-reviewer', [DashboardController::class, 'index']);


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