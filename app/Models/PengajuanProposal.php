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

    public function ormawa()
    //relasi tabel proposal dengan ormawa
    //Relasi belongs to menunjukkan bahwa model saat ini (model PengajuanProposal) 
    //memiliki foreign key yang mengacu pada model lain (model Ormawa).
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa', 'id_ormawa');
        //parameter ke dua : kolom foreign key di tabel proposals
        //parameter ke tiga : nama primary key di tabel ormawa
    }

    public function jenis_kegiatan()
    //relasi tabel proposal dengan ormawa
    //Relasi belongs to menunjukkan bahwa model saat ini (model PengajuanProposal) 
    //memiliki foreign key yang mengacu pada model lain (model Ormawa).
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_kegiatan', 'id_jenis_kegiatan');
        //parameter ke dua : kolom foreign key di tabel proposals
        //parameter ke tiga : nama primary key di tabel ormawa
    }
}
