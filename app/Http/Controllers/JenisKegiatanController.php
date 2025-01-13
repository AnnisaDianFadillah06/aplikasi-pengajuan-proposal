<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class JenisKegiatanController extends Controller
{
    public function index()
    {
        try {
        // Mendapatkan semua data jenis kegiatan dari database
        $kegiatan = JenisKegiatan::all();
    
        // Menampilkan data ke view 'jenis-kegiatan.index'
        return view('proposal_kegiatan.manajemen_jenis_kegiatan', compact('kegiatan'));
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

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_jenis_kegiatan' => 'required|string|max:255',
                'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
            ]);
        
            // Pastikan ID yang akan digunakan tidak duplikat (opsional, jika ID di-generate manual)
            $nextId = JenisKegiatan::max('id_jenis_kegiatan') + 1;

            // Tambahkan data baru
            $jenisKegiatan = new JenisKegiatan();
            $jenisKegiatan->id_jenis_kegiatan = $nextId; // Atur ID manual (jika tidak pakai sequence)
            $jenisKegiatan->nama_jenis_kegiatan = $request->nama_jenis_kegiatan;
            $jenisKegiatan->created_by = Auth::id() ?? null; // ID user yang sedang login atau null jika belum tersedia
            $jenisKegiatan->updated_by = Auth::id() ?? null;
            $jenisKegiatan->status = $request->status;
            $jenisKegiatan->save();

            // Mengembalikan response JSON untuk AJAX
            return response()->json(['success' => true]);
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
    
    public function update(Request $request, $id)
    {
        try {
            $jenisKegiatan = JenisKegiatan::find($id);
            $jenisKegiatan->nama_jenis_kegiatan = $request->nama_jenis_kegiatan;
            $jenisKegiatan->status = $request->status;
            $jenisKegiatan->save();
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id_jenis_kegiatan' => $jenisKegiatan->id_jenis_kegiatan,
                    'nama_jenis_kegiatan' => $jenisKegiatan->nama_jenis_kegiatan,
                    'status' => $jenisKegiatan->status
                ]);
            }
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