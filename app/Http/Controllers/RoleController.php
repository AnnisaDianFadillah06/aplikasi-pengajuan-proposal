<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Ormawa;
use App\Models\Pengguna;
use App\Models\Reviewer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoleController extends Controller
{ 
    // Tampilkan halaman kelola hak akses
    public function manageRoles()
    {
        // Ambil data dari tabel 'pengaju' di koneksi 'pgsql'
        $pengajus = Pengguna::all();

        // Ambil data dari tabel 'reviewer' di koneksi 'pgsql'
        $reviewers = Reviewer::all();

        return view('proposal_kegiatan.manage_roles', compact('pengajus', 'reviewers'));
    }


    public function editPengaju($id)
    {
        $pengaju = DB::connection('pgsql')->table('pengaju')->where('id', $id)->first();

        $ormawas = Ormawa::where('status', 'aktif')->pluck('nama_ormawa', 'id_ormawa');

        return view('proposal_kegiatan.edit_pengaju', compact('pengaju', 'ormawas'));
    }

    public function updatePengaju(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'id_ormawa' => 'required',
            'status' => 'required|in:0,1', // Validasi status, hanya 0 atau 1
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari username lama dari tabel pengaju
        $pengaju = DB::connection('pgsql')->table('pengaju')->where('id', $id)->first();

        if (!$pengaju) {
            return back()->withErrors(['message' => 'Data Pengaju tidak ditemukan.']);
        }

        // Tentukan base path untuk penyimpanan file
        $basePath = 'uploads/';
        if (!Storage::exists($basePath)) {
            Storage::makeDirectory($basePath); // Buat folder jika belum ada
        }

        // Simpan file dan path lama
        $fotoProfilPath = $pengaju->foto_profil; // Path lama
        if ($request->hasFile('foto_profil')) {
            // Hapus foto profil lama jika ada
            if ($pengaju->foto_profil && Storage::exists($basePath . $pengaju->foto_profil)) {
                Storage::delete($basePath . $pengaju->foto_profil);
            }

            // Simpan file foto profil baru
            $newFileName = time() . '_' . Str::slug(pathinfo($request->file('foto_profil')->getClientOriginalName(), PATHINFO_FILENAME), '_') . '.' . $request->file('foto_profil')->getClientOriginalExtension();
            $request->file('foto_profil')->storeAs($basePath, $newFileName);
            $fotoProfilPath = $newFileName; // Simpan nama file saja
        }

        // Update data pengaju
        DB::connection('pgsql')->table('pengaju')->where('id', $id)->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'status' => $validated['status'], // Menyimpan status
            'id_ormawa' => $validated['id_ormawa'], // Menyimpan
            'foto_profil' => $fotoProfilPath, // Menyimpan path foto profil
        ]);

        if ($pengaju) {
            // Update tabel mahasiswa di koneksi 'users'
            DB::connection('users')->table('mahasiswa')->where('username', $pengaju->username)->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('admin.manageRoles')->with('success', 'Data Pengaju berhasil diperbarui.');
    }

    public function editReviewer($id)
    {
        // Ambil data reviewer berdasarkan ID
        $reviewer = DB::connection('pgsql')->table('reviewer')->where('id', $id)->first();

        // Ambil data roles untuk dropdown
        $roles = DB::connection('pgsql')->table('roles')->get();

        $ormawas = Ormawa::where('status', 'aktif')->pluck('nama_ormawa', 'id_ormawa');

        return view('proposal_kegiatan.edit_reviewer', compact('reviewer','roles','ormawas'));
    }

    public function updateReviewer(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'id_role' => 'required|integer',
            'id_ormawa' => 'required',
            'status' => 'required|in:0,1', // Validasi status, hanya 0 atau 1
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari username lama dari tabel pengaju
        $reviewer = DB::connection('pgsql')->table('reviewer')->where('id', $id)->first();

        if (!$reviewer) {
            return back()->withErrors(['message' => 'Data Pengaju tidak ditemukan.']);
        }

        // Tentukan base path untuk penyimpanan file
        $basePath = 'uploads/';
        if (!Storage::exists($basePath)) {
            Storage::makeDirectory($basePath); // Buat folder jika belum ada
        }

        // Simpan file foto profil
        $fotoProfilPath = $reviewer->foto_profil; // Path lama
        if ($request->hasFile('foto_profil')) {
            // Hapus file foto profil lama jika ada
            if ($reviewer->foto_profil && Storage::exists($basePath . $reviewer->foto_profil)) {
                Storage::delete($basePath . $reviewer->foto_profil);
            }

            // Simpan file baru dengan nama unik
            $newFileName = time() . '_' . Str::slug(pathinfo($request->file('foto_profil')->getClientOriginalName(), PATHINFO_FILENAME), '_') . '.' . $request->file('foto_profil')->getClientOriginalExtension();
            $request->file('foto_profil')->storeAs($basePath, $newFileName);
            $fotoProfilPath = $newFileName; // Simpan nama file saja
        }
        
        DB::connection('pgsql')->table('reviewer')->where('id', $id)->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'id_role' => $validated['id_role'],
            'id_ormawa' => $validated['id_ormawa'],
            'status' => $validated['status'], // Menyimpan status
            'foto_profil' => $fotoProfilPath,
        ]);

        if ($reviewer) {
            // Update tabel mahasiswa di koneksi 'users'
            DB::connection('users')->table('dosen')->where('username', $reviewer->username)->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('admin.manageRoles')->with('success', 'Data Reviewer berhasil diperbarui.');
    }

    public function createPengaju()
    {
        $ormawas = Ormawa::where('status', 'aktif')->pluck('nama_ormawa', 'id_ormawa');

        return view('proposal_kegiatan.tambah_pengaju', compact('ormawas'));
    }

    public function storePengaju(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email|unique:pgsql.pengaju,email',
            'id_ormawa' => 'required|exists:pgsql.ormawa,id_ormawa',
            'password' => 'required|min:8',
            'username' => 'required|unique:pgsql.pengaju,username',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tentukan base path untuk penyimpanan file
        $basePath = 'uploads/';
        if (!Storage::exists($basePath)) {
            Storage::makeDirectory($basePath); // Buat folder jika belum ada
        }

        // Proses upload foto profil jika ada
        $fotoProfilPath = null;
        if ($request->hasFile('foto_profil')) {
            // Simpan file foto profil dengan nama unik
            $newFileName = time() . '_' . Str::slug(pathinfo($request->file('foto_profil')->getClientOriginalName(), PATHINFO_FILENAME), '_') . '.' . $request->file('foto_profil')->getClientOriginalExtension();
            $request->file('foto_profil')->storeAs($basePath, $newFileName);
            $fotoProfilPath = $newFileName; // Simpan nama file saja
        }

        // Ambil nama ormawa berdasarkan id_ormawa yang dipilih
        $ormawa = Ormawa::find($validated['id_ormawa']);
        
        // Simpan ke tabel pengaju
        DB::connection('pgsql')->table('pengaju')->insert([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'id_ormawa' => $validated['id_ormawa'],
            'foto_profil' => $fotoProfilPath,
        ]);

        // Simpan juga ke tabel mahasiswa di koneksi 'users'
        DB::connection('users')->table('mahasiswa')->insert([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Enkripsi password
        ]);

        return redirect()->route('admin.manageRoles')->with('success', 'Pengaju berhasil ditambahkan.');
    }

    public function createReviewer()
    {
        // Mengambil data roles untuk dropdown
        $roles = Role::all(); // Mengambil semua data dari tabel roles

        // Mengambil data ormawa yang statusnya 'aktif' untuk dropdown
        $ormawas = Ormawa::where('status', 'aktif')->pluck('nama_ormawa', 'id_ormawa');


        return view('proposal_kegiatan.tambah_reviewer', compact('roles','ormawas'));
    }

    public function storeReviewer(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|unique:pgsql.reviewer,username',
            'email' => 'required|email|unique:pgsql.reviewer,email',
            'id_role' => 'required|exists:pgsql.roles,id_role',
            'id_ormawa' => 'nullable|exists:pgsql.ormawa,id_ormawa',
            'nama_lengkap' => 'required', // Validasi nama lengkap
            'password' => 'required|min:8', // Validasi password
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tentukan base path untuk penyimpanan file
        $basePath = 'uploads/';
        if (!Storage::exists($basePath)) {
            Storage::makeDirectory($basePath); // Buat folder jika belum ada
        }

        // Proses upload foto profil jika ada
        $fotoProfilPath = null;
        if ($request->hasFile('foto_profil')) {
            // Simpan file foto profil dengan nama unik
            $newFileName = time() . '_' . Str::slug(pathinfo($request->file('foto_profil')->getClientOriginalName(), PATHINFO_FILENAME), '_') . '.' . $request->file('foto_profil')->getClientOriginalExtension();
            $request->file('foto_profil')->storeAs($basePath, $newFileName);
            $fotoProfilPath = $newFileName; // Simpan nama file saja
        }

        // Simpan ke tabel reviewer
        DB::connection('pgsql')->table('reviewer')->insert([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'id_role' => $validated['id_role'],
            'id_ormawa' => $validated['id_ormawa'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'foto_profil' => $fotoProfilPath,
        ]);

        // Simpan ke tabel dosen di koneksi 'users'
        DB::connection('users')->table('dosen')->insert([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Enkripsi password
        ]);

        return redirect()->route('admin.manageRoles')->with('success', 'Reviewer berhasil ditambahkan.');
    }


}
