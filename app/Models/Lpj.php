<?php

namespace App\Models;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lpj extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'lpj';

    // Tentukan primary key jika berbeda dari 'id'
    protected $primaryKey = 'id_lpj';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'id_ormawa',
        'file_lpj',
        'jenis_lpj',
        'tgl_upload',
        'created_by',
        'updated_by',
    ];

    // Tentukan relasi dengan model ProposalKegiatan
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa','id_ormawa');
    }
}
