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
        'id_proposal',
        'file_lpj',
        'tgl_upload',
        'created_by',
        'updated_by',
    ];

    // Tentukan relasi dengan model ProposalKegiatan
    public function proposalKegiatan()
    {
        return $this->belongsTo(PengajuanProposal::class, 'id_proposal','id_proposal');
    }
}
