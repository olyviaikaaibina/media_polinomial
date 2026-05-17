<?php

namespace App\Helpers;

use App\Models\MaterialProgress;
use App\Models\QuizAttempt;

class ProgressSidebarHelper
{
    /**
     * Ambil data progress sidebar berdasarkan student_id.
     *
     * Catatan:
     * - Peta konsep dan apersepsi selalu terbuka.
     * - Materi yang sudah opened/completed tetap terbuka walaupun siswa masuk dari halaman lain.
     * - Unlock materi berikutnya tetap berdasarkan completed dan quiz passed.
     */
    public static function getSidebarProgress($studentId): array
    {
        $progressRows = MaterialProgress::with('materi:id,slug')
            ->where('student_id', $studentId)
            ->get();

        $completedSlugs = $progressRows
            ->where('is_completed', 1)
            ->pluck('materi.slug')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $openedSlugs = $progressRows
            ->where('is_opened', 1)
            ->pluck('materi.slug')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $passedQuizIds = QuizAttempt::query()
            ->where('student_id', $studentId)
            ->where('is_passed', 1)
            ->pluck('quiz_id')
            ->map(fn ($quizId) => (int) $quizId)
            ->unique()
            ->values()
            ->toArray();

        $isCompleted = fn (string $slug): bool => in_array($slug, $completedSlugs, true);
        $isQuizPassed = fn (int $quizId): bool => in_array($quizId, $passedQuizIds, true);

        /*
        |--------------------------------------------------------------------------
        | Default unlocked
        |--------------------------------------------------------------------------
        | Peta konsep, apersepsi, dan materi pertama selalu terbuka.
        | Materi yang sudah opened/completed juga tetap terbuka.
        */
        $unlockedSlugs = array_merge(
            [
                'petakonsep',
                'apersepsi',
                'pengertianpolinomial',
            ],
            $openedSlugs,
            $completedSlugs
        );

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