<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Proposal extends Model
// {
//     use HasFactory;

//     // Nama tabel yang digunakan oleh model ini
//     protected $table = 't_proposal';

//     // Kolom yang dapat diisi (mass assignable)
//     protected $fillable = [
//         'id_proposal',
//         'nama_kegiatan',
//         'tgl_kegiatan',
//         'tgl_pengajuan',
//         'status_proposal',
//         'tmpt_kegiatan',
//         'file_proposal',
//         'kategori_kegiatan',
//         'asal_ormawa',
//         'id_pengguna',
//     ];
// }

class Proposal extends Model
{
    use HasFactory;
    protected $table = 't_proposal';
    protected $guarded = [];
}