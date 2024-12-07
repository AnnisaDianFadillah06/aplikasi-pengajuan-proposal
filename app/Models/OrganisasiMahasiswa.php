<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiMahasiswa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'ormawa';
    protected $primaryKey = 'id_ormawa';
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_organisasi_mahasiswa',
        'created_by',
        'updated_by',
        'status',
    ];

        // Eloquent akan otomatis mengelola kolom `created_at` dan `updated_at`
        public $timestamps = true;
    
        // Jika `id_ormawa` otomatis bertambah, set auto-increment
        public $incrementing = true;
        protected $keyType = 'int';
}


