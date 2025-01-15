<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Log;


class PengajuanProposal extends Model
{
    use HasFactory;

    protected $table = "proposal_kegiatan";
    protected $primaryKey = 'id_proposal';
    protected $guarded = ['id_proposal'];

    protected $fillable = [
        'nama_kegiatan',
        'tmpt_kegiatan',
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
        'status_spj',
        'status_kegiatan',
        'tanggal_mulai',
        'tanggal_akhir',
        'qr_code_path',
        'proposal_url_path',
        'dana_dipa',
        'dana_swadaya',
        'dana_sponsor',
        'pengisi_acara',
        'sponsorship',
        'media_partner',
        'jumlah_spj',
        'nama_penanggung_jawab',
        'email_penanggung_jawab',
        'no_hp_penanggung_jawab',
        'poster_kegiatan',
        'caption_poster',
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
    public function pengaju()
    {
        return $this->hasMany(Pengguna::class, 'id_ormawa', 'id_ormawa');
    }

    protected static function booted()
    {
        static::updated(function ($proposal) {
            Log::info('Proposal sebelum update:', $proposal->toArray()); // Log data sebelum update
            Log::info('Proposal yang berubah:', $proposal->getDirty());  // Log perubahan yang terjadi
            
            if ($proposal->isDirty([
                'nama_kegiatan',
                'tmpt_kegiatan',
                'file_proposal',
                'surat_berkegiatan_ketuplak',
                'surat_pernyataan_ormawa',
                'surat_kesediaan_pendampingan',
                'surat_peminjaman_sarpras',
                'id_jenis_kegiatan',
                'id_bidang_kegiatan',
                'updated_at',
                'updated_by',
                'status', // ini status umum event, revisi, dsb (status_spj jangan sampai dicek)
                'tanggal_mulai',
                'tanggal_akhir',
                'jml_peserta',
                'jml_panitia',
                'link_surat_izin_ortu',
            ])) {
                Log::info('Data proposal berubah:', $proposal->getDirty());
                $proposalController = new ReviewController();
                $proposalController->sendReviewNotificationProposal($proposal);
            } else {
                Log::info('Tidak ada perubahan yang relevan pada proposal.');
            }
        });
    }

    
}
