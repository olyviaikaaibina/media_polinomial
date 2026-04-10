<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    protected $table = 'bab';

    protected $fillable = [
        'judul',
        'deskripsi',
        'urutan',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'bab_id');
    }
}