<?php

namespace App\Models;

use App\Models\PengajuanProposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\ManajemenReviewSpjController;
use Illuminate\Support\Facades\Log;
use App\Models\Reviewer;

class Spj extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'spj';

    // Tentukan primary key jika berbeda dari 'id'
    protected $primaryKey = 'id_spj';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'id_proposal',
        'spj_ke',
        'file_sptb',
        'file_spj',
        'dokumen_berita_acara',
        'gambar_bukti_spj',
        'caption_video',
        'video_kegiatan',
        'status',
        'tgl_upload',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    // Tentukan relasi dengan model ProposalKegiatan
    public function proposalKegiatan()
    {
        return $this->belongsTo(PengajuanProposal::class, 'id_proposal','id_proposal');
    }

    protected static function booted()
    {
        static::updated(function ($spj) {
            if ($spj->isDirty([
                'file_sptb',
                'file_spj',
                'dokumen_berita_acara',
                'caption_video',
                'video_kegiatan',
                'status',
                'tgl_upload',
                'updated_at',
                'updated_by',
            ])) {
                $proposalController = new ManajemenReviewSpjController();
                $proposalController->sendReviewNotificationSpj($spj);
            }
        });        
    }
}
