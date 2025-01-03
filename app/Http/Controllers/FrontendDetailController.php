<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendDetailController extends Controller
{
    public function show()
    {
        $proposal = [
            'nama_kegiatan' => 'Seminar Teknologi',
            'tanggal_mulai' => '2024-01-15',
            'tanggal_akhir' => '2024-01-16',
            'tmpt_kegiatan' => 'Aula Kampus',
            'kategori' => 'Seminar',
            'asal_ormawa' => 'Himpunan Mahasiswa Informatika',
            'pengisi_acara' => 'Dr. John Doe',
            'sponsorship' => 'PT. Teknologi Masa Depan',
            'media_partner' => 'Tech Times',
            'dana_dipa' => 5000000,
            'dana_swadaya' => 3000000,
            'dana_sponsor' => 2000000,
        ];
    
        $currentStep = 1; // Nilai default atau logika lainnya untuk menentukan step
    
        return view('proposal_kegiatan.frontend_detail', compact('proposal', 'currentStep'));
    }    
}
