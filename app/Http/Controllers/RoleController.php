<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Tampilkan halaman kelola hak akses
    public function manageRoles()
    {
        // Ambil semua username mahasiswa yang sudah menjadi pengaju
        $pengajuUname = DB::connection('pgsql')->table('pengaju')->pluck('username')->toArray();

        // Ambil semua ID dosen yang sudah menjadi reviewer
        $reviewerUname = DB::connection('pgsql')->table('reviewer')->pluck('username')->toArray();

        // Ambil data mahasiswa yang belum menjadi pengaju
        $mahasiswa = DB::connection('users')->table('mahasiswa')
            ->whereNotIn('username', $pengajuUname)
            ->get();

        // Ambil data dosen yang belum menjadi reviewer
        $dosen = DB::connection('users')->table('dosen')
            ->whereNotIn('username', $reviewerUname)
            ->get();


        $pengaju = DB::connection('pgsql')->table('pengaju')->get();
        $reviewer = DB::connection('pgsql')->table('reviewer')->get();

        return view('proposal_kegiatan.manage_roles', compact('mahasiswa', 'dosen','pengaju','reviewer'));
    }

    // Tambahkan Mahasiswa sebagai Pengaju
    public function assignPengaju(Request $request)
    {
        DB::connection('pgsql')->table('pengaju')->insert([
            'id' => $request->id,
            'username' => $request->username,
            'nama_lengkap' => $request->username,
            'email' => $request->email,
            'tanggal_bergabung' => now(),
        ]);
        
        return redirect()->route('admin.manageRoles')->with('success', 'Berhasil menambahkan pengaju.');
    }
    
    // Tambahkan Dosen sebagai Reviewer
    public function assignReviewer(Request $request)
    {
        DB::connection('pgsql')->table('reviewer')->insert([
            'id' => $request->id,
            'username' => $request->username,
            'nama_lengkap' => $request->username,
            'email' => $request->email,
            'role' => 'reviewer',
            'tanggal_bergabung' => now(),
        ]);

        return redirect()->route('admin.manageRoles')->with('success', 'Berhasil menambahkan reviewer.');
    }

    public function removePengaju($id)
    {
        // Hapus pengaju berdasarkan ID
        DB::connection('pgsql')->table('pengaju')->where('id', $id)->delete();

        return redirect()->route('admin.manageRoles')->with('success', 'Pengaju berhasil dihapus.');
    }

    public function removeReviewer($id)
    {
        // Hapus reviewer berdasarkan ID
        DB::connection('pgsql')->table('reviewer')->where('id', $id)->delete();

        return redirect()->route('admin.manageRoles')->with('success', 'Reviewer berhasil dihapus.');
    }

}
