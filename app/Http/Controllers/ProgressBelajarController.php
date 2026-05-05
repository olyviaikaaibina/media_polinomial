<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MaterialProgress;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class ProgressBelajarController extends Controller
{
    public function index()
    {
        $studentId = Auth::guard('siswa')->id();

        $materiList = Materi::with('bab')
            ->orderBy('bab_id')
            ->orderBy('urutan')
            ->get();

        $progressList = MaterialProgress::where('student_id', $studentId)
            ->get()
            ->keyBy('materi_id');

        $quizList = Quiz::with('bab')
            ->where('is_active', 1)
            ->orderBy('id')
            ->get();

        $quizAttempts = QuizAttempt::where('student_id', $studentId)
            ->where('is_passed', 1)
            ->get()
            ->keyBy('quiz_id');

        $items = [];

        foreach ($materiList as $materi) {
            $progress = $progressList->get($materi->id);

            $items[] = [
                'type' => 'materi',
                'title' => $materi->judul,
                'slug' => $materi->slug,
                'is_completed' => $progress?->is_completed == 1,
            ];

            $lastMateriInBab = Materi::where('bab_id', $materi->bab_id)
                ->orderBy('urutan', 'desc')
                ->first();

            if ($lastMateriInBab && $lastMateriInBab->id === $materi->id) {
                $quiz = $quizList->firstWhere('bab_id', $materi->bab_id);

                if ($quiz) {
                    $items[] = [
                        'type' => 'quiz',
                        'title' => 'Kuis - ' . ($materi->bab->judul ?? $quiz->title),
                        'quiz_id' => $quiz->id,
                        'is_completed' => $quizAttempts->has($quiz->id),
                    ];
                }
            }
        }

        $evaluasi = $quizList->firstWhere('id', 6);

        if ($evaluasi) {
            $items[] = [
                'type' => 'quiz',
                'title' => 'Evaluasi',
                'quiz_id' => $evaluasi->id,
                'is_completed' => $quizAttempts->has($evaluasi->id),
            ];
        }

        $total = count($items);
        $done = collect($items)->where('is_completed', true)->count();
        $left = $total - $done;
        $percent = $total > 0 ? round(($done / $total) * 100) : 0;

        $siswa = Auth::guard('siswa')->user();

        return view('siswa.progressbelajar', compact(
            'siswa',
            'items',
            'total',
            'done',
            'left',
            'percent'
        ));
    }
}