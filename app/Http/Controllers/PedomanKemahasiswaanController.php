<?php

namespace App\Http\Controllers;

use App\Models\PedomanKemahasiswaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ErrorNotification;

class PedomanKemahasiswaanController extends Controller
{
    public function index()
    {
            $pedomanList = PedomanKemahasiswaan::all(); // Ambil semua data pedoman
            return view('proposal_kegiatan.daftar_pedoman', compact('pedomanList'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pedoman' => 'required|string|max:255',
            'file_pedoman' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required'
        ]);

        // Ambil file yang di-upload
        $file = $request->file('file_pedoman');

        // Tentukan nama file dengan prefix 'pedoman_' dan path untuk menyimpan
        $fileName = 'pedoman_' . time() . '_' . $file->getClientOriginalName();
        $filePath = 'laraview/' . $fileName;

        // Simpan file ke folder public/laraview
        $file->move(public_path('laraview'), $fileName);

        // Simpan data ke dalam database
        PedomanKemahasiswaan::create([
            'nama_pedoman' => $request->input('nama_pedoman'),
            'file_pedoman' => $filePath,
            'status' => $request->input('status'),
        ]);

        // Set a success flash message
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Data pedoman berhasil disimpan.',
        ]);

        // Redirect ke index tanpa compact
        return redirect()->route('pedoman.index');
    }

    public function update(Request $request, $id)
    {
        // Temukan data pedoman berdasarkan ID
        $pedoman = PedomanKemahasiswaan::findOrFail($id);

        // Validasi input
        $request->validate([
            'edit_name' => 'required|string|max:255',
            'edit_status' => 'required|in:0,1',
            'file_pedoman_edit' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Update hanya field yang diperlukan
        $pedoman->nama_pedoman = $request->input('edit_name');
        $pedoman->status = $request->input('edit_status');

        // Jika ada file baru yang di-upload
        if ($request->hasFile('file_pedoman_edit')) {
            // Hapus file lama jika ada
            if (File::exists(public_path($pedoman->file_pedoman))) {
                File::delete(public_path($pedoman->file_pedoman));
            }

            $file = $request->file('file_pedoman_edit');
            $fileName = 'pedoman_' . time() . '_' . $file->getClientOriginalName();
            $filePath = 'laraview/' . $fileName;

            // Simpan file baru ke folder public/laraview
            $file->move(public_path('laraview'), $fileName);

            // Update path file pada database
            $pedoman->file_pedoman = $filePath;
        }

        // Simpan perubahan
        $pedoman->save();

        // Flash message
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Data pedoman berhasil diperbarui.',
        ]);

        return redirect()->route('pedoman.index');
    }


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

        // Set a success flash message
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Pedoman berhasil dihapus.',
        ]);

        return redirect()->route('pedoman.index');
    }
}
