<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BidangKegiatan;
use Illuminate\Support\Facades\Auth;

class BidangKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data bidang kegiatan dari database
        $kegiatan = BidangKegiatan::all();
    
        // Menampilkan data ke view 'bidang-kegiatan.index'
        return view('proposal_kegiatan.manajemen_bidang_kegiatan', compact('kegiatan'));
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
            'nama_bidang_kegiatan' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif', // Validasi untuk kolom status
        ]);
    
        // Tambahkan data baru
        BidangKegiatan::create([
            'nama_bidang_kegiatan' => $request->nama_bidang_kegiatan,
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
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    


    /**
     * Display the specified resource.
     */
    public function show(BidangKegiatan $bidangKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BidangKegiatan $bidangKegiatan)
    {
        //
    }
    
    public function destroy(BidangKegiatan $bidangKegiatan)
    {
        //
    }
}