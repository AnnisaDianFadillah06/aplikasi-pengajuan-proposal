<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jenis_kegiatan';
    protected $primaryKey = 'id_jenis_kegiatan';
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_jenis_kegiatan',
        'status',
        'created_by',
        'updated_by',
    ];
}