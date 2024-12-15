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
        'role',
        'email',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_dosen'); // 'id_dosen' adalah foreign key
    }

}
