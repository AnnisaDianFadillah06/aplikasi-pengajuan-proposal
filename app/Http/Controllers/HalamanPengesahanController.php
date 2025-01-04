<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Dompdf\Options;
use Dompdf\Dompdf;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\DB;

class HalamanPengesahanController extends Controller
{
    public function showPengesahan($id_proposal)
    {
        // dd($id_proposal);

        $proposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }
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
        $pdf = PDF::loadView('proposal_kegiatan.halaman_pengesahan', compact( 'revisions', 'pic', 'proposal'));
        
        // Return PDF yang di-stream
        return $pdf->stream('pengesahan.pdf');
    }
}
