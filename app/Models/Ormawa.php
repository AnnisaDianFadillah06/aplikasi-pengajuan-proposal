<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ormawa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'ormawa';
    protected $primaryKey = 'id_ormawa';
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_ormawa',
        'status',
        'created_by',
        'updated_by',
    ];


}

