<?php

use App\Http\Controllers\PengajuanProposalController;
use App\Http\Controllers\TambahPengajuanProposal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});
// Route ANNISA DIAN FADILLAH
Route::get('/manajemen-review', [ReviewController::class, 'index']);

//Route M. HARISH AL-R.
Route::get('/pengajuan-proposal', [PengajuanProposalController::class, 'index']);

Route::get('/tambah-pengajuan-proposal', [TambahPengajuanProposal::class, 'index']);
Route::post('/add', [TambahPengajuanProposal::class, 'add']);

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