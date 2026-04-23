<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizSiswaController extends Controller
{
    public function show($id)
    {
        $quiz = Quiz::with(['bab', 'questions.options'])
            ->where('is_active', 1)
            ->findOrFail($id);

        $studentId = Auth::guard('siswa')->id();

        // Cari attempt yang masih berjalan
        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->first();

        // Kalau belum ada, buat baru
        if (!$attempt) {
            $attempt = QuizAttempt::create([
                'quiz_id' => $quiz->id,
                'student_id' => $studentId,
                'started_at' => now(),
                'status' => 'in_progress',
                'total_questions' => $quiz->questions->count(),
            ]);
        }

        return view('siswa.quiz', compact('quiz', 'attempt'));
    }

    public function evaluasi()
    {
        $quiz = Quiz::with(['bab', 'questions.options'])->findOrFail(5);
        return view('siswa.kuis.evaluasi', compact('quiz'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with(['questions.options'])->findOrFail($id);
        $studentId = Auth::guard('siswa')->id();

        $attempt = QuizAttempt::where('id', $request->attempt_id)
            ->where('quiz_id', $quiz->id)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->first();

        if (!$attempt) {
            return redirect()->back()->with('error', 'Attempt quiz tidak ditemukan.');
        }

        $jawabanSiswa = $request->input('jawaban', []);
        $totalQuestions = $quiz->questions->count();

        $correctCount = 0;
        $answeredCount = 0;

        foreach ($quiz->questions as $question) {
            $selectedOptionId = $jawabanSiswa[$question->id] ?? null;

            // Ganti 'is_correct' kalau nama field jawaban benar di tabel options berbeda
            $correctOption = $question->options->firstWhere('is_correct', 1);

            if ($selectedOptionId) {
                $answeredCount++;
            }

            if ($correctOption && $selectedOptionId) {
                if ((int) $selectedOptionId === (int) $correctOption->id) {
                    $correctCount++;
                }
            }
        }

        $wrongCount = $answeredCount - $correctCount;
        $unansweredCount = $totalQuestions - $answeredCount;
        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;
        $isPassed = $score >= ($quiz->kkm ?? 70);

        $attempt->update([
            'end_at' => now(),
            'submitted_at' => now(),
            'status' => 'submitted',
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctCount,
            'wrong_answers' => $wrongCount,
            'unanswered' => $unansweredCount,
            'score' => $score,
        ]);

        $attempt->refresh();

        // Hitung durasi berdasarkan waktu mulai dan selesai
        $durationSecondsTotal = $attempt->started_at->diffInSeconds($attempt->end_at);
        $durationMinutes = floor($durationSecondsTotal / 60);
        $durationSeconds = $durationSecondsTotal % 60;

        return view('siswa.hasilkuis', compact(
            'quiz',
            'score',
            'correctCount',
            'wrongCount',
            'unansweredCount',
            'isPassed',
            'durationMinutes',
            'durationSeconds'
        ));
    }
}