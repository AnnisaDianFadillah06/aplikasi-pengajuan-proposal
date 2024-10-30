<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dosen extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'users'; // Menggunakan koneksi 'users'
    protected $table = 'dosen';      // Menentukan tabel 'dosen'
    protected $primaryKey = 'id';  // Primary key

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
