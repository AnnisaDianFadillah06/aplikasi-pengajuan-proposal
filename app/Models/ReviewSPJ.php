<?php

namespace App\Models;

use App\Models\Spj;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewSPJ extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'revisi_spj';

    // Tentukan primary key jika berbeda dari 'id'
    protected $primaryKey = 'id_revisi';

    // Nonaktifkan timestamps
    public $timestamps = false;
    
    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'catatan_revisi',
        'status_revisi',
        'tgl_revisi',
        'id_spj',
        'id_dosen',
        'file_revisi',
    ];

    // Tentukan relasi dengan model Spj
    public function spj()
    {
        return $this->belongsTo(Spj::class, 'id_spj');
    }
    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'id_dosen'); // 'id_dosen' adalah foreign key
    }
}
