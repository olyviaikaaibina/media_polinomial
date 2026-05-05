<?php

namespace App\Helpers;

use App\Models\MaterialProgress;
use App\Models\QuizAttempt;

class ProgressSidebarHelper
{
    public static function getSidebarProgress($studentId): array
    {
        $completedSlugs = MaterialProgress::with('materi')
            ->where('student_id', $studentId)
            ->where('is_completed', 1)
            ->get()
            ->pluck('materi.slug')
            ->filter()
            ->values()
            ->toArray();

        $openedSlugs = MaterialProgress::with('materi')
            ->where('student_id', $studentId)
            ->where('is_opened', 1)
            ->get()
            ->pluck('materi.slug')
            ->filter()
            ->values()
            ->toArray();

        $passedQuizIds = QuizAttempt::where('student_id', $studentId)
            ->where('is_passed', 1)
            ->pluck('quiz_id')
            ->unique()
            ->values()
            ->toArray();

        $isCompleted = fn ($slug) => in_array($slug, $completedSlugs);
        $isQuizPassed = fn ($quizId) => in_array($quizId, $passedQuizIds);

        /*
        |--------------------------------------------------------------------------
        | Default: hanya materi pertama yang terbuka
        |--------------------------------------------------------------------------
        | Catatan:
        | is_opened TIDAK dipakai untuk unlock materi berikutnya.
        | Unlock hanya berdasarkan is_completed dan kuis lulus.
        */
        $unlockedSlugs = [
            'pengertianpolinomial',
        ];

        /*
        |--------------------------------------------------------------------------
        | BAB 1 - Polinomial & Fungsi Polinomial
        |--------------------------------------------------------------------------
        */
        if ($isCompleted('pengertianpolinomial')) {
            $unlockedSlugs[] = 'derajatsuatupolinomial';
        }

        if ($isCompleted('derajatsuatupolinomial')) {
            $unlockedSlugs[] = 'fungsipolinomialdangrafiknya';
        }

        $canAccessQuizA = $isCompleted('fungsipolinomialdangrafiknya');

        /*
        |--------------------------------------------------------------------------
        | BAB 2 - Penjumlahan, Pengurangan, Perkalian
        |--------------------------------------------------------------------------
        */
        if ($isQuizPassed(1)) {
            $unlockedSlugs[] = 'penjumlahanpolinomial';
        }

        if ($isCompleted('penjumlahanpolinomial')) {
            $unlockedSlugs[] = 'penguranganpolinomial';
        }

        if ($isCompleted('penguranganpolinomial')) {
            $unlockedSlugs[] = 'perkalianpolinomial';
        }

        $canAccessQuizB = $isCompleted('perkalianpolinomial');

        /*
        |--------------------------------------------------------------------------
        | BAB 3 - Pembagian Polinomial
        |--------------------------------------------------------------------------
        */
        if ($isQuizPassed(2)) {
            $unlockedSlugs[] = 'pembagianbersusun';
        }

        if ($isCompleted('pembagianbersusun')) {
            $unlockedSlugs[] = 'metodehorner';
        }

        if ($isCompleted('metodehorner')) {
            $unlockedSlugs[] = 'teoremasisa';
        }

        $canAccessQuizC = $isCompleted('teoremasisa');

        /*
        |--------------------------------------------------------------------------
        | BAB 4 - Faktor & Pembuat Nol
        |--------------------------------------------------------------------------
        */
        if ($isQuizPassed(3)) {
            $unlockedSlugs[] = 'teoremafaktor';
        }

        if ($isCompleted('teoremafaktor')) {
            $unlockedSlugs[] = 'faktordanpembuatnol';
        }

        $canAccessQuizD = $isCompleted('faktordanpembuatnol');

        /*
        |--------------------------------------------------------------------------
        | BAB 5 - Identitas Polinomial
        |--------------------------------------------------------------------------
        */
        if ($isQuizPassed(4)) {
            $unlockedSlugs[] = 'identitaspolinomial';
        }

        $canAccessQuizE = $isCompleted('identitaspolinomial');

        /*
        |--------------------------------------------------------------------------
        | Evaluasi
        |--------------------------------------------------------------------------
        */
        $canAccessEvaluasi = $isQuizPassed(5);

        return [
            'unlockedSlugs' => array_values(array_unique($unlockedSlugs)),
            'completedSlugs' => $completedSlugs,
            'openedSlugs' => $openedSlugs,
            'passedQuizIds' => $passedQuizIds,

            'canAccessQuizA' => $canAccessQuizA,
            'canAccessQuizB' => $canAccessQuizB,
            'canAccessQuizC' => $canAccessQuizC,
            'canAccessQuizD' => $canAccessQuizD,
            'canAccessQuizE' => $canAccessQuizE,
            'canAccessEvaluasi' => $canAccessEvaluasi,

            'canAccessQuizByBab' => [
                1 => $canAccessQuizA,
                2 => $canAccessQuizB,
                3 => $canAccessQuizC,
                4 => $canAccessQuizD,
                5 => $canAccessQuizE,
            ],
        ];
    }
}