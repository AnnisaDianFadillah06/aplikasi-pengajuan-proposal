<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($filename)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::guard('mahasiswa')->check() && !Auth::guard('dosen')->check()) {
            return redirect()->route('login.mahasiswa');
        }
        
        // Dapatkan data pengguna yang sedang login
        // $user = Auth::guard('mahasiswa')->check() ? Auth::guard('mahasiswa')->user() : Auth::guard('dosen')->user();
        
        $id = session('id');
        // dd($id, $filename);

        // Lokasi file privat
        $path = storage_path("app/uploads/{$filename}");

        // Periksa apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        // Kirim file sebagai respons
        return response()->file($path);
    }

    public function showQRCode($filename)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::guard('mahasiswa')->check() && !Auth::guard('dosen')->check()) {
            return redirect()->route('login.mahasiswa');
        }
        
        // Dapatkan data pengguna yang sedang login
        // $user = Auth::guard('mahasiswa')->check() ? Auth::guard('mahasiswa')->user() : Auth::guard('dosen')->user();
        
        $id = session('id');
        // dd($id, $filename);

        // Lokasi file privat
        $path = storage_path("app/qr_codes/{$filename}");

        // Periksa apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        // Kirim file sebagai respons
        return response()->file($path);
    }

    public function showLogo($filename)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::guard('mahasiswa')->check() && !Auth::guard('dosen')->check()) {
            return redirect()->route('login.mahasiswa');
        }
        
        // Dapatkan data pengguna yang sedang login
        // $user = Auth::guard('mahasiswa')->check() ? Auth::guard('mahasiswa')->user() : Auth::guard('dosen')->user();
        
        $id = session('id');
        // dd($id, $filename);

        // Lokasi file privat
        $path = storage_path("app/imglogo/{$filename}");

        // Periksa apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        // Kirim file sebagai respons
        return response()->file($path);
    }

    public function download($filename)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::guard('mahasiswa')->check() && !Auth::guard('dosen')->check()) {
            return redirect()->route('login.mahasiswa');
        }

        // Lokasi file privat
        $path = storage_path("app/uploads/{$filename}");

        // Periksa apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        // Kirim file sebagai respons untuk didownload
        return response()->download($path);
    }
}
