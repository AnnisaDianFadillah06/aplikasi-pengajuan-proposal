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
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_kegiatan', 'id_jenis_kegiatan');
    }

    // Relasi dengan ormawa
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa', 'id_ormawa');
    }

    // relasi dengan tabel revisi
    public function revisions()
    {
        return $this->hasMany(ReviewProposal::class, 'id_proposal', 'id_proposal');
    }

}
