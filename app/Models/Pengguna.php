<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'pengaju';
    protected $fillable = ['id', 'username', 'email']; // Sesuaikan kolom yang ada
    protected $primaryKey = 'id';
}

