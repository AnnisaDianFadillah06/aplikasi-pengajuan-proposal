<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;

    // Tentukan nama tabel, jika berbeda dengan konvensi penamaan default
    protected $table = 'reviewer';

    // Primary key (default Laravel adalah 'id', jadi ini opsional)
    protected $primaryKey = 'id';

    // Jika tabel tidak memiliki kolom timestamps (created_at dan updated_at)
    public $timestamps = false;

    // Tentukan kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'username',
        'id_role',
        'email',
        'id_ormawa',
    ];

    // relasi ke tabel role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }
    // Relasi ke tabel ormawa
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa', 'id_ormawa');
    }
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class, 'id_dosen'); // 'id_dosen' adalah foreign key
    // }

}
