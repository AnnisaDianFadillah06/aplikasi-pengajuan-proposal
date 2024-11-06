<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BidangKegiatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'bidang_kegiatan';
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_bidang_kegiatan',
    ];
}
