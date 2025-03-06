<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Dompdf\Options;
use Dompdf\Dompdf;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 
use Illuminate\Support\Facades\Storage;

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
            // Direktori penyimpanan QR Code di storage
            $qrCodeFolder = 'qrcodes/';
            if (!Storage::exists($qrCodeFolder)) {
                Storage::makeDirectory($qrCodeFolder);
            }

            // Tentukan nama file QR Code
            $qrCodeFileName = 'qrcode_' . $proposal->id_proposal . '.png';
            $qrCodeFilePath = $qrCodeFolder . $qrCodeFileName;

            // Buat URL lengkap dari konfigurasi APP_URL
            $fullUrl = config('app.url') . $proposalUrlPath;

            // Generate QR Code dan simpan ke dalam storage
            $qrCode = QrCode::format('png')->size(300)->generate($fullUrl);
            Storage::put($qrCodeFilePath, $qrCode); // Simpan ke storage

            // Simpan path relatif ke database
            $proposal->qr_code_path = $qrCodeFilePath;
            $proposal->proposal_url_path = $proposalUrlPath;
            $proposal->save();
        }

        // Ambil QR Code dari storage
        $qrCodeFilePath2 = Storage::path($proposal->qr_code_path);
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

        // Path gambar di storage
        $storagePath = 'uploads/LOGOPOLBAN4K.png'; 

        // Pastikan file ada sebelum membaca
        if (Storage::exists($storagePath)) {
            $data = Storage::get($storagePath);
            $type = pathinfo($storagePath, PATHINFO_EXTENSION);
            $pic = 'data:image/'.$type.';base64,' . base64_encode($data);
        } else {
            $pic = null; // Handle jika file tidak ditemukan
        }

        // Load view Blade yang ada di folder proposal_kegiatan
        $pdf = PDF::loadView('proposal_kegiatan.halaman_pengesahan', compact( 'revisions', 'pic', 'pic2', 'proposal'));
        
        // Return PDF yang di-stream
        return $pdf->stream('pengesahan.pdf');
    }
}
