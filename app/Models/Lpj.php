<?php

namespace App\Models;

use App\Models\Proposal;
use App\Http\Controllers\ManajemenReviewLpjController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use App\Models\Reviewer;

class Lpj extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'lpj';

    // Tentukan primary key jika berbeda dari 'id'
    protected $primaryKey = 'id_lpj';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'id_ormawa',
        'file_lpj',
        'file_sptb',
        'jenis_lpj',
        'tgl_upload',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'status_lpj'
    ];


    // Tentukan relasi dengan model ProposalKegiatan
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa','id_ormawa');
    }

    protected static function booted()
    {
        static::updated(function ($lpj) {
            Log::info('Lpj sebelum update:', $lpj->toArray()); // Log data sebelum update
            Log::info('Lpj yang berubah:', $lpj->getDirty());  // Log perubahan yang terjadi
            
            if ($lpj->isDirty([
                'file_lpj',
                'file_sptb',
                'jenis_lpj',
                'tgl_upload',
                'updated_at',
                'updated_by',
                'status_lpj'
            ])) {
                Log::info('Data Lpj berubah:', $lpj->getDirty());
                $proposalController = new ManajemenReviewLpjController();
                $proposalController->sendReviewNotificationLpj($lpj);
            } else {
                Log::info('Tidak ada perubahan yang relevan pada lpj.');
            }
        });
    }
}
