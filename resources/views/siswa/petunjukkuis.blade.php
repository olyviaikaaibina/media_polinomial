{{-- resources/views/quiz/petunjuk-kuis.blade.php --}}

@php
    $isEvaluasi = $isEvaluasi ?? false;
    $durasiMenit = $durasiMenit ?? ($isEvaluasi ? 30 : 20);
    $jumlahSoal = $jumlahSoal ?? 10;
    $judulHalaman = $isEvaluasi ? 'EVALUASI' : 'KUIS';

    $quizId = isset($quiz) ? (int) $quiz->id : 0;

    /*
        Slug awal sesuai pola penamaan kamu.
        Kalau ternyata berbeda, kode di bawah tetap akan mencari slug dari database berdasarkan kata kunci.
    */
    $slugKembaliMap = [
        1 => 'grafikfungsipolinomial',
        2 => 'penjumlahanpengurangandanperkalian',
        3 => 'pembagianpolinomial',
        4 => 'faktorpembuatnol',
        5 => 'identitaspolinomial',
    ];

    /*
        Kata kunci untuk mencari slug yang benar di tabel materis.
        Jadi kalau slug kamu misalnya:
        - grafik-fungsi-polinomial
        - grafikfungsipolinomial
        - grafik-dan-fungsi-polinomial
        tetap bisa ketemu selama ada kata grafik dan fungsi.
    */
    $keywordKembaliMap = [
        1 => ['grafik', 'fungsi'],
        2 => ['perkalian'],
        3 => ['pembagian'],
        4 => ['faktor', 'pembuat', 'nol'],
        5 => ['identitas'],
    ];

    $slugKembali = $slugKembaliMap[$quizId] ?? null;

    try {
        if ($slugKembali) {
            $slugAda = \App\Models\Materi::where('slug', $slugKembali)->exists();

            if (!$slugAda) {
                $slugKembali = null;
            }
        }

        if (!$slugKembali && isset($keywordKembaliMap[$quizId])) {
            $keywords = $keywordKembaliMap[$quizId];

            $queryMateri = \App\Models\Materi::query();

            foreach ($keywords as $keyword) {
                $queryMateri->where('slug', 'like', '%' . $keyword . '%');
            }

            $slugKembali = $queryMateri->orderBy('id', 'asc')->value('slug');
        }
    } catch (\Throwable $e) {
        $slugKembali = $slugKembaliMap[$quizId] ?? null;
    }

    $slugKembali = $slugKembali ?: 'pengertianpolinomial';

    $urlKembali = route('materi.show', ['slug' => $slugKembali]);
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petunjuk Pengerjaan {{ $isEvaluasi ? 'Evaluasi' : 'Kuis' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #FDFDE8;
            color: #3F463F;
        }

        .petunjuk-kuis-page {
            background: #FDFDE8;
            min-height: 100vh;
            padding: 28px 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .petunjuk-kuis-card {
            width: 100%;
            max-width: 900px;
            background: #FFFEF7;
            border: 2px solid #D0DDD0;
            border-radius: 22px;
            padding: 38px 52px;
            box-shadow: 0 18px 45px rgba(114, 125, 115, 0.12);
        }

        .petunjuk-kuis-title {
            text-align: center;
            font-size: 34px;
            font-weight: 900;
            color: #727D73;
            margin: 0 0 10px;
            letter-spacing: 0.5px;
        }

        .petunjuk-kuis-subtitle {
            font-size: 24px;
            font-weight: 800;
            color: #A59D84;
            margin: 0 0 22px;
        }

        .petunjuk-list {
            margin: 0;
            padding-left: 22px;
        }

        .petunjuk-list li {
            font-size: 15.5px;
            line-height: 1.75;
            color: #3F463F;
            margin-bottom: 12px;
        }

        .petunjuk-list strong {
            color: #4F5A50;
            font-weight: 800;
        }

        .warna-nomor {
            margin-top: 8px;
            display: grid;
            gap: 6px;
        }

        .warna-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14.5px;
            color: #4F5A50;
        }

        .warna-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        .warna-dot.aktif {
            background: #727D73;
        }

        .warna-dot.dijawab {
            background: #AAB99A;
        }

        .warna-dot.ragu {
            background: #C5BAA0;
        }

        .warna-dot.belum {
            background: #E8D9B8;
            border: 1px solid #C5BAA0;
        }

        .petunjuk-actions {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .petunjuk-btn {
            min-width: 145px;
            padding: 13px 28px;
            border-radius: 14px;
            border: none;
            text-decoration: none;
            text-align: center;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .petunjuk-btn.mulai {
            background: #727D73;
            color: #FFFFFF;
        }

        .petunjuk-btn.mulai:hover {
            background: #5E695F;
            color: #FFFFFF;
        }

        .petunjuk-btn.kembali {
            background: #E8E4D6;
            color: #4F5A50;
        }

        .petunjuk-btn.kembali:hover {
            background: #D8D2C0;
            color: #4F5A50;
        }

        @media (max-width: 768px) {
            .petunjuk-kuis-page {
                align-items: flex-start;
                padding: 20px 12px;
            }

            .petunjuk-kuis-card {
                padding: 28px 20px;
            }

            .petunjuk-kuis-title {
                font-size: 28px;
            }

            .petunjuk-kuis-subtitle {
                font-size: 20px;
            }

            .petunjuk-list li {
                font-size: 14px;
            }

            .petunjuk-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="petunjuk-kuis-page">
        <div class="petunjuk-kuis-card">
            <h1 class="petunjuk-kuis-title">
                {{ $judulHalaman }}
            </h1>

            <h2 class="petunjuk-kuis-subtitle">
                Petunjuk Pengerjaan {{ $isEvaluasi ? 'Evaluasi' : 'Kuis' }}
            </h2>

            <ol class="petunjuk-list">
                <li>
                    Terdapat <strong>{{ $jumlahSoal }} soal pilihan ganda</strong> yang harus dikerjakan.
                    Untuk mulai mengerjakan, tekan tombol <strong>Mulai</strong>.
                </li>

                <li>
                    Waktu pengerjaan {{ $isEvaluasi ? 'evaluasi' : 'kuis' }} adalah
                    <strong>{{ $durasiMenit }} menit</strong>. Sisa waktu dapat dilihat pada bagian
                    <strong>kanan atas</strong> halaman. Jika waktu habis, jawaban akan dikumpulkan secara otomatis.
                </li>

                <li>
                    Pilih satu jawaban yang menurut kamu paling benar pada setiap soal.
                </li>

                <li>
                    Untuk berpindah soal, gunakan tombol <strong>Sebelumnya</strong>, <strong>Berikutnya</strong>,
                    atau klik nomor soal pada bagian navigasi di sebelah kanan.
                </li>

                <li>
                    Gunakan tombol <strong>Ragu-ragu</strong> jika kamu ingin menandai soal yang masih ingin diperiksa
                    kembali sebelum jawaban dikumpulkan.
                </li>

                <li>
                    Keterangan warna pada nomor soal:
                    <div class="warna-nomor">
                        <div class="warna-item">
                            <span class="warna-dot belum"></span>
                            Belum dijawab
                        </div>

                        <div class="warna-item">
                            <span class="warna-dot dijawab"></span>
                            Sudah dijawab
                        </div>

                        <div class="warna-item">
                            <span class="warna-dot ragu"></span>
                            Ragu-ragu
                        </div>
                    </div>
                </li>

                <li>
                    Setelah semua soal dijawab, tekan tombol <strong>Kumpulkan Jawaban</strong> untuk mengirim jawaban.
                    Jawaban yang sudah dikumpulkan tidak dapat diubah kembali.
                </li>
            </ol>

            <div class="petunjuk-actions">
                <a href="{{ route('quiz.show', $quiz->id) }}" class="petunjuk-btn mulai">
                    MULAI
                </a>

                <a href="{{ $urlKembali }}" class="petunjuk-btn kembali">
                    KEMBALI
                </a>
            </div>
        </div>
    </div>
</body>

</html>