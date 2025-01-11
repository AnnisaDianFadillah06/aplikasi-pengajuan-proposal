<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BidangKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class BidangKegiatanController extends Controller
{
    public function index()
    {
        try {
            // Mendapatkan semua data bidang kegiatan dari database
            $kegiatan = BidangKegiatan::all();
        
            // Menampilkan data ke view 'bidang-kegiatan.index'
            return view('proposal_kegiatan.manajemen_bidang_kegiatan', compact('kegiatan'));
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
                'nama_bidang_kegiatan' => 'required|string|max:255',
                'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
            ]);
    
            // Pastikan ID yang akan digunakan tidak duplikat (opsional, jika ID di-generate manual)
            $nextId = BidangKegiatan::max('id_bidang_kegiatan') + 1;
    
            // Tambahkan data baru
            $bidangKegiatan = new BidangKegiatan();
            $bidangKegiatan->id_bidang_kegiatan = $nextId; // Atur ID manual (jika tidak pakai sequence)
            $bidangKegiatan->nama_bidang_kegiatan = $request->nama_bidang_kegiatan;
            $bidangKegiatan->created_by = Auth::id() ?? null; // ID user yang sedang login atau null jika belum tersedia
            $bidangKegiatan->updated_by = Auth::id() ?? null;
            $bidangKegiatan->status = $request->status;
            $bidangKegiatan->save();
    
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
            $bidangKegiatan = BidangKegiatan::find($id);
            $bidangKegiatan->nama_bidang_kegiatan = $request->nama_bidang_kegiatan;
            $bidangKegiatan->status = $request->status;
            $bidangKegiatan->save();
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id_bidang_kegiatan' => $bidangKegiatan->id_bidang_kegiatan,
                    'nama_bidang_kegiatan' => $bidangKegiatan->nama_bidang_kegiatan,
                    'status' => $bidangKegiatan->status
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