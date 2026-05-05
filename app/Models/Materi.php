<?php

namespace App\Models;

use App\Models\MaterialProgress;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'bab_id',
        'judul',
        'slug',
        'view_path',
        'urutan',
        'has_latihan',
    ];

    public function bab()
    {
        return $this->belongsTo(Bab::class, 'bab_id');
    }

    public function progresses()
    {
        return $this->hasMany(MaterialProgress::class, 'materi_id');
    }
}