<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\QuizOption;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_image',
        'question_order',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function options()
    {
        return $this->hasMany(QuizOption::class, 'question_id')->orderBy('option_label');
    }
}