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

}
