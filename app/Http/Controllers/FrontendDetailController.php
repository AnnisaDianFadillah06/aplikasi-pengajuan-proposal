<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\Mail; // Impor Mail facade
use Illuminate\Support\Facades\Log; // Impor Log facade
use App\Mail\ErrorNotification; // Impor Mailable ErrorNotification

class FrontendDetailController extends Controller
{
    public function show($id_proposal)
    {
        try {
            // Cari proposal berdasarkan ID
            $proposal = PengajuanProposal::where('id_proposal', $id_proposal)->firstOrFail();

            if (!$proposal) {
                abort(404, 'Proposal tidak ditemukan');
            }
        
            return view('proposal_kegiatan.frontend_detail', compact('proposal'));
        } catch (\Throwable $e) {
            // Kirim notifikasi email
            $developerEmails = explode(',', env('DEVELOPER_EMAILS'));
            foreach ($developerEmails as $email) {
                Mail::to(trim($email))->send(new \App\Mail\ErrorNotification($e));
            }

            // Kembalikan respons error
            return response()->view('errors.500', [], 500);
        }
    }    
}
