<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\OrganisasiMahasiswa;
use Illuminate\Support\Facades\Auth;

class OrganisasiMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data organisasi mahasiswa dari database
        $ormawa = OrganisasiMahasiswa::all();
    
        // Menampilkan data ke view 'organisasi-mahasiswa.index'
        return view('proposal_kegiatan.manajemen_organisasi_mahasiswa', compact('ormawa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_organisasi_mahasiswa' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
        ]);
    
        // Tambahkan data baru
        OrganisasiMahasiswa::create([
            'nama_organisasi_mahasiswa' => $request->nama_organisasi_mahasiswa,
            'created_by' => Auth::id() ?? null, // ID user yang sedang login atau null jika belum tersedia
            'updated_by' => Auth::id() ?? null,
            'status' =>  $request->status,
        ]);
    
        // Mengembalikan response JSON untuk AJAX
        return response()->json(['success' => true]);
    }
    

    public function update(Request $request, $id)
    {
        try {
            $organisasiMahasiswa = OrganisasiMahasiswa::find($id);
            $organisasiMahasiswa->nama_organisasi_mahasiswa = $request->nama_organisasi_mahasiswa;
            $organisasiMahasiswa->status = $request->status;
            $organisasiMahasiswa->save();
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id_organisasi_mahasiswa' => $organisasiMahasiswa->id_organisasi_mahasiswa,
                    'nama_organisasi_mahasiswa' => $organisasiMahasiswa->nama_organisasi_mahasiswa,
                    'status' => $organisasiMahasiswa->status
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
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
    
    public function destroy(OrganisasiMahasiswa $organisasiMahasiswa)
    {
        //
    }
}
