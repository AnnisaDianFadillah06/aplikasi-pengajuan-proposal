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
        'created_by',
        'updated_by',
        'status',
    ];

        // Eloquent akan otomatis mengelola kolom `created_at` dan `updated_at`
        public $timestamps = true;
    
        // Jika `id_jenis_kegiatan` otomatis bertambah, set auto-increment
        public $incrementing = true;
        protected $keyType = 'int';
}

