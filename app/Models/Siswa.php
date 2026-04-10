<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'email',
        'nis',
        'jenis_kelamin',
        'kelas',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}