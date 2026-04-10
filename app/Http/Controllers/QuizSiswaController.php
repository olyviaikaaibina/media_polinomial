<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizSiswaController extends Controller
{
    public function show($id)
    {
        $quiz = Quiz::with(['bab', 'questions.options'])
            ->where('is_active', 1)
            ->findOrFail($id);

        return view('siswa.quiz', compact('quiz'));
    }

    public function evaluasi()
    {
        $quiz = Quiz::with(['bab', 'questions.options'])->findOrFail(5);
        return view('siswa.kuis.evaluasi', compact('quiz'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with(['questions.options'])->findOrFail($id);

        $jawabanSiswa = $request->input('jawaban', []);
        $totalSoal = $quiz->questions->count();
        $benar = 0;

        foreach ($quiz->questions as $question) {
            $opsiBenar = $question->options->firstWhere('is_correct', 1);

            if ($opsiBenar && isset($jawabanSiswa[$question->id])) {
                if ($jawabanSiswa[$question->id] == $opsiBenar->id) {
                    $benar++;
                }
            }
        }

        $nilai = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;

        return redirect()->back()->with('success', "Kuis selesai. Nilai kamu: $nilai");
    }
}