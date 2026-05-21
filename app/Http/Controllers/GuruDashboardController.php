<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\MaterialProgress;
use Carbon\Carbon;

class GuruDashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Timezone WIB
        |--------------------------------------------------------------------------
        */
        $timezone = 'Asia/Jakarta';

        /*
        |--------------------------------------------------------------------------
        | Jumlah seluruh siswa
        |--------------------------------------------------------------------------
        */
        $jumlahSiswa = Siswa::count();

        /*
        |--------------------------------------------------------------------------
        | Jumlah siswa yang mengunjungi / membuka materi hari ini
        |--------------------------------------------------------------------------
        */
        $hariIniWib = Carbon::now($timezone)->toDateString();

        $pengunjungHariIni = MaterialProgress::whereNotNull('opened_at')
            ->whereDate('opened_at', $hariIniWib)
            ->distinct('student_id')
            ->count('student_id');

        /*
        |--------------------------------------------------------------------------
        | Data chart nilai rata-rata kuis per sub-bab
        |--------------------------------------------------------------------------
        | Cara hitung:
        | 1. Ambil semua kuis.
        | 2. Untuk setiap kuis, ambil nilai tertinggi setiap siswa.
        | 3. Nilai tertinggi setiap siswa itu dirata-ratakan.
        |
        | Contoh:
        | Dimas mengerjakan Kuis A 4 kali: 20, 40, 90, 100.
        | Maka nilai Dimas yang dipakai untuk Kuis A adalah 100.
        |--------------------------------------------------------------------------
        */
        $quizzes = Quiz::orderBy('id', 'asc')->get();

        $subbab = [];
        $nilaiRata = [];

        foreach ($quizzes as $quiz) {
            $subbab[] = $quiz->title;

            /*
            |--------------------------------------------------------------------------
            | Ambil nilai tertinggi dari setiap siswa pada kuis ini
            |--------------------------------------------------------------------------
            */
            $nilaiTertinggiPerSiswa = QuizAttempt::where('quiz_id', $quiz->id)
                ->whereNotNull('score')
                ->selectRaw('student_id, MAX(score) as nilai_tertinggi')
                ->groupBy('student_id')
                ->pluck('nilai_tertinggi');

            /*
            |--------------------------------------------------------------------------
            | Hitung rata-rata dari nilai tertinggi setiap siswa
            |--------------------------------------------------------------------------
            */
            $avgScore = $nilaiTertinggiPerSiswa->count() > 0
                ? $nilaiTertinggiPerSiswa->avg()
                : 0;

            $nilaiRata[] = round($avgScore, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | Aktivitas terbaru siswa
        |--------------------------------------------------------------------------
        | Tetap hanya 5 data terbaru.
        | Jika siswa membuka materi lagi, aktivitasnya naik ke paling atas.
        |--------------------------------------------------------------------------
        */
        $aktivitas = MaterialProgress::with(['siswa', 'materi'])
            ->whereNotNull('opened_at')
            ->get()
            ->map(function ($item) use ($timezone) {
                if ($item->is_completed) {
                    $status = 'Selesai';
                } elseif ($item->is_opened) {
                    $status = 'Sedang dikerjakan';
                } else {
                    $status = 'Belum mulai';
                }

                /*
                |--------------------------------------------------------------------------
                | Ambil waktu aktivitas paling baru
                |--------------------------------------------------------------------------
                */
                $daftarWaktu = collect([
                    $item->opened_at,
                    $item->completed_at,
                    $item->updated_at,
                ])->filter();

                $waktuTerbaru = $daftarWaktu
                    ->map(function ($waktu) use ($timezone) {
                        return Carbon::parse($waktu)->timezone($timezone);
                    })
                    ->sortDesc()
                    ->first();

                return (object) [
                    'nama' => $item->siswa->nama ?? '-',
                    'materi' => $item->materi->judul ?? '-',
                    'status' => $status,
                    'waktu_asli' => $waktuTerbaru,
                    'waktu' => $waktuTerbaru
                        ? $waktuTerbaru->format('d-m-Y H:i') . ' WIB'
                        : '-',
                ];
            })
            ->sortByDesc('waktu_asli')
            ->take(5)
            ->values();

        return view('guru.dashboardguru', compact(
            'jumlahSiswa',
            'pengunjungHariIni',
            'subbab',
            'nilaiRata',
            'aktivitas'
        ));
    }
}