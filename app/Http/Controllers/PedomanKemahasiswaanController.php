<?php

namespace App\Http\Controllers;

use App\Models\PedomanKemahasiswaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PedomanKemahasiswaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedomanList = PedomanKemahasiswaan::all(); // Ambil semua data pedoman
        return view('proposal_kegiatan.daftar_pedoman', compact('pedomanList'));
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
       // Fungsi untuk menyimpan pedoman baru
       public function store(Request $request)
       {
        //  dd($request->all());
           // Validasi input
           $request->validate([
               'nama_pedoman' => 'required|string|max:255',
               'file_pedoman' => 'required|file|mimes:pdf,doc,docx|max:2048',
               'status' => 'required'
           ]);
   
           // Ambil file yang di-upload
           $file = $request->file('file_pedoman');
   
           // Tentukan nama file dengan prefix 'pedoman_' dan path untuk menyimpan
           $fileName = 'pedoman_' . time() . '_' . $file->getClientOriginalName(); // Generate nama file unik dengan prefix
           $filePath = 'laraview/' . $fileName; // Path untuk disimpan di public/laraview
   
           // Simpan file ke folder public/laraview
           $file->move(public_path('laraview'), $fileName);
   
           // Simpan data ke dalam database
           $pedoman = PedomanKemahasiswaan::create([
               'nama_pedoman' => $request->input('nama_pedoman'),
               'file_pedoman' => $filePath,
               'status' => $request->input('status'),
            //    'created_by' => auth()->id(), // Sesuaikan dengan user ID yang sedang login
            //    'updated_by' => auth()->id()
           ]);
            // Set a success flash message
            session()->flash('alert', [
                'type' => 'success', 
                'message' => 'Data has been saved successfully.'
            ]);
           return redirect()->route('pedoman.index')-> compact('pedoman');
       }

    /**
     * Display the specified resource.
     */
    public function show(PedomanKemahasiswaan $pedomanKemahasiswaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedomanKemahasiswaan $pedomanKemahasiswaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // Fungsi untuk mengedit (update) data pedoman
    public function update(Request $request, $id)
    {   
        // dd($request->all());

        // Temukan data pedoman berdasarkan ID
        $pedoman = PedomanKemahasiswaan::find($id); // Sesuaikan logika ini


        // Validasi input
        $request->validate([
            'edit_name' => 'required|string|max:255',
            'edit_status' => 'required|boolean'
        ]);

        // Update nama pedoman dan status
        $pedoman->nama_pedoman = $request->input('edit_name');
        $pedoman->status = $request->input('edit_status');
        // $pedoman->updated_by = auth()->id();

        // Cek apakah ada file baru yang di-upload
        if ($request->hasFile('file_pedoman_edit')) {
            if (File::exists(public_path($pedoman->file_pedoman))) {
                File::delete(public_path($pedoman->file_pedoman));  // Hapus file lama jika ada
            }
        
            $file = $request->file('file_pedoman_edit');
            $fileName = 'pedoman_' . time() . '_' . $file->getClientOriginalName();
            $filePath = 'laraview/' . $fileName;
        
            // Simpan file baru ke folder public/laraview
            $file->move(public_path('laraview'), $fileName);
        
            // Update path file pada database
            $pedoman->file_pedoman = $filePath;
        }
        
        // Tidak ada perubahan pada file_pedoman, jadi cukup simpan update nama dan status saja
    if (!$request->hasFile('file_pedoman_edit')) {
        // Menjaga file yang lama tetap ada di database
        $pedoman->file_pedoman = $pedoman->file_pedoman;
    }

        // Simpan perubahan
        $pedoman->save();
                    // Set a success flash message
                    session()->flash('alert', [
                        'type' => 'success', 
                        'message' => 'Data has been saved successfully.'
                    ]);
                   return redirect()->route('pedoman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan data pedoman berdasarkan ID
        $pedoman = PedomanKemahasiswaan::findOrFail($id);

        // Hapus file terkait jika ada
        if (File::exists(public_path($pedoman->file_pedoman))) {
            File::delete(public_path($pedoman->file_pedoman));
        }

        // Hapus data pedoman dari database
        $pedoman->delete();

        return redirect()->route('pedoman.index')->with('success', 'Pedoman berhasil didelete');
    }
}
