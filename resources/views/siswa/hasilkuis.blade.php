<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Quiz</title>

    <style>
        :root {
            --bg-main: #F3F0EB;
            --card-bg: #F8F4EC;

            --sage-dark: #7D877C;
            --sage: #A7B596;
            --mist: #BECBBF;
            --beige: #DCCFBB;
            --cream: #E8E4CF;
            --taupe: #C4B095;
            --taupe-dark: #A99A81;

            --text-dark: #5F5A4E;
            --text-soft: #857C6D;
            --white-soft: #FFFDF8;

            --success-bg: #E5EBDC;
            --success-text: #667357;

            --warning-bg: #EFE3D6;
            --warning-text: #8A745B;

            --shadow: 0 18px 45px rgba(125, 135, 124, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 760px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 28px;
            padding: 42px 34px;
            box-shadow: var(--shadow);
            text-align: center;
            position: relative;
            border: 1px solid rgba(169, 154, 129, 0.14);
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .title {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
            letter-spacing: 0.3px;
        }

        .subtitle {
            font-size: 16px;
            color: var(--text-soft);
            margin-bottom: 18px;
        }

        .divider {
            width: 90px;
            height: 4px;
            background: linear-gradient(90deg, var(--sage), var(--taupe));
            margin: 0 auto 28px;
            border-radius: 999px;
            opacity: 0.8;
        }

        .score-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
        }

        .score-ring {
            width: 212px;
            height: 212px;
            border-radius: 50%;
            background: rgba(167, 181, 150, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .score-circle {
            width: 182px;
            height: 182px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--sage-dark), var(--sage));
            color: var(--white-soft);
            box-shadow: 0 16px 34px rgba(125, 135, 124, 0.18);
            flex-direction: column;
            border: 5px solid rgba(255, 253, 248, 0.58);
        }

        .score-number {
            font-size: 58px;
            font-weight: 800;
            line-height: 1;
        }

        .score-label {
            margin-top: 10px;
            font-size: 17px;
            font-weight: 600;
            opacity: 0.96;
        }

        .status {
            display: inline-block;
            margin-bottom: 28px;
            padding: 13px 22px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            max-width: 100%;
        }

        .status.success {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .status.warning {
            background: var(--warning-bg);
            color: var(--warning-text);
        }

        .details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 8px;
            margin-bottom: 34px;
        }

        .detail-box {
            border-radius: 20px;
            padding: 22px 16px;
            border: 1px solid rgba(169, 154, 129, 0.16);
            box-shadow: 0 10px 20px rgba(125, 135, 124, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .detail-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 24px rgba(125, 135, 124, 0.08);
        }

        .detail-box:nth-child(1) {
            background: #EEF1E8;
        }

        .detail-box:nth-child(2) {
            background: #E7ECE2;
        }

        .detail-box:nth-child(3) {
            background: #EFE6DA;
        }

        .detail-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 12px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: var(--text-dark);
            background: rgba(255, 253, 248, 0.72);
            border: 1px solid rgba(169, 154, 129, 0.12);
        }

        .detail-value {
            font-size: 30px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .detail-label {
            font-size: 14px;
            color: var(--text-soft);
            font-weight: 600;
        }

        .buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 14px;
            margin-top: 6px;
        }

        .btn {
            text-decoration: none;
            padding: 14px 24px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.22s ease;
            display: inline-block;
            min-width: 230px;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--taupe), var(--taupe-dark));
            color: var(--white-soft);
            box-shadow: 0 10px 22px rgba(169, 154, 129, 0.22);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            filter: brightness(0.98);
        }

        .btn-secondary {
            background: var(--cream);
            color: var(--text-dark);
            border: 1px solid rgba(169, 154, 129, 0.2);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            background: #E3DDC6;
        }

        .footer-note {
            margin-top: 22px;
            font-size: 13px;
            color: var(--text-soft);
            opacity: 0.9;
        }

        @media (max-width: 640px) {
            .card {
                padding: 30px 20px;
                border-radius: 22px;
            }

            .title {
                font-size: 28px;
            }

            .subtitle {
                font-size: 15px;
            }

            .score-ring {
                width: 180px;
                height: 180px;
            }

            .score-circle {
                width: 150px;
                height: 150px;
            }

            .score-number {
                font-size: 46px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                min-width: unset;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="content">
                <div class="title">Hasil Quiz</div>
                <div class="subtitle">Berikut hasil pengerjaan quiz kamu</div>
                <div class="divider"></div>

                <div class="score-wrap">
                    <div class="score-ring">
                        <div class="score-circle">
                            <div class="score-number">{{ $nilai ?? 0 }}</div>
                            <div class="score-label">Skor</div>
                        </div>
                    </div>
                </div>

                @if($lulus ?? false)
                    <div class="status success">
                        Selamat, nilai kamu sudah memenuhi KKM {{ $kkm ?? '-' }}. Kamu bisa melanjutkan ke materi
                        berikutnya.
                    </div>
                @else
                    <div class="status warning">
                        Skormu kurang dari KKM {{ $kkm ?? '-' }}, silakan pelajari lagi materinya dan ulangi quiz.
                    </div>
                @endif

                <div class="details">
                    <div class="detail-box">
                        <div class="detail-icon">⏱</div>
                        <div class="detail-value">
                            {{ $durasiMenit ?? 0 }}m {{ str_pad($durasiSisaDetik ?? 0, 2, '0', STR_PAD_LEFT) }}s
                        </div>
                        <div class="detail-label">Durasi Pengerjaan</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-icon">✓</div>
                        <div class="detail-value">{{ $benar ?? 0 }}</div>
                        <div class="detail-label">Jawaban Benar</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-icon">✕</div>
                        <div class="detail-value">{{ $salah ?? 0 }}</div>
                        <div class="detail-label">Jawaban Salah</div>
                    </div>
                </div>

                <div class="buttons">
                    @if ($lulus)
                        {{-- Kuis E selesai, lanjut ke Evaluasi --}}
                        @if ($quiz->id == 5)
                            @if ($previousMateri)
                                <a href="{{ route('materi.show', $previousMateri->slug) }}" class="btn btn-secondary">
                                    Kembali ke Halaman Materi
                                </a>
                            @endif

                            <a href="{{ route('quiz.show', 6) }}" class="btn btn-primary">
                                Kerjakan Evaluasi
                            </a>

                            {{-- Evaluasi selesai, kembali ke peta konsep --}}
                        @elseif ($quiz->id == 6)
                            <a href="{{ route('petakonsep') }}" class="btn btn-primary">
                                Kembali ke Peta Konsep
                            </a>

                            {{-- Kuis bab biasa, lanjut ke bab berikutnya --}}
                        @elseif ($nextMateri)
                            @if ($previousMateri)
                                <a href="{{ route('materi.show', $previousMateri->slug) }}" class="btn btn-secondary">
                                    Kembali ke Halaman Materi
                                </a>
                            @endif

                            <a href="{{ route('materi.show', $nextMateri->slug) }}" class="btn btn-primary">
                                Lanjut ke Materi Berikutnya
                            </a>

                        @else
                            <a href="{{ route('petakonsep') }}" class="btn btn-primary">
                                Kembali ke Peta Konsep
                            </a>
                        @endif

                    @else
                        {{-- Jika tidak lulus --}}
                        @if ($quiz->id == 6)
                            <a href="{{ route('petakonsep') }}" class="btn btn-secondary">
                                Kembali ke Peta Konsep
                            </a>
                        @elseif ($previousMateri)
                            <a href="{{ route('materi.show', $previousMateri->slug) }}" class="btn btn-secondary">
                                Kembali ke Materi Sebelumnya
                            </a>
                        @endif

                        <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-primary">
                            Ulangi Kuis
                        </a>
                    @endif
                </div>

                <div class="footer-note">
                    Tetap semangat belajar, hasil bisa meningkat dengan latihan yang konsisten.
                </div>

            </div>
        </div>
    </div>
</body>

</html>