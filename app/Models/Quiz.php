<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'bab_id',
        'title',
        'description',
        'duration_minutes',
        'total_questions',
        'kkm',
    ];

    public function bab()
    {
        return $this->belongsTo(Bab::class, 'bab_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }
}