<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Progres Belajar - Polimathica</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <style>
        :root {
            --green-main: #6f8f49;
            --green-dark: #4f6b2f;
            --green-soft: #e4edd8;
            --cream-bg: #f7f3ea;
            --cream-card: #fffdf9;
            --line: #d7ccb8;
            --text-main: #3a3126;
            --text-soft: #6e6253;
            --pending-bg: #ffe5ae;
            --pending-text: #9b6400;
            --done-bg: #d8ebcb;
            --done-text: #2f6d2f;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            font-family: "Poppins", sans-serif;
            background: var(--cream-bg);
            color: var(--text-main);
            padding-top: 72px;
            min-height: 100vh;
        }

        .navbar-polymathica {
            background: #ffffff;
            border-bottom: 1px solid #ddd2bf;
            height: 72px;
            box-shadow: 0 4px 14px rgba(58, 49, 38, 0.05);
        }

        .logo-img {
            height: 28px;
        }

        .logo-word {
            font-family: "Playfair Display", serif;
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: 1.6px;
            color: var(--green-dark);
            margin-top: 2px;
            line-height: 1;
        }

        .nav-link {
            color: #5a5144;
            font-weight: 600;
            font-size: 0.98rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--green-dark);
        }

        .page-wrap {
            width: 100%;
            padding: 20px 16px 36px;
        }

        .content-shell {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
        }

        .top-bar {
            margin-bottom: 14px;
        }

        .btn-kembali {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            border-radius: 999px;
            background: var(--green-dark);
            border: 1px solid var(--green-dark);
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-kembali:hover {
            background: #3f5826;
            border-color: #3f5826;
            color: #fff;
            text-decoration: none;
        }

        .back-icon {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 800;
            line-height: 1;
        }

        .simple-card {
            background: var(--cream-card);
            border: 1px solid var(--line);
            border-radius: 22px;
            box-shadow: 0 8px 22px rgba(58, 49, 38, 0.05);
        }

        .student-card {
            padding: 22px 24px;
            margin-bottom: 16px;
        }

        .student-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .student-avatar {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: linear-gradient(135deg, #7d9b57, #587638);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .student-label {
            font-size: 0.88rem;
            color: var(--text-soft);
            margin-bottom: 2px;
            font-weight: 600;
        }

        .student-name {
            font-size: 1.55rem;
            font-weight: 800;
            line-height: 1.15;
            margin: 0;
            word-break: break-word;
        }

        .progress-badge-top {
            display: inline-flex;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: var(--green-soft);
            color: var(--green-dark);
            font-size: 0.92rem;
            font-weight: 800;
            border: 1px solid #c8d9b3;
            white-space: nowrap;
        }

        .headline {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 8px;
            line-height: 1.15;
            color: var(--text-main);
        }

        .subheadline {
            font-size: 1rem;
            color: var(--text-soft);
            line-height: 1.7;
            margin: 0;
        }

        .progress-card {
            padding: 20px 22px;
            margin-bottom: 18px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .progress-title {
            font-size: 1.15rem;
            font-weight: 800;
            margin: 0 0 4px;
            line-height: 1.4;
        }

        .progress-caption {
            margin: 0;
            color: var(--text-soft);
            font-size: 0.94rem;
            line-height: 1.6;
        }

        .progress-percent {
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--green-dark);
            line-height: 1;
        }

        .progress-bar-wrap {
            width: 100%;
            height: 14px;
            background: #e5dccb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .progress-bar-fill {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #7d9b57 0%, #587638 100%);
            border-radius: 999px;
            transition: width 0.8s ease;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .stat-card {
            background: #fffefb;
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 14px 16px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-soft);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.55rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--text-main);
        }

        .materi-section {
            margin-top: 4px;
        }

        .materi-box {
            padding: 20px 22px;
        }

        .materi-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0;
        }

        .mini-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: var(--green-soft);
            color: var(--green-dark);
            font-size: 0.85rem;
            font-weight: 700;
            border: 1px solid #c8d9b3;
        }

        .materi-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .materi-card {
            display: block;
            text-decoration: none;
            color: inherit;
            background: #fffefb;
            border: 1px solid #dfd3bf;
            border-radius: 16px;
            padding: 14px 16px;
            transition: all 0.2s ease;
        }

        .materi-card:hover {
            color: inherit;
            text-decoration: none;
            border-color: #aec58a;
            box-shadow: 0 8px 18px rgba(58, 49, 38, 0.06);
            transform: translateY(-1px);
        }

        .materi-card-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .materi-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }

        .materi-number {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--green-soft);
            color: var(--green-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.88rem;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .materi-title {
            font-size: 0.98rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.45;
            color: var(--text-main);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            white-space: nowrap;
            flex: 0 0 auto;
        }

        .status-pill.done {
            background: var(--done-bg);
            color: var(--done-text);
        }

        .status-pill.pending {
            background: var(--pending-bg);
            color: var(--pending-text);
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-pill.done .dot {
            background: #2f8a2f;
        }

        .status-pill.pending .dot {
            background: #d88900;
        }

        .empty-card {
            text-align: center;
            padding: 24px 16px;
            border: 1px dashed var(--line);
            border-radius: 16px;
            color: var(--text-soft);
            background: #fffefb;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 68px;
            }

            .navbar-polymathica {
                height: 68px;
            }

            .page-wrap {
                padding: 16px 12px 28px;
            }

            .student-card,
            .progress-card,
            .materi-box {
                padding: 18px;
            }

            .headline {
                font-size: 1.6rem;
            }

            .student-name {
                font-size: 1.3rem;
            }

            .progress-percent {
                font-size: 1.35rem;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .materi-card-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .status-pill {
                margin-left: 46px;
            }

            .btn-kembali {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-polymathica px-3 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex flex-column align-items-center text-center" href="{{ route('landingpage') }}">
                <img src="{{ asset('img/2.png') }}" class="logo-img" alt="Logo">
                <span class="logo-word">POLIMATHICA</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    @php
        $namaSiswa = $siswa->nama ?? 'Guest';
        $inisial = strtoupper(substr($namaSiswa, 0, 1));

        $safePercent = is_numeric($percent) ? (float) $percent : 0;
        $safePercent = max(0, min(100, $safePercent));

        $previousUrl = url()->previous();
        $currentUrl = url()->current();

        if ($previousUrl === $currentUrl) {
            $previousUrl = route('landingpage');
        }
    @endphp

    <main class="page-wrap">
        <div class="content-shell">

            <div class="top-bar">
                <a href="{{ $previousUrl }}" class="btn-kembali">
                    <span class="back-icon">‹</span>
                    Kembali ke Materi
                </a>
            </div>

            <section class="simple-card student-card">
                <div class="student-card-header">
                    <div class="student-info">
                        <div class="student-avatar">{{ $inisial }}</div>
                        <div>
                            <div class="student-label">Siswa aktif</div>
                            <h1 class="student-name">{{ $namaSiswa }}</h1>
                        </div>
                    </div>

                    <div class="progress-badge-top">
                        Progress {{ $safePercent }}%
                    </div>
                </div>

                <h2 class="headline">Progres Belajar Kamu</h2>

                <p class="subheadline">
                    @if ($done === 0)
                        Kamu belum menyelesaikan materi atau kuis. Yuk mulai belajar agar progresmu segera terisi.
                    @elseif ($done === $total)
                        Semua materi dan kuis telah selesai. Hasil belajarmu sangat baik dan progresmu sudah lengkap.
                    @else
                        Kamu sudah menyelesaikan sebagian materi. Lanjutkan belajar agar progresmu terus meningkat.
                    @endif
                </p>
            </section>

            <section class="simple-card progress-card">
                <div class="progress-header">
                    <div>
                        <h3 class="progress-title">{{ $done }} dari {{ $total }} materi/kuis telah diselesaikan</h3>
                        <p class="progress-caption">Terus lanjutkan materi dan latihan untuk meningkatkan progres belajarmu.</p>
                    </div>

                    <div class="progress-percent">{{ $safePercent }}%</div>
                </div>

                <div class="progress-bar-wrap">
                    <div class="progress-bar-fill" data-progress="{{ $safePercent }}"></div>
                </div>

                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-label">Materi/Kuis selesai</div>
                        <div class="stat-value">{{ $done }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">Materi/Kuis tersisa</div>
                        <div class="stat-value">{{ $left }}</div>
                    </div>
                </div>
            </section>

            <section id="daftarMateriKuis" class="materi-section">
                <div class="simple-card materi-box">
                    <div class="materi-header">
                        <h2 class="section-title">Daftar Materi dan Kuis</h2>
                        <span class="mini-badge">{{ $done }} / {{ $total }} selesai</span>
                    </div>

                    @if (!empty($items) && count($items) > 0)
                        <div class="materi-list">
                            @php
                                $lastCompletedUrl = null;
                            @endphp

                            @foreach ($items as $item)
                                @php
                                    $itemTitle = $item['title'] ?? 'Materi';
                                    $itemCompleted = $item['is_completed'] ?? false;
                                    $itemUrl = '#';

                                    if (!empty($item['url'])) {
                                        $itemUrl = $item['url'];
                                    } elseif (!empty($item['route'])) {
                                        $itemUrl = $item['route'];
                                    } elseif (!empty($item['slug'])) {
                                        $itemUrl = route('materi.show', $item['slug']);
                                    } elseif (!empty($item['materi_slug'])) {
                                        $itemUrl = route('materi.show', $item['materi_slug']);
                                    } elseif (!empty($item['quiz_id'])) {
                                        $itemUrl = route('quiz.show', $item['quiz_id']);
                                    } elseif (!empty($item['id']) && !empty($item['type']) && $item['type'] === 'quiz') {
                                        $itemUrl = route('quiz.show', $item['id']);
                                    } elseif (!empty($item['id']) && !empty($item['type']) && $item['type'] === 'materi') {
                                        $itemUrl = route('materi.show', $item['id']);
                                    }

                                    $targetUrl = $itemCompleted ? $itemUrl : ($lastCompletedUrl ?? $previousUrl);
                                @endphp

                                <a href="{{ $targetUrl }}" class="materi-card">
                                    <div class="materi-card-content">
                                        <div class="materi-left">
                                            <div class="materi-number">{{ $loop->iteration }}</div>
                                            <h3 class="materi-title">{{ $itemTitle }}</h3>
                                        </div>

                                        @if ($itemCompleted)
                                            <span class="status-pill done">
                                                <span class="dot"></span>
                                                Selesai
                                            </span>
                                        @else
                                            <span class="status-pill pending">
                                                <span class="dot"></span>
                                                Belum selesai
                                            </span>
                                        @endif
                                    </div>
                                </a>

                                @php
                                    if ($itemCompleted) {
                                        $lastCompletedUrl = $itemUrl;
                                    }
                                @endphp
                            @endforeach
                        </div>
                    @else
                        <div class="empty-card">
                            Belum ada data materi.
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const progressBar = document.querySelector(".progress-bar-fill");

            if (progressBar) {
                const progressValue = Number(progressBar.dataset.progress) || 0;
                const safeProgress = Math.max(0, Math.min(100, progressValue));
                progressBar.style.width = safeProgress + "%";
            }
        });
    </script>

</body>

</html>