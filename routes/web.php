<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProposalController;

Route::get('/', function () {
    return view('welcome');
});
// Route ANNISA DIAN FADILLAH
Route::get('/manajemen-review', [ReviewController::class, 'index']);

// Route DHEA PUTRI ANANDA
Route::get('/modal', function () {
    return view('proposal_kegiatan.komponen-modal'); // Pastikan ini benar
});
Route::get('/modal', [ProposalController::class, 'index']) 
->name('pengajuan.kegiatan');

Route::get('/pengajuan-kegiatan', [ProposalController::class, 'index']) 
->name('pengajuan.kegiatan');


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