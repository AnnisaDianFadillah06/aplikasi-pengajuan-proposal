<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use Illuminate\Support\Facades\Auth;

class JenisKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data jenis kegiatan dari database
        $kegiatan = JenisKegiatan::all();
    
        // Menampilkan data ke view 'jenis-kegiatan.index'
        return view('proposal_kegiatan.manajemen_jenis_kegiatan', compact('kegiatan'));
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
            'nama_jenis_kegiatan' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
        ]);
    
        // Tambahkan data baru
        JenisKegiatan::create([
            'nama_jenis_kegiatan' => $request->nama_jenis_kegiatan,
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
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    


    /**
     * Display the specified resource.
     */
    public function show(JenisKegiatan $jenisKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKegiatan $jenisKegiatan)
    {
        //
    }
    
    public function destroy(JenisKegiatan $jenisKegiatan)
    {
        //
    }
}