<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class RoleController extends Controller
{
    // Tampilkan halaman kelola hak akses
    public function manageRoles()
    {
        try {
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
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    // Tambahkan Mahasiswa sebagai Pengaju
    public function assignPengaju(Request $request)
    {
        try {
            DB::connection('pgsql')->table('pengaju')->insert([
                'id' => $request->id,
                'username' => $request->username,
                'nama_lengkap' => $request->username,
                'email' => $request->email,
                'tanggal_bergabung' => now(),
            ]);
            
            return redirect()->route('admin.manageRoles')->with('success', 'Berhasil menambahkan pengaju.');
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }
    
    public function assignReviewer(Request $request)
    {
        try {
            DB::connection('pgsql')->table('reviewer')->insert([
                'id' => $request->id,
                'username' => $request->username,
                'nama_lengkap' => $request->username,
                'email' => $request->email,
                'role' => 'reviewer',
                'tanggal_bergabung' => now(),
            ]);
    
            return redirect()->route('admin.manageRoles')->with('success', 'Berhasil menambahkan reviewer.');
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    public function removePengaju($id)
    {
        try {
            DB::connection('pgsql')->table('pengaju')->where('id', $id)->delete();

            return redirect()->route('admin.manageRoles')->with('success', 'Pengaju berhasil dihapus.');
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    public function removeReviewer($id)
    {
        try {
            // Hapus reviewer berdasarkan ID
            DB::connection('pgsql')->table('reviewer')->where('id', $id)->delete();

            return redirect()->route('admin.manageRoles')->with('success', 'Reviewer berhasil dihapus.');
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

}
