<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CountdownController extends Controller
{
    // Tampilkan form input tanggal dan waktu
    public function showForm()
    {
        return view('proposal_kegiatan.countdown_form');
    }

    // Simpan data countdown ke session
    public function setCountdown(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255', // Validasi judul
            'end_time' => 'required|date|after:now', // Validasi waktu
        ]);

        // Simpan data countdown di session
        session([
            'countdown_title' => $request->title,
            'countdown_end_time' => $request->end_time,
        ]);

        return redirect()->route('proposal_kegiatan.countdown_form')->with('success', 'Countdown berhasil diperbaharui');
    }

}
