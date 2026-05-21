<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\MaterialProgress;
use Carbon\Carbon;

class ProgressSiswaController extends Controller
{
    public function index()
    {
        $timezone = 'Asia/Jakarta';

        /*
        |--------------------------------------------------------------------------
        | Data dasar
        |--------------------------------------------------------------------------
        */
        $totalMateri = Materi::count();

        $kuisUtama = Quiz::where('title', 'not like', '%Evaluasi%')
            ->orderBy('bab_id')
            ->orderBy('id')
            ->get();

        $evaluasiQuiz = Quiz::where('title', 'like', '%Evaluasi%')
            ->orderBy('id')
            ->first();

        $siswas = Siswa::orderBy('nama', 'asc')->get();

        /*
        |--------------------------------------------------------------------------
        | Data progress setiap siswa
        |--------------------------------------------------------------------------
        */
        $progressSiswa = $siswas->map(function ($siswa) use (
            $totalMateri,
            $kuisUtama,
            $evaluasiQuiz,
            $timezone
        ) {
            /*
            |--------------------------------------------------------------------------
            | Progress materi
            |--------------------------------------------------------------------------
            */
            $materiSelesai = MaterialProgress::where('student_id', $siswa->id)
                ->where('is_completed', 1)
                ->distinct('materi_id')
                ->count('materi_id');

            $materiDibuka = MaterialProgress::where('student_id', $siswa->id)
                ->where('is_opened', 1)
                ->distinct('materi_id')
                ->count('materi_id');

            $progressMateri = $totalMateri > 0
                ? round(($materiSelesai / $totalMateri) * 100)
                : 0;

            /*
            |--------------------------------------------------------------------------
            | Kuis utama
            |--------------------------------------------------------------------------
            | Kuis dianggap selesai hanya jika nilai terbaik siswa >= KKM kuis.
            |--------------------------------------------------------------------------
            */
            $totalKuis = $kuisUtama->count();

            $jumlahKuisDikerjakan = QuizAttempt::where('student_id', $siswa->id)
                ->whereIn('quiz_id', $kuisUtama->pluck('id'))
                ->whereNotNull('score')
                ->distinct('quiz_id')
                ->count('quiz_id');

            $jumlahKuisLulusKkm = 0;

            foreach ($kuisUtama as $quiz) {
                $nilaiTerbaik = QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $quiz->id)
                    ->whereNotNull('score')
                    ->max('score');

                $kkmQuiz = $quiz->kkm ?? 75;

                if ($nilaiTerbaik !== null && $nilaiTerbaik >= $kkmQuiz) {
                    $jumlahKuisLulusKkm++;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Evaluasi
            |--------------------------------------------------------------------------
            | Evaluasi dianggap selesai hanya jika nilai evaluasi >= KKM evaluasi.
            |--------------------------------------------------------------------------
            */
            $nilaiEvaluasi = null;
            $evaluasiStatus = 'Belum';
            $evaluasiLulusKkm = false;

            if ($evaluasiQuiz) {
                $nilaiEvaluasi = QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $evaluasiQuiz->id)
                    ->whereNotNull('score')
                    ->max('score');

                $kkmEvaluasi = $evaluasiQuiz->kkm ?? 75;

                if ($nilaiEvaluasi !== null) {
                    if ($nilaiEvaluasi >= $kkmEvaluasi) {
                        $evaluasiStatus = 'Sudah';
                        $evaluasiLulusKkm = true;
                    } else {
                        $evaluasiStatus = 'Belum Lulus';
                        $evaluasiLulusKkm = false;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Ambil data aktivitas materi dan kuis
            |--------------------------------------------------------------------------
            */
            $materialProgresses = MaterialProgress::with('materi')
                ->where('student_id', $siswa->id)
                ->get();

            $quizAttempts = QuizAttempt::where('student_id', $siswa->id)
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Aktivitas terakhir siswa
            |--------------------------------------------------------------------------
            */
            $daftarAktivitas = collect();

            foreach ($materialProgresses as $progress) {
                $namaMateri = $progress->materi->judul ?? 'Materi';

                if ($progress->completed_at) {
                    $daftarAktivitas->push((object) [
                        'waktu' => Carbon::parse($progress->completed_at)->timezone($timezone),
                        'aktivitas' => 'Menyelesaikan materi ' . $namaMateri,
                    ]);
                }

                if ($progress->opened_at) {
                    $daftarAktivitas->push((object) [
                        'waktu' => Carbon::parse($progress->opened_at)->timezone($timezone),
                        'aktivitas' => 'Membuka materi ' . $namaMateri,
                    ]);
                }

                if (!$progress->completed_at && !$progress->opened_at && $progress->updated_at) {
                    $daftarAktivitas->push((object) [
                        'waktu' => Carbon::parse($progress->updated_at)->timezone($timezone),
                        'aktivitas' => 'Mengakses materi ' . $namaMateri,
                    ]);
                }
            }

            foreach ($quizAttempts as $attempt) {
                $quiz = Quiz::find($attempt->quiz_id);
                $namaQuiz = $quiz->title ?? 'Kuis';

                if ($attempt->submitted_at) {
                    $daftarAktivitas->push((object) [
                        'waktu' => Carbon::parse($attempt->submitted_at)->timezone($timezone),
                        'aktivitas' => 'Mengerjakan ' . $namaQuiz,
                    ]);
                }

                if ($attempt->started_at) {
                    $daftarAktivitas->push((object) [
                        'waktu' => Carbon::parse($attempt->started_at)->timezone($timezone),
                        'aktivitas' => 'Mulai mengerjakan ' . $namaQuiz,
                    ]);
                }

                if (!$attempt->submitted_at && !$attempt->started_at && $attempt->updated_at && $attempt->score !== null) {
                    $daftarAktivitas->push((object) [
                        'waktu' => Carbon::parse($attempt->updated_at)->timezone($timezone),
                        'aktivitas' => 'Mengerjakan ' . $namaQuiz,
                    ]);
                }
            }

            $aktivitasTerakhir = $daftarAktivitas
                ->sortByDesc('waktu')
                ->first();

            $aktivitasTerakhirText = $aktivitasTerakhir
                ? $aktivitasTerakhir->aktivitas
                : 'Belum ada aktivitas';

            $aktivitasTerakhirWaktu = $aktivitasTerakhir
                ? $aktivitasTerakhir->waktu->format('d-m-Y H:i') . ' WIB'
                : '-';

            $waktuTerakhir = $aktivitasTerakhir
                ? $aktivitasTerakhir->waktu
                : null;

            /*
            |--------------------------------------------------------------------------
            | Status siswa
            |--------------------------------------------------------------------------
            | Selesai:
            | - Semua materi sudah selesai
            | - Semua kuis utama sudah lulus KKM
            | - Evaluasi sudah lulus KKM
            |
            | Sedang belajar:
            | - Sudah ada aktivitas, tapi belum memenuhi semua syarat selesai
            |
            | Belum mulai:
            | - Belum membuka materi, belum kuis, belum evaluasi
            |--------------------------------------------------------------------------
            */
            $materiSudahSelesai = $progressMateri >= 100;

            $kuisSudahLulusKkm = $totalKuis > 0
                ? $jumlahKuisLulusKkm >= $totalKuis
                : true;

            $evaluasiSudahLulusKkm = $evaluasiQuiz
                ? $evaluasiLulusKkm
                : true;

            $sudahAdaAktivitas = $materiDibuka > 0
                || $materiSelesai > 0
                || $jumlahKuisDikerjakan > 0
                || $nilaiEvaluasi !== null;

            if (
                $materiSudahSelesai &&
                $kuisSudahLulusKkm &&
                $evaluasiSudahLulusKkm
            ) {
                $status = 'Selesai';
            } elseif ($sudahAdaAktivitas) {
                $status = 'Sedang belajar';
            } else {
                $status = 'Belum mulai';
            }

            return (object) [
                'nama' => $siswa->nama,
                'kelas' => $siswa->kelas ?? '-',

                'progress_materi' => $progressMateri,
                'materi_selesai' => $materiSelesai,
                'total_materi' => $totalMateri,

                'kuis_dikerjakan' => $jumlahKuisDikerjakan,
                'kuis_lulus_kkm' => $jumlahKuisLulusKkm,
                'total_kuis' => $totalKuis,

                'evaluasi_status' => $evaluasiStatus,
                'nilai_evaluasi' => $nilaiEvaluasi,

                'aktivitas_terakhir' => $aktivitasTerakhirText,
                'aktivitas_terakhir_waktu' => $aktivitasTerakhirWaktu,
                'waktu_aktivitas_asli' => $waktuTerakhir,

                'status' => $status,
            ];
        })
            ->sortByDesc('waktu_aktivitas_asli')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Ringkasan atas
        |--------------------------------------------------------------------------
        */
        $aktivitasHariIni = $progressSiswa->filter(function ($siswa) use ($timezone) {
            return $siswa->waktu_aktivitas_asli &&
                $siswa->waktu_aktivitas_asli->toDateString() === Carbon::now($timezone)->toDateString();
        })->count();

        $mingguIni = $progressSiswa->filter(function ($siswa) use ($timezone) {
            if (!$siswa->waktu_aktivitas_asli) {
                return false;
            }

            return $siswa->waktu_aktivitas_asli->between(
                Carbon::now($timezone)->startOfWeek(),
                Carbon::now($timezone)->endOfWeek()
            );
        })->count();

        return view('guru.aktivitassiswa', compact(
            'progressSiswa',
            'aktivitasHariIni',
            'mingguIni'
        ));
    }
}