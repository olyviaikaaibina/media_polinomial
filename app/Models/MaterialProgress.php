<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialProgress extends Model
{
    protected $table = 'material_progress';

    protected $fillable = [
        'student_id',
        'materi_id',
        'is_opened',
        'is_completed',
        'opened_at',
        'completed_at',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}