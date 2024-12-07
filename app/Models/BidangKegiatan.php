<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BidangKegiatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'bidang_kegiatan';
    protected $primaryKey = 'id_bidang_kegiatan';
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_bidang_kegiatan',
        'status',
        'created_by',
        'updated_by',
    ];

        // Eloquent akan otomatis mengelola kolom `created_at` dan `updated_at`
        public $timestamps = true;
    
        // Jika `id_bidang_kegiatan` otomatis bertambah, set auto-increment
        public $incrementing = true;
        protected $keyType = 'int';
}
