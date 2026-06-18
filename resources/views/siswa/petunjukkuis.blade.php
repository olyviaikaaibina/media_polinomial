{{-- resources/views/quiz/petunjuk-kuis.blade.php --}}
@extends('layout.navbar')

@section('title', 'Petunjuk Pengerjaan Kuis')

@section('content')

    @php
        $isEvaluasi = $isEvaluasi ?? false;
        $durasiMenit = $durasiMenit ?? ($isEvaluasi ? 30 : 20);
        $jumlahSoal = $jumlahSoal ?? 10;
        $judulHalaman = $isEvaluasi ? 'EVALUASI' : 'KUIS';
    @endphp

    <style>
        .petunjuk-kuis-page {
            background: #FDFDE8;
            min-height: calc(100vh - 80px);
            padding: 35px 16px;
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
            padding: 42px 54px;
            box-shadow: 0 18px 45px rgba(114, 125, 115, 0.12);
        }

        .petunjuk-kuis-title {
            text-align: center;
            font-size: 36px;
            font-weight: 900;
            color: #727D73;
            margin: 0 0 12px;
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
            font-size: 16px;
            line-height: 1.75;
            color: #3F463F;
            margin-bottom: 14px;
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
            font-size: 15px;
            color: #4F5A50;
        }

        .warna-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
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
            margin-top: 34px;
            flex-wrap: wrap;
        }

        .petunjuk-btn {
            min-width: 145px;
            padding: 14px 28px;
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
            .petunjuk-kuis-card {
                padding: 30px 22px;
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
        }
    </style>

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
                    kembali
                    sebelum jawaban dikumpulkan.
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

                <a href="{{ url()->previous() }}" class="petunjuk-btn kembali">
                    KEMBALI
                </a>
            </div>
        </div>
    </div>

@endsection