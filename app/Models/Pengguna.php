<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'pengaju';
    protected $fillable = ['id', 'username', 'email', 'id_ormawa']; // Sesuaikan kolom yang ada
    protected $primaryKey = 'id';

    // Relasi ke tabel ormawa
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa', 'id_ormawa');
    }
}