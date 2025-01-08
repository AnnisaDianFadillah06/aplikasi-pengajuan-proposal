<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanProposal extends Model
{
    use HasFactory;

    protected $table = "proposal_kegiatan";
    protected $primaryKey = 'id_proposal';
    protected $guarded = ['id_proposal'];

    protected $fillable = [
        'nama_kegiatan',
        'tmpt_kegiatan',
        'tgl_kegiatan', // ini jadi gakepake kan ya diganti tanggal_mulai tanggal_akhir kan?
        'file_proposal',
        'surat_berkegiatan_ketuplak',
        'surat_pernyataan_ormawa',
        'surat_kesediaan_pendampingan',
        'surat_peminjaman_sarpras',
        'id_jenis_kegiatan',
        'id_bidang_kegiatan',
        'id_ormawa',
        'id_pengguna',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'status',
        'status_lpj',
        'status_kegiatan',
        'tanggal_mulai',
        'tanggal_akhir',
        'qr_code_path',
        'proposal_url_path',
        'jml_peserta',
        'jml_panitia',
        'link_surat_izin_ortu',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_kegiatan', 'id_jenis_kegiatan');
    }
    
    public function bidangKegiatan()
    {
        return $this->belongsTo(BidangKegiatan::class, 'id_bidang_kegiatan', 'id_bidang_kegiatan');
    }
    
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa', 'id_ormawa');
    }

    public function revisions()
    {
        return $this->hasMany(ReviewProposal::class, 'id_proposal', 'id_proposal');
    }
    public function spjs()
    {
        return $this->hasMany(SPJ::class, 'id_proposal', 'id_proposal');
    }
}
