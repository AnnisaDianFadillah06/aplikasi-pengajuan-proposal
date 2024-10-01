<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua organisasi mahasiswa
        $organisasiMahasiswa = Ormawa::all();


        return view('proposal_kegiatan.manajemen_organisasi_mahasiswa', compact('organisasiMahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_ormawa)
    {
        $organisasiMahasiswa = Ormawa::where('id_ormawa', $id_ormawa)->firstOrFail();
        
        return response()->json($organisasiMahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ormawa $organisasiMahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ormawa $organisasiMahasiswa)
    {
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
    }

    /**
     * Remove the specified resource from storage (soft delete by setting status to 0).
     */
    public function destroy(Ormawa $organisasiMahasiswa)
    {
        // Mengubah status menjadi 0, menandakan bahwa organisasi ini "dihapus"
        $organisasiMahasiswa->update([
            'status' => 0,
            'updated_by' => 2, // Set updated_by dengan id user yang menghapus
        ]);

        return redirect()->route('organisasi-mahasiswa.index')->with('success', 'Organisasi Mahasiswa berhasil dihapus.');
    }
}
