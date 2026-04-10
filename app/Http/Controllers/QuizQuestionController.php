<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    public function index($quizId)
    {
        $quiz = Quiz::with(['bab', 'questions.options'])->findOrFail($quizId);

        return view('guru.manajemensoal', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        DB::transaction(function () use ($request, $quizId) {
            $nextOrder = QuizQuestion::where('quiz_id', $quizId)->max('question_order') + 1;

            $question = QuizQuestion::create([
                'quiz_id' => $quizId,
                'question_text' => $request->question_text,
                'question_image' => null,
                'question_order' => $nextOrder,
            ]);

            $options = [
                'A' => $request->option_a,
                'B' => $request->option_b,
                'C' => $request->option_c,
                'D' => $request->option_d,
            ];

            foreach ($options as $label => $text) {
                QuizOption::create([
                    'question_id' => $question->id,
                    'option_label' => $label,
                    'option_text' => $text,
                    'option_image' => null,
                    'is_correct' => $request->correct_option === $label ? 1 : 0,
                ]);
            }

            Quiz::where('id', $quizId)->update([
                'total_questions' => QuizQuestion::where('quiz_id', $quizId)->count()
            ]);
        });

        return redirect()->route('kuis.soal', $quizId)->with('success', 'Soal berhasil ditambahkan.');
    }

    public function show($questionId)
    {
        $question = QuizQuestion::with('options')->findOrFail($questionId);

        return response()->json($question);
    }

    public function update(Request $request, $questionId)
    {
        $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        DB::transaction(function () use ($request, $questionId) {
            $question = QuizQuestion::with('options', 'quiz')->findOrFail($questionId);

            $question->update([
                'question_text' => $request->question_text,
            ]);

            $map = [
                'A' => $request->option_a,
                'B' => $request->option_b,
                'C' => $request->option_c,
                'D' => $request->option_d,
            ];

            foreach ($question->options as $option) {
                $option->update([
                    'option_text' => $map[$option->option_label] ?? '',
                    'is_correct' => $request->correct_option === $option->option_label ? 1 : 0,
                ]);
            }
        });

        $question = QuizQuestion::findOrFail($questionId);
        return redirect()->route('kuis.soal', $question->quiz_id)->with('success', 'Soal berhasil diupdate.');
    }

    public function destroy($questionId)
    {
        $question = QuizQuestion::findOrFail($questionId);
        $quizId = $question->quiz_id;

        DB::transaction(function () use ($question, $quizId) {
            $question->delete();

            $remaining = QuizQuestion::where('quiz_id', $quizId)->orderBy('question_order')->get();

            foreach ($remaining as $index => $item) {
                $item->update(['question_order' => $index + 1]);
            }

            Quiz::where('id', $quizId)->update([
                'total_questions' => QuizQuestion::where('quiz_id', $quizId)->count()
            ]);
        });

        return redirect()->route('kuis.soal', $quizId)->with('success', 'Soal berhasil dihapus.');
    }
}