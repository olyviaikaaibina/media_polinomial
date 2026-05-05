<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class QuizQuestionController extends Controller
{
    public function index($quiz)
    {
        $quiz = Quiz::with(['bab', 'questions.options'])->findOrFail($quiz);

        return view('guru.soal', compact('quiz'));
    }

    public function store(Request $request, $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D,E',
        ]);

        DB::transaction(function () use ($request, $quiz) {
            $nextOrder = (QuizQuestion::where('quiz_id', $quiz)->max('question_order') ?? 0) + 1;

            $imageName = null;

            if ($request->hasFile('question_image')) {
                $file = $request->file('question_image');
                $imageName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/kuis'), $imageName);
            }

            $question = QuizQuestion::create([
                'quiz_id' => $quiz,
                'question_text' => $request->question_text,
                'question_image' => $imageName,
                'question_order' => $nextOrder,
            ]);

            foreach ([
                'A' => $request->option_a,
                'B' => $request->option_b,
                'C' => $request->option_c,
                'D' => $request->option_d,
                'E' => $request->option_e,
            ] as $label => $text) {
                QuizOption::create([
                    'question_id' => $question->id,
                    'option_label' => $label,
                    'option_text' => $text,
                    'is_correct' => $request->correct_option === $label,
                ]);
            }
        });

        return redirect()->route('kuis.soal', $quiz);
    }

    public function show($question)
    {
        $question = QuizQuestion::with('options')->findOrFail($question);

        return response()->json($question);
    }

    public function update(Request $request, $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_image' => 'nullable|boolean',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D,E',
        ]);

        DB::transaction(function () use ($request, $question) {
            $question = QuizQuestion::with('options')->findOrFail($question);

            $imageName = $question->question_image;

            if ($request->remove_image == 1 && $question->question_image) {
                $oldPath = public_path('img/kuis/' . $question->question_image);

                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $imageName = null;
            }

            if ($request->hasFile('question_image')) {
                if ($question->question_image) {
                    $oldPath = public_path('img/kuis/' . $question->question_image);

                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }

                $file = $request->file('question_image');
                $imageName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/kuis'), $imageName);
            }

            $question->update([
                'question_text' => $request->question_text,
                'question_image' => $imageName,
            ]);

            $map = [
                'A' => $request->option_a,
                'B' => $request->option_b,
                'C' => $request->option_c,
                'D' => $request->option_d,
                'E' => $request->option_e,
            ];

            foreach ($question->options as $opt) {
                $opt->update([
                    'option_text' => $map[$opt->option_label],
                    'is_correct' => $request->correct_option === $opt->option_label,
                ]);
            }
        });

        $question = QuizQuestion::findOrFail($question);

        return redirect()->route('kuis.soal', $question->quiz_id);
    }

    public function destroy($question)
    {
        $question = QuizQuestion::findOrFail($question);
        $quizId = $question->quiz_id;

        if ($question->question_image) {
            $imagePath = public_path('img/kuis/' . $question->question_image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $question->delete();

        return redirect()->route('kuis.soal', $quizId);
    }
}