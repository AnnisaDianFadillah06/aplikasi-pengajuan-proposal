<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewProposal extends Model
{
    // Menentukan tabel yang akan digunakan oleh model (opsional jika tabel sesuai dengan nama model dalam bentuk jamak)
    protected $table = 'revisi_file';

    // Kolom-kolom yang bisa diisi secara massal (mass assignment)
    protected $fillable = ['id_revisi', 'catatan_revisi', 'tgl_revisi', 'id_dosen', 'id_proposal', 'status_revisi', 'file_revisi'];
    protected $primaryKey = 'id_revisi';
    // Nonaktifkan timestamps
    public $timestamps = false;

    public function proposal()
    {
        return $this->belongsTo(PengajuanProposal::class, 'id_proposal'); // Ganti 'id_proposal' jika nama kolom foreign key berbeda
    }
    public function reviewer()
    {
        return $this->belongsTo(Role::class, 'id_dosen','id_role'); // 'id_dosen' adalah foreign key
    }
}