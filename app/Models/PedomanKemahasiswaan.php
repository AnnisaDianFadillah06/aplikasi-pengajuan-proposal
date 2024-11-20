<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedomanKemahasiswaan extends Model
{
    use HasFactory;

        // Nama tabel
        protected $table = 'pedoman_kemahasiswaan';

        // Kolom-kolom yang bisa diisi (fillable) melalui mass assignment
        protected $fillable = [
            'id_pedoman',
            'nama_pedoman',
            'file_pedoman',
            'status',
            'created_by',
            'updated_by'
        ];

        protected $primaryKey = 'id_pedoman';
    
        // Jika tabel tidak menggunakan kolom timestamps (created_at dan updated_at), tambahkan ini:
        // public $timestamps = false;
    
        // Definisikan relasi jika ada (misalnya ke model User untuk created_by dan updated_by)
        // public function createdBy()
        // {
        //     return $this->belongsTo(User::class, 'created_by');
        // }
    
        // public function updatedBy()
        // {
        //     return $this->belongsTo(User::class, 'updated_by');
        // }
}
