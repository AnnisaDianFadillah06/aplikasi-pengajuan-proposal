<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalToken extends Model
{
    use HasFactory;

    protected $table = 'proposal_tokens'; // Nama tabel

    protected $fillable = ['proposal_id', 'token']; // Kolom yang bisa diisi

    // Relasi dengan tabel proposal_kegiatan
    public function proposal()
    {
        return $this->belongsTo(PengajuanProposal::class, 'proposal_id', 'id_proposal');
    }
}
