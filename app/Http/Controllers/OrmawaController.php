<?php

namespace App\Http\Controllers; //ga kepake

use App\Models\Ormawa;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Menampilkan semua organisasi mahasiswa
            $organisasiMahasiswa = Ormawa::all();

            return view('proposal_kegiatan.manajemen_organisasi_mahasiswa', compact('organisasiMahasiswa'));
        }  catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }

    public function create(Request $request)
    {
        try {
        // Validasi input
        $validated = $request->validate([
            'id_ormawa' => 'required|unique:ormawa,id_ormawa',
            'nama_ormawa' => 'required'
        ]);

        // Simpan data organisasi mahasiswa
        Ormawa::create([
            'id_ormawa' => $validated['id_ormawa'],
            'nama_ormawa' => $validated['nama_ormawa'],
            'created_by' => 1,
            'updated_by' => 2, // Set updated_by sama dengan created_by
            'status' => 1 // Status aktif
        ]);
        return redirect()->route('/organisasi-mahasiswa')->with('success', 'Organisasi Mahasiswa berhasil ditambahkan.');
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

    public function show($id_ormawa)
    {
        try {
            $organisasiMahasiswa = Ormawa::where('id_ormawa', $id_ormawa)->firstOrFail();
        
            return response()->json($organisasiMahasiswa);
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

    public function update(Request $request, Ormawa $organisasiMahasiswa)
    {
        try {
        // Validasi input
        $validated = $request->validate([
            'nama_ormawa' => 'required',
            // 'updated_by' => 'required',
        ]);

        // Update data organisasi mahasiswa
        $organisasiMahasiswa->update([
            'nama_ormawa' => $validated['nama_ormawa'],
            'updated_by' => "Dayen Edit",
        ]);

        return redirect()->route('/organisasi-mahasiswa')->with('success', 'Organisasi Mahasiswa berhasil diperbarui.');
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

    public function destroy(Ormawa $organisasiMahasiswa)
    {
        try {
        // Mengubah status menjadi 0, menandakan bahwa organisasi ini "dihapus"
        $organisasiMahasiswa->update([
            'status' => 0,
            'updated_by' => 2, // Set updated_by dengan id user yang menghapus
        ]);

        return redirect()->route('organisasi-mahasiswa.index')->with('success', 'Organisasi Mahasiswa berhasil dihapus.');
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
