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
        // Get proposal data
        $proposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();

        if (!$proposal) {
            abort(404, 'Proposal tidak ditemukan');
        }

        // Generate QR Code if needed
        $qrCodeFilePath = public_path('qr_codes/qrcode_' . $proposal->id_proposal . '.png');
        if (!file_exists($qrCodeFilePath)) {
            // Create directory if it doesn't exist
            if (!file_exists(public_path('qr_codes'))) {
                mkdir(public_path('qr_codes'), 0755, true);
            }
            
            $proposalUrlPath = '/proposal/' . $proposal->id_proposal . '/detail';
            $fullUrl = config('app.url') . $proposalUrlPath;
            QrCode::size(300)->format('png')->generate($fullUrl, $qrCodeFilePath);
            
            $proposal->qr_code_path = 'qr_codes/qrcode_' . $proposal->id_proposal . '.png';
            $proposal->proposal_url_path = $proposalUrlPath;
            $proposal->save();
        }

        // Get revisions data
        $ormawa = $proposal->ormawa;
        $query = DB::table('revisi_file')
            ->where('id_proposal', $proposal->id_proposal)
            ->where('status_revisi', 1);

        if (str_contains($ormawa, 'UKM') || str_contains($ormawa, 'BEM') || str_contains($ormawa, 'MPM')) {
            $revisions = $query->whereIn('id_dosen', [1, 2, 4, 5])->get();
        } else {
            $revisions = $query->whereIn('id_dosen', [1, 2, 3, 4, 5])->get();
        }

        // Define image paths to be used in the template
        $logoPath = public_path('img/LOGOPOLBAN4K.png');
        $qrPath = $qrCodeFilePath;

        // Load view and generate PDF
        $pdf = PDF::loadView('proposal_kegiatan.halaman_pengesahan', compact(
            'revisions', 
            'proposal', 
            'logoPath',
            'qrPath'
        ));
        
        return $pdf->stream('pengesahan.pdf');
    }
}
