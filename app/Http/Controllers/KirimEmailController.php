<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail; // Pastikan file Mail sesuai namespace

class KirimEmailController extends Controller
{
    public function kirim()
    {
        $pesan = "Hallo ini revisi";
        $data_email = [
            'subject' => 'Coba',
            'sender_name' => 'annisa.dian.tif23@polban.ac.id',
            'isi' => $pesan
        ];

        Mail::to("annisa.dian.tif23@polban.ac.id")->send(new KirimEmail($data_email));
        
        return '<h1>Sukses kirim email</h1>';
    }
}
