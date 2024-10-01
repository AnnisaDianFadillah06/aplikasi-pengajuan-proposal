<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    // Relasi ke model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    // Relasi ke model Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
}
