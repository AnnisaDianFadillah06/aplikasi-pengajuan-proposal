<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewLog extends Model
{
    use HasFactory;

    protected $table = 'review_log';
    protected $primaryKey = 'id_review_log';

    protected $fillable = [
        'id_proposal',
        'id_reviewer',
        'review_status',
        'review_date',
        'deadline_review',
        'review_notes',
    ];

    // Relasi ke tabel proposal_kegiatan
    public function proposal()
    {
        return $this->belongsTo(PengajuanProposal::class, 'id_proposal', 'id_proposal');
    }

    // Relasi ke tabel reviewer
    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'id_reviewer', 'id');
    }
}
