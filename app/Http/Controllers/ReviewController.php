<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('proposal_kegiatan.manajemen_review');
    }
}

// class komponenController extends Controller
// {

// }