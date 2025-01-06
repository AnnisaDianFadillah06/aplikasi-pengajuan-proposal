<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Dompdf\Options;
use Dompdf\Dompdf;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class HalamanPengesahanController extends Controller
{
    public function showPengesahan($id_proposal)
    {
        // dd($id_proposal);

        $proposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }

       // Dapatkan path relatif URL detail proposal
        $proposalUrlPath = '/proposal/' . $proposal->id_proposal . '/detail';

        // Cek apakah QR Code path sudah ada di database
        if (empty($proposal->qr_code_path)) {
            // Tentukan path untuk menyimpan gambar QR Code
            $qrCodeFilePath = public_path('qr_codes/qrcode_' . $proposal->id_proposal . '.png');
            
            // Buat URL lengkap dari konfigurasi APP_URL
            $fullUrl = config('app.url') . $proposalUrlPath;

            // Generate QR Code dan simpan ke dalam file
            QrCode::size(300)->format('png')->generate($fullUrl, $qrCodeFilePath);

            // Simpan path relatif QR Code dan URL proposal ke database
            $proposal->qr_code_path = '/qr_codes/qrcode_' . $proposal->id_proposal . '.png'; // Path gambar QR Code
            $proposal->proposal_url_path = $proposalUrlPath; // Path URL proposal
            $proposal->save();
        }
        $qrCodeFilePath2 = public_path('qr_codes/qrcode_' . $proposal->id_proposal . '.png');
        // Ambil path QR Code dan URL dari database
        $type2 = pathinfo($qrCodeFilePath2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($qrCodeFilePath2);
        $pic2 = 'data:image/'.$type2.';base64,'. base64_encode($data2);

        // Dapatkan nama Ormawa dari proposal (sesuaikan dengan nama kolom yang relevan)
        $ormawa = $proposal->ormawa; // Asumsikan kolom ini menyimpan nama Ormawa

        // Inisialisasi query untuk tabel revisi_file
        $query = DB::table('revisi_file')
            ->where('id_proposal', $proposal->id_proposal)
            ->where('status_revisi', 1); // yang sudah di approve saja yakni statusnya 1

        // Kondisi khusus untuk Ormawa
        if (str_contains($ormawa, 'UKM') || str_contains($ormawa, 'BEM') || str_contains($ormawa, 'MPM')) {
            // Jika Ormawa adalah UKM, BEM, atau MPM, hanya tampilkan dosen dengan ID role 1, 2, 4, 5
            $revisions = $query->whereIn('id_dosen', [1, 2, 4, 5])->get();
        } else {
            // Selain itu, tampilkan semua data dosen dengan ID role 1, 2, 3, 4, 5
            $revisions = $query->whereIn('id_dosen', [1, 2, 3, 4, 5])->get();
        }

        // Baca gambar dan ubah ke base64
        $path = public_path('img/LOGOPOLBAN4K.png'); // Gambar yang ingin disematkan
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/'.$type.';base64,'. base64_encode($data);

        // Load view Blade yang ada di folder proposal_kegiatan
        $pdf = PDF::loadView('proposal_kegiatan.halaman_pengesahan', compact( 'revisions', 'pic', 'pic2', 'proposal'));
        
        // Return PDF yang di-stream
        return $pdf->stream('pengesahan.pdf');
    }
}
