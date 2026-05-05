<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\MaterialProgress;
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

        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->latest('id')
            ->first();

        if (!$attempt) {
            $attempt = QuizAttempt::create([
                'quiz_id' => $quiz->id,
                'student_id' => $studentId,
                'started_at' => now(),
                'status' => 'in_progress',
                'total_questions' => $quiz->questions->count(),
            ]);
        } else {
            $durasiDetik = $attempt->started_at->diffInSeconds(now());

            if ($durasiDetik >= ($quiz->duration_minutes * 60)) {
                $attempt->update([
                    'end_at' => now(),
                    'submitted_at' => now(),
                    'status' => 'expired',
                ]);

                $attempt = QuizAttempt::create([
                    'quiz_id' => $quiz->id,
                    'student_id' => $studentId,
                    'started_at' => now(),
                    'status' => 'in_progress',
                    'total_questions' => $quiz->questions->count(),
                ]);
            }
        }

        return view('siswa.quiz', compact('quiz', 'attempt'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with(['bab', 'questions.options'])->findOrFail($id);
        $studentId = Auth::guard('siswa')->id();

        $attempt = QuizAttempt::where('id', $request->attempt_id)
            ->where('quiz_id', $quiz->id)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->first();

        if (!$attempt) {
            return redirect()
                ->route('quiz.show', $quiz->id)
                ->with('error', 'Attempt kuis tidak ditemukan atau sudah berakhir.');
        }

        $durasiDetikSekarang = $attempt->started_at->diffInSeconds(now());

        if ($durasiDetikSekarang >= ($quiz->duration_minutes * 60)) {
            $attempt->update([
                'end_at' => now(),
                'submitted_at' => now(),
                'status' => 'expired',
            ]);

            return redirect()
                ->route('quiz.show', $quiz->id)
                ->with('error', 'Waktu kuis sudah habis. Silakan ulangi kuis.');
        }

        $jawabanSiswa = $request->input('jawaban', []);

        $totalSoal = $quiz->questions->count();
        $benar = 0;
        $terjawab = 0;

        foreach ($quiz->questions as $question) {
            $opsiBenar = $question->options->firstWhere('is_correct', 1);

            if (isset($jawabanSiswa[$question->id])) {
                $terjawab++;
            }

            if ($opsiBenar && isset($jawabanSiswa[$question->id])) {
                if ((int) $jawabanSiswa[$question->id] === (int) $opsiBenar->id) {
                    $benar++;
                }
            }
        }

        $salah = $terjawab - $benar;
        $kosong = $totalSoal - $terjawab;
        $nilai = $totalSoal > 0 ? round(($benar / $totalSoal) * 100, 2) : 0;

        // KKM diambil dari tabel quizzes
        $kkm = $quiz->kkm ?? 70;
        $lulus = $nilai >= $kkm;

        $attempt->update([
            'end_at' => now(),
            'submitted_at' => now(),
            'status' => 'submitted',
            'total_questions' => $totalSoal,
            'correct_answers' => $benar,
            'wrong_answers' => $salah,
            'unanswered' => $kosong,
            'score' => $nilai,
            'is_passed' => $lulus ? 1 : 0,
            'passed_at' => $lulus ? now() : null,
        ]);

        $attempt->refresh();

        $durasiDetik = $attempt->started_at->diffInSeconds($attempt->end_at);
        $durasiMenit = floor($durasiDetik / 60);
        $durasiSisaDetik = $durasiDetik % 60;

        // Materi terakhir di bab kuis saat ini.
        // Ini untuk tombol "Kembali ke Materi".
        $previousMateri = Materi::where('bab_id', $quiz->bab_id)
            ->orderBy('urutan', 'desc')
            ->first();

        // Cari bab berikutnya berdasarkan urutan bab.
        $babBerikutnya = null;

        if ($quiz->bab) {
            $babBerikutnya = Bab::where('urutan', '>', $quiz->bab->urutan)
                ->orderBy('urutan', 'asc')
                ->first();
        }

        // Materi pertama di bab berikutnya.
        // Ini untuk tombol "Lanjut ke Bab Berikutnya".
        $nextMateri = null;

        if ($babBerikutnya) {
            $nextMateri = Materi::where('bab_id', $babBerikutnya->id)
                ->orderBy('urutan', 'asc')
                ->first();
        }

        // Kalau lulus, buka materi pertama bab berikutnya.
        if ($lulus && $nextMateri) {
            MaterialProgress::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'materi_id' => $nextMateri->id,
                ],
                [
                    'is_opened' => 1,
                    'opened_at' => now(),
                ]
            );
        }

        return view('siswa.hasilkuis', compact(
            'quiz',
            'attempt',
            'nilai',
            'kkm',
            'benar',
            'salah',
            'kosong',
            'lulus',
            'previousMateri',
            'nextMateri',
            'durasiDetik',
            'durasiMenit',
            'durasiSisaDetik'
        ));
    }
}