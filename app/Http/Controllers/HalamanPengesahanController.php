<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Dompdf\Options;
use Dompdf\Dompdf;

class HalamanPengesahanController extends Controller
{
    public function showPengesahan()
    {
        // Data dummy untuk pengujian
        $pengajuans = [
            (object)[
                'Nama_Kegiatan' => 'Membuat Saluran Irigasi',
                'Jenis_Kegiatan' => 'Program Kerja',
                'Bidang_Kegiatan' => 'Pengabdian Kepada Masyarakat',
                'Tanggal_Pelaksanaan' => '29 Desember 2024',
                'Tempat_Pelaksanaan' => 'Politeknik Negeri Bandung',
                'Nama_Pengaju' => 'Zahra Costi',
                'NIM_Pengaju' => '231511000',
                'Organisasi_Asal_Pengaju' => 'Himpunan Mahasiswa Komputer ',
                'revisiProposal' => (object)['tgl_revisi' => '2024-12-28']
            ]
        ];

        // Pemetaan validator
        $validator_mapping = [
            'UKM' => ['Validator 1', 'Validator 2'],
            'non-UKM' => ['Validator 3'] // Pastikan key ini ada
        ];

        $validators = [];
        // Iterasi setiap pengajuan
        foreach ($pengajuans as $pengajuan) {
            $organisasi_asal = $pengajuan->Organisasi_Asal_Pengaju;

            // Tentukan validator berdasarkan kata 'UKM' di awal
            if (str_starts_with($organisasi_asal, 'UKM')) {
                $validators = $validator_mapping['UKM'] ?? [];
            } else {
                $validators = $validator_mapping['non-UKM'] ?? [];
            }
        }

        // Baca gambar dan ubah ke base64
        $path = public_path('img/LOGOPOLBAN4K.png'); // Gambar yang ingin disematkan
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/'.$type.';base64,'. base64_encode($data);

        // Load view Blade yang ada di folder proposal_kegiatan
        $pdf = PDF::loadView('proposal_kegiatan.halaman_pengesahan', compact('pengajuans', 'validators', 'pic'));
        
        // Return PDF yang di-stream
        return $pdf->stream('lembar-pengesahan.pdf');
    }
}
