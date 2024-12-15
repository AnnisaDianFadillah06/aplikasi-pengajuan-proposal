<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proposal extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'proposal_kegiatan';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_proposal',
        'nama_kegiatan',
        'tgl_kegiatan',
        'tmpt_kegiatan',
        'file_proposal',
        'id_jenis_kegiatan',
        'id_ormawa',
        'id_pengguna',
        'file_lpj',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'status',
        'status_kegiatan',
    ];
}
