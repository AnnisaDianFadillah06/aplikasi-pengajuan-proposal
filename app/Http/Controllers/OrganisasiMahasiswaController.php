<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\OrganisasiMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class OrganisasiMahasiswaController extends Controller
{
    public function index()
    {
        try {
        // Mendapatkan semua data organisasi mahasiswa dari database
        $ormawa = OrganisasiMahasiswa::all();
    
        // Menampilkan data ke view 'organisasi-mahasiswa.index'
        return view('proposal_kegiatan.manajemen_organisasi_mahasiswa', compact('ormawa'));
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
        try{
            $request->validate([
                'nama_ormawa' => 'required|string|max:255',
                'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
            ]);
    
            // Pastikan ID yang akan digunakan tidak duplikat (opsional, jika ID di-generate manual)
            $nextId = OrganisasiMahasiswa::max('id_ormawa') + 1;
    
            // Tambahkan data baru
            $organisasiMahasiswa = new OrganisasiMahasiswa();
            $organisasiMahasiswa->id_ormawa = $nextId; // Atur ID manual (jika tidak pakai sequence)
            $organisasiMahasiswa->nama_ormawa = $request->nama_ormawa;
            $organisasiMahasiswa->created_by = Auth::id() ?? null; // ID user yang sedang login atau null jika belum tersedia
            $organisasiMahasiswa->updated_by = Auth::id() ?? null;
            $organisasiMahasiswa->status = $request->status;
            $organisasiMahasiswa->save();
    
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
            $organisasiMahasiswa = OrganisasiMahasiswa::find($id);
            $organisasiMahasiswa->nama_ormawa = $request->nama_ormawa;
            $organisasiMahasiswa->status = $request->status;
            $organisasiMahasiswa->save();
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id_ormawa' => $organisasiMahasiswa->id_ormawa,
                    'nama_ormawa' => $organisasiMahasiswa->nama_ormawa,
                    'status' => $organisasiMahasiswa->status,       
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