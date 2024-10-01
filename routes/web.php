<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\OrganisasiMahasiswaController;

Route::get('/', function () {
    return view('welcome');
});
// Route ANNISA DIAN FADILLAH
Route::get('/jenis-kegiatan', [JenisKegiatanController::class, 'index']);
Route::get('/manajemen-review', [ReviewController::class, 'index'])->name('proposal.index');
Route::get('/detail-review/{reviewProposal}', [ReviewController::class, 'show'])->name('proposal.show');
// Rute untuk menyimpan data revisi ke dalam tabel revisi_file
Route::post('/manajemen-review/store', [ReviewController::class, 'store'])->name('proposal.store');
Route::get('/organisasi-mahasiswa', [OrganisasiMahasiswaController::class, 'index']);

// Route TEMPLATE
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/billing', function () {
    return view('billing');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
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