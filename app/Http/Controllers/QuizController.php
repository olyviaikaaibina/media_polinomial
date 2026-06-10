<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Quiz;
use App\Models\Siswa;
use App\Models\QuizAttempt;
use App\Exports\RekapNilaiExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('bab')
            ->orderBy('bab_id')
            ->orderBy('id')
            ->get();

        $babs = Bab::orderBy('urutan')->get();

        return view('guru.daftarkuis', compact('quizzes', 'babs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bab_id' => 'required|exists:bab,id',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'total_questions' => 'required|integer|min:0',
            'kkm' => 'required|numeric|min:0|max:100',
        ]);

        $quiz = Quiz::findOrFail($id);

        $quiz->update([
            'bab_id' => $request->bab_id,
            'title' => $request->title,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'total_questions' => $request->total_questions,
            'kkm' => $request->kkm,
        ]);

        return redirect()
            ->route('daftarkuis')
            ->with('success', 'Kuis berhasil diupdate.');
    }

    public function soal($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);

        return view('guru.soalkuis', compact('quiz'));
    }

    public function rekapitulasiNilai()
    {
        $data = $this->getRekapNilaiData();

        return view('guru.rekapitulasinilai', [
            'quizzes' => $data['quizzes'],
            'rekapNilai' => $data['rekapNilai'],
            'siswaDinilai' => $data['siswaDinilai'],
            'rataRataNilai' => $data['rataRataNilai'],
            'chartLabels' => $data['chartLabels'],
            'chartData' => $data['chartData'],
            'progressData' => $data['progressData'],
        ]);
    }

    public function exportRekapPdf(Request $request)
    {
        $kelas = $request->query('kelas');

        $data = $this->getRekapNilaiData($kelas);

        $namaFile = ($kelas && $kelas !== 'semua')
            ? 'rekap_nilai_kelas_' . $kelas . '.pdf'
            : 'rekap_nilai_semua_kelas.pdf';

        $pdf = Pdf::loadView('guru.rekapnilai_pdf', [
            'rekapNilai' => $data['rekapNilai'],
            'quizzes' => $data['quizzes'],
            'siswaDinilai' => $data['siswaDinilai'],
            'rataRataNilai' => $data['rataRataNilai'],
            'chartLabels' => $data['chartLabels'],
            'chartData' => $data['chartData'],
            'progressData' => $data['progressData'],
            'kelas' => $kelas,
        ])->setPaper('A4', 'landscape');

        return $pdf->download($namaFile);
    }

    public function exportRekapExcel(Request $request)
    {
        $kelas = $request->query('kelas');

        $namaFile = ($kelas && $kelas !== 'semua')
            ? 'rekap_nilai_kelas_' . $kelas . '.xlsx'
            : 'rekap_nilai_semua_kelas.xlsx';

        return Excel::download(new RekapNilaiExport($kelas), $namaFile);
    }

    private function getRekapNilaiData($kelas = null)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil 5 kuis utama: Kuis A sampai Kuis E
        |--------------------------------------------------------------------------
        */
        $quizzes = Quiz::with('bab')
            ->where('title', 'not like', '%Evaluasi%')
            ->orderBy('bab_id')
            ->orderBy('id')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Ambil kuis evaluasi
        |--------------------------------------------------------------------------
        */
        $evaluasiQuiz = Quiz::where('title', 'like', '%Evaluasi%')
            ->orderBy('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Ambil siswa sesuai kelas yang dipilih
        |--------------------------------------------------------------------------
        */
        $siswaQuery = Siswa::query();

        if ($kelas && $kelas !== 'semua') {
            $siswaQuery->whereRaw("REPLACE(kelas, ' ', '') = ?", [$kelas]);
        }

        $siswas = $siswaQuery->orderBy('nama', 'asc')->get();
        $studentIds = $siswas->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Buat data rekap nilai per siswa
        |--------------------------------------------------------------------------
        */
        $rekapNilai = $siswas->map(function ($siswa) use ($quizzes, $evaluasiQuiz) {
            $nilaiKuis = [];

            foreach ($quizzes as $quiz) {
                $nilai = QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $quiz->id)
                    ->whereNotNull('score')
                    ->max('score');

                $nilaiKuis[$quiz->id] = $nilai !== null ? round($nilai, 1) : null;
            }

            /*
            |--------------------------------------------------------------------------
            | Nilai evaluasi
            |--------------------------------------------------------------------------
            */
            $nilaiEvaluasi = null;

            if ($evaluasiQuiz) {
                $nilaiEvaluasi = QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $evaluasiQuiz->id)
                    ->whereNotNull('score')
                    ->max('score');

                $nilaiEvaluasi = $nilaiEvaluasi !== null ? round($nilaiEvaluasi, 1) : null;
            }

            /*
            |--------------------------------------------------------------------------
            | Hitung jumlah kuis yang sudah dikerjakan
            |--------------------------------------------------------------------------
            */
            $jumlahKuisDikerjakan = collect($nilaiKuis)
                ->filter(function ($nilai) {
                    return $nilai !== null;
                })
                ->count();

            $totalKuis = $quizzes->count();
            $sudahEvaluasi = $nilaiEvaluasi !== null;

            /*
            |--------------------------------------------------------------------------
            | Status belajar siswa
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | Hitung rata-rata siswa
            |--------------------------------------------------------------------------
            */
            $nilaiTerisi = collect($nilaiKuis)->filter(function ($nilai) {
                return $nilai !== null;
            });

            if ($nilaiEvaluasi !== null) {
                $nilaiTerisi->push($nilaiEvaluasi);
            }

            $rataRataSiswa = $nilaiTerisi->count() > 0
                ? round($nilaiTerisi->avg(), 1)
                : 0;

            return (object) [
                'id' => $siswa->id,
                'nama' => $siswa->nama,
                'kelas' => $siswa->kelas ? str_replace(' ', '', $siswa->kelas) : '-',
                'nilai_kuis' => $nilaiKuis,
                'nilai_evaluasi' => $nilaiEvaluasi,
                'rata_rata' => $rataRataSiswa,
                'status' => $status,
            ];
        });

        /*
        |--------------------------------------------------------------------------
        | Hitung siswa yang sudah punya nilai
        |--------------------------------------------------------------------------
        */
        $siswaDinilai = $rekapNilai->filter(function ($siswa) {
            $punyaNilaiKuis = collect($siswa->nilai_kuis)
                ->filter(function ($nilai) {
                    return $nilai !== null;
                })
                ->count() > 0;

            return $punyaNilaiKuis || $siswa->nilai_evaluasi !== null;
        })->count();

        /*
        |--------------------------------------------------------------------------
        | Rata-rata seluruh nilai
        |--------------------------------------------------------------------------
        */
        $semuaNilai = QuizAttempt::whereNotNull('score')
            ->whereIn('student_id', $studentIds)
            ->pluck('score');

        $rataRataNilai = $semuaNilai->count() > 0
            ? round($semuaNilai->avg(), 1)
            : 0;

        /*
   |--------------------------------------------------------------------------
   | Data chart rata-rata nilai
   | Ambil nilai tertinggi tiap siswa, lalu dirata-ratakan
   |--------------------------------------------------------------------------
   */
        $chartLabels = [];
        $chartData = [];

        foreach ($quizzes as $quiz) {
            $chartLabels[] = $quiz->title;

            $nilaiTertinggiPerSiswa = $siswas->map(function ($siswa) use ($quiz) {
                return QuizAttempt::where('student_id', $siswa->id)
                    ->where('quiz_id', $quiz->id)
                    ->whereNotNull('score')
                    ->max('score');
            })->filter(function ($nilai) {
                return $nilai !== null;
            });

            $chartData[] = $nilaiTertinggiPerSiswa->count() > 0
                ? round($nilaiTertinggiPerSiswa->avg(), 1)
                : 0;
        }
        /*
        |--------------------------------------------------------------------------
        | Data progress siswa mengikuti kuis
        |--------------------------------------------------------------------------
        */
        $totalSiswa = $siswas->count();
        $progressData = [];

        foreach ($quizzes as $quiz) {
            $jumlahIkut = QuizAttempt::where('quiz_id', $quiz->id)
                ->whereIn('student_id', $studentIds)
                ->whereNotNull('score')
                ->distinct('student_id')
                ->count('student_id');

            $persen = $totalSiswa > 0
                ? round(($jumlahIkut / $totalSiswa) * 100)
                : 0;

            $progressData[] = [
                'label' => $quiz->title,
                'jumlah_ikut' => $jumlahIkut,
                'total_siswa' => $totalSiswa,
                'persen' => $persen,
            ];
        }

        return [
            'quizzes' => $quizzes,
            'rekapNilai' => $rekapNilai,
            'siswaDinilai' => $siswaDinilai,
            'rataRataNilai' => $rataRataNilai,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'progressData' => $progressData,
        ];
    }
}