<?php

namespace App\Exports;

use App\Models\Quiz;
use App\Models\Siswa;
use App\Models\QuizAttempt;
use Maatwebsite\Excel\Concerns\FromArray;

class RekapNilaiExport implements FromArray
{
    protected $kelas;

    public function __construct($kelas = null)
    {
        $this->kelas = $kelas;
    }

    public function array(): array
    {
        $quizzes = Quiz::with('bab')
            ->where('title', 'not like', '%Evaluasi%')
            ->orderBy('bab_id')
            ->orderBy('id')
            ->take(5)
            ->get();

        $evaluasiQuiz = Quiz::where('title', 'like', '%Evaluasi%')
            ->orderBy('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Ambil siswa sesuai kelas yang dipilih
        |--------------------------------------------------------------------------
        */
        $siswaQuery = Siswa::query();

        if ($this->kelas && $this->kelas !== 'semua') {
            $siswaQuery->whereRaw("REPLACE(kelas, ' ', '') = ?", [$this->kelas]);
        }

        $siswas = $siswaQuery->orderBy('nama', 'asc')->get();
        $studentIds = $siswas->pluck('id');

        $data = [];

        // JUDUL
        if ($this->kelas && $this->kelas !== 'semua') {
            $data[] = ['REKAPITULASI NILAI KELAS ' . $this->kelas];
        } else {
            $data[] = ['REKAPITULASI NILAI SEMUA KELAS'];
        }

        $data[] = [];

        // RINGKASAN
        $siswaDinilai = 0;

        $semuaNilai = QuizAttempt::whereNotNull('score')
            ->whereIn('student_id', $studentIds)
            ->pluck('score');

        $rataRataNilai = $semuaNilai->count() > 0
            ? round($semuaNilai->avg(), 1)
            : 0;

        foreach ($siswas as $siswa) {
            $punyaNilai = QuizAttempt::where('student_id', $siswa->id)
                ->whereNotNull('score')
                ->exists();

            if ($punyaNilai) {
                $siswaDinilai++;
            }
        }

        $data[] = ['Siswa Dinilai', $siswaDinilai];
        $data[] = ['Rata-rata Nilai', $rataRataNilai];
        $data[] = [];

        // TABEL REKAP NILAI SISWA
        $data[] = [
            'No',
            'Nama Siswa',
            'Kelas',
            'Kuis A',
            'Kuis B',
            'Kuis C',
            'Kuis D',
            'Kuis E',
            'Nilai Evaluasi',
            'Status',
        ];

        foreach ($siswas as $index => $siswa) {
            $row = [
                $index + 1,
                $siswa->nama ?? '-',
                $siswa->kelas ? str_replace(' ', '', $siswa->kelas) : '-',
            ];

            $nilaiKuis = [];

            foreach ($quizzes as $quiz) {
                $nilai = QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $quiz->id)
                    ->whereNotNull('score')
                    ->max('score');

                $nilai = $nilai !== null ? round($nilai, 1) : null;
                $nilaiKuis[$quiz->id] = $nilai;

                $row[] = $nilai !== null ? $nilai : '-';
            }

            for ($i = $quizzes->count(); $i < 5; $i++) {
                $row[] = '-';
            }

            $nilaiEvaluasi = null;

            if ($evaluasiQuiz) {
                $nilaiEvaluasi = QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $evaluasiQuiz->id)
                    ->whereNotNull('score')
                    ->max('score');

                $nilaiEvaluasi = $nilaiEvaluasi !== null ? round($nilaiEvaluasi, 1) : null;
            }

            $jumlahKuisDikerjakan = collect($nilaiKuis)
                ->filter(function ($nilai) {
                    return $nilai !== null;
                })
                ->count();

            $totalKuis = $quizzes->count();
            $sudahEvaluasi = $nilaiEvaluasi !== null;

            if ($jumlahKuisDikerjakan === 0 && !$sudahEvaluasi) {
                $status = 'Belum mulai';
            } elseif (
                $totalKuis > 0 &&
                $jumlahKuisDikerjakan >= $totalKuis &&
                ($evaluasiQuiz ? $sudahEvaluasi : true)
            ) {
                $status = 'Selesai';
            } else {
                $status = 'Sedang belajar';
            }

            $row[] = $nilaiEvaluasi !== null ? $nilaiEvaluasi : '-';
            $row[] = $status;

            $data[] = $row;
        }

        $data[] = [];
        $data[] = [];

        // RATA-RATA NILAI PER KUIS
        $data[] = ['RATA-RATA NILAI PER KUIS'];
        $data[] = ['No', 'Nama Kuis', 'Rata-rata Nilai'];

        foreach ($quizzes as $index => $quiz) {
            $avgScore = QuizAttempt::where('quiz_id', $quiz->id)
                ->whereIn('student_id', $studentIds)
                ->whereNotNull('score')
                ->avg('score');

            $data[] = [
                $index + 1,
                $quiz->title,
                $avgScore ? round($avgScore, 1) : 0,
            ];
        }

        $data[] = [];
        $data[] = [];

        // PROGRES SISWA MENGIKUTI KUIS
        $data[] = ['PROGRES SISWA MENGIKUTI KUIS'];
        $data[] = ['No', 'Nama Kuis', 'Jumlah Ikut', 'Total Siswa', 'Persentase'];

        $totalSiswa = $siswas->count();

        foreach ($quizzes as $index => $quiz) {
            $jumlahIkut = QuizAttempt::where('quiz_id', $quiz->id)
                ->whereIn('student_id', $studentIds)
                ->whereNotNull('score')
                ->distinct('student_id')
                ->count('student_id');

            $persen = $totalSiswa > 0
                ? round(($jumlahIkut / $totalSiswa) * 100)
                : 0;

            $data[] = [
                $index + 1,
                $quiz->title,
                $jumlahIkut,
                $totalSiswa,
                $persen . '%',
            ];
        }

        return $data;
    }
}