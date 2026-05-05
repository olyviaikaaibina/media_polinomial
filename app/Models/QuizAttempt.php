<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $table = 'quiz_attempts';

    protected $fillable = [
        'quiz_id',
        'student_id',
        'started_at',
        'end_at',
        'submitted_at',
        'status',
        'total_questions',
        'correct_answers',
        'wrong_answers',
        'unanswered',
        'score',
        'is_passed',
        'passed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'end_at' => 'datetime',
        'submitted_at' => 'datetime',
        'passed_at' => 'datetime',
        'score' => 'decimal:2',
        'is_passed' => 'boolean',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'student_id');
    }
}