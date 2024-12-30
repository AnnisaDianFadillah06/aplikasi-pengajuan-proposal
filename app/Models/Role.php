<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'roles';

    // Primary key
    protected $primaryKey = 'id_role';

    // Jika tabel tidak memiliki kolom timestamps (created_at dan updated_at)
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'role',
    ];

    /**
     * Relasi ke model Reviewer.
     * Role dapat dimiliki oleh banyak reviewer (hasMany).
     */
    public function reviewers()
    {
        return $this->hasMany(Reviewer::class, 'id_role', 'id_role');
    }
}
