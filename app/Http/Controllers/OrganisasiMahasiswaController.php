<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\OrganisasiMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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
        $request->validate([
            'nama_ormawa' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
        ]);

        try{
            // Tambahkan data baru
            OrganisasiMahasiswa::create([
                'nama_ormawa' => $request->nama_ormawa,
                'created_by' => Auth::id() ?? null, // ID user yang sedang login atau null jika belum tersedia
                'updated_by' => Auth::id() ?? null,
                'status' =>  $request->status,
            ]);
            // Mengembalikan response JSON untuk AJAX
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
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