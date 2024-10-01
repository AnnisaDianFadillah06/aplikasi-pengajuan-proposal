<?php

namespace App\Http\Controllers;

use App\Models\OrganisasiMahasiswa;
use Illuminate\Http\Request;

class OrganisasiMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua organisasi mahasiswa
        $organisasiMahasiswa = OrganisasiMahasiswa::all();


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
            'nama_ormawa' => 'required',
        ]);

        // Simpan data organisasi mahasiswa
        OrganisasiMahasiswa::create([
            'id_ormawa' => $validated['id_ormawa'],
            'nama_ormawa' => $validated['nama_ormawa'],
            'created_by' => "Dayen",
            'updated_by' => $validated['created_by'], // Set updated_by sama dengan created_by
            'status' => 1, // Status aktif
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
    public function show(OrganisasiMahasiswa $organisasiMahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganisasiMahasiswa $organisasiMahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrganisasiMahasiswa $organisasiMahasiswa)
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
    public function destroy(OrganisasiMahasiswa $organisasiMahasiswa)
    {
        // Mengubah status menjadi 0, menandakan bahwa organisasi ini "dihapus"
        $organisasiMahasiswa->update([
            'status' => 0,
            'updated_by' => "Dayen Edit", // Set updated_by dengan id user yang menghapus
        ]);

        return redirect()->route('organisasi-mahasiswa.index')->with('success', 'Organisasi Mahasiswa berhasil dihapus.');
    }
}
