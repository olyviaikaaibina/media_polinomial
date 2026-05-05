<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MaterialProgress;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ProgressSidebarHelper;

class MateriController extends Controller
{
    public function show($slug)
    {
        $studentId = Auth::guard('siswa')->id();

        $materi = Materi::with(['bab.quizzes'])
            ->where('slug', $slug)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Ambil progress dari helper
        |--------------------------------------------------------------------------
        */
        $sidebarProgress = ProgressSidebarHelper::getSidebarProgress($studentId);

        $unlockedSlugs = $sidebarProgress['unlockedSlugs'];
        $completedSlugs = $sidebarProgress['completedSlugs'];
        $openedSlugs = $sidebarProgress['openedSlugs'];
        $passedQuizIds = $sidebarProgress['passedQuizIds'];

        $canAccessQuizA = $sidebarProgress['canAccessQuizA'];
        $canAccessQuizB = $sidebarProgress['canAccessQuizB'];
        $canAccessQuizC = $sidebarProgress['canAccessQuizC'];
        $canAccessQuizD = $sidebarProgress['canAccessQuizD'];
        $canAccessQuizE = $sidebarProgress['canAccessQuizE'];
        $canAccessEvaluasi = $sidebarProgress['canAccessEvaluasi'];
        $canAccessQuizByBab = $sidebarProgress['canAccessQuizByBab'];

        /*
        |--------------------------------------------------------------------------
        | Buka materi pertama otomatis
        |--------------------------------------------------------------------------
        */
        $firstMateri = Materi::orderBy('bab_id')
            ->orderBy('urutan')
            ->first();

        if ($firstMateri) {
            MaterialProgress::firstOrCreate(
                [
                    'student_id' => $studentId,
                    'materi_id' => $firstMateri->id,
                ],
                [
                    'is_opened' => 1,
                    'is_completed' => 0,
                    'opened_at' => now(),
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Blok akses langsung kalau materi terkunci
        |--------------------------------------------------------------------------
        | Sementara ini aktif untuk semua materi yang belum masuk unlockedSlugs.
        | Kalau mau kunci Bab 1 saja, tambahkan: $materi->bab_id == 1 &&
        */
        if (!in_array($materi->slug, $unlockedSlugs)) {
            return redirect()
                ->route('materi.show', ['slug' => 'pengertianpolinomial'])
                ->with('error', 'Materi ini masih terkunci. Selesaikan materi sebelumnya dulu.');
        }

        /*
        |--------------------------------------------------------------------------
        | Tandai materi sedang dibuka
        |--------------------------------------------------------------------------
        */
        MaterialProgress::updateOrCreate(
            [
                'student_id' => $studentId,
                'materi_id' => $materi->id,
            ],
            [
                'is_opened' => 1,
                'opened_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Materi sebelumnya dan selanjutnya dalam bab yang sama
        |--------------------------------------------------------------------------
        */
        $previousMateri = Materi::where('bab_id', $materi->bab_id)
            ->where('urutan', '<', $materi->urutan)
            ->orderBy('urutan', 'desc')
            ->first();

        $nextMateri = Materi::where('bab_id', $materi->bab_id)
            ->where('urutan', '>', $materi->urutan)
            ->orderBy('urutan', 'asc')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Kuis bab sekarang
        |--------------------------------------------------------------------------
        */
        $quizBab = $materi->bab ? $materi->bab->quizzes->first() : null;

        /*
        |--------------------------------------------------------------------------
        | Progress materi yang sedang dibuka
        |--------------------------------------------------------------------------
        */
        $materialProgress = MaterialProgress::where('student_id', $studentId)
            ->where('materi_id', $materi->id)
            ->first();

        return view($materi->view_path, compact(
            'materi',
            'previousMateri',
            'nextMateri',
            'quizBab',
            'materialProgress',

            'unlockedSlugs',
            'completedSlugs',
            'openedSlugs',
            'passedQuizIds',

            'canAccessQuizA',
            'canAccessQuizB',
            'canAccessQuizC',
            'canAccessQuizD',
            'canAccessQuizE',
            'canAccessEvaluasi',
            'canAccessQuizByBab'
        ));
    }

    public function complete($id)
    {
        $studentId = Auth::guard('siswa')->id();

        $materi = Materi::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Tandai materi sekarang selesai
        |--------------------------------------------------------------------------
        */
        MaterialProgress::updateOrCreate(
            [
                'student_id' => $studentId,
                'materi_id' => $materi->id,
            ],
            [
                'is_opened' => 1,
                'is_completed' => 1,
                'opened_at' => now(),
                'completed_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Buka materi berikutnya dalam bab yang sama
        |--------------------------------------------------------------------------
        */
        $nextMateri = Materi::where('bab_id', $materi->bab_id)
            ->where('urutan', '>', $materi->urutan)
            ->orderBy('urutan', 'asc')
            ->first();

        if ($nextMateri) {
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

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Progress materi berhasil disimpan.',
                'next_materi' => $nextMateri,
            ]);
        }

        return back()->with('success', 'Progress materi berhasil disimpan.');
    }
}