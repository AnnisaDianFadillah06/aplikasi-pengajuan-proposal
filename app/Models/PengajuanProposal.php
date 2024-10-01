<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanProposal extends Model
{
    use HasFactory;

    protected $table = "proposal_kegiatan";
    protected $guarded = ['id_proposal'];
    protected $primaryKey = 'id_proposal';

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_kegiatan');
    }

    // Relasi dengan ormawa
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa');
    }

}