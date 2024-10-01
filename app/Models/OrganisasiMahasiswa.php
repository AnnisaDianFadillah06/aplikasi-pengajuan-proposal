<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiMahasiswa extends Model
{
    // Menentukan tabel yang akan digunakan oleh model (opsional jika tabel sesuai dengan nama model dalam bentuk jamak)
    protected $table = 'ormawa';

    // Kolom-kolom yang bisa diisi secara massal (mass assignment)
    protected $fillable = ['id_ormawa', 'nama_ormawa', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'];
    use HasFactory;
}
