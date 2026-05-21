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
      --green-main: #92a67d;
      --green-dark: #6f7f5c;
      --green-soft: #eef3e7;
      --cream-bg: #fffbea;
      --cream-soft: #f7f2e3;
      --line: #e6deca;
      --text-main: #433d33;
      --text-soft: #7c7466;
      --pending-bg: #fff1c9;
      --pending-text: #a17616;
      --done-bg: #dcefd9;
      --done-text: #347346;
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
      background: linear-gradient(180deg, #fffdf7 0%, #fff9ec 100%);
      color: var(--text-main);
      padding-top: 82px;
      min-height: 100vh;
    }

    .navbar-polymathica {
      background: rgba(255, 255, 255, 0.96);
      border-bottom: 1px solid #eee6d4;
      backdrop-filter: blur(8px);
      height: 82px;
      box-shadow: 0 8px 24px rgba(113, 98, 60, 0.04);
    }

    .logo-img {
      height: 33px;
    }

    .logo-word {
      font-family: "Playfair Display", serif;
      font-size: 1rem;
      font-weight: 700;
      letter-spacing: 2px;
      color: #8a9a73;
      margin-top: 4px;
    }

    .nav-link {
      color: #5a5548;
      font-weight: 500;
    }

    .nav-link.active,
    .nav-link:hover {
      color: var(--text-main);
      font-weight: 700;
    }

    .page-wrap {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    .back-section {
      width: 100%;
      padding: 24px 40px 0;
    }

    .btn-kembali {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 11px 18px;
      border-radius: 999px;
      background: var(--green-dark);
      border: 1px solid var(--green-dark);
      color: #ffffff;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 800;
      box-shadow: 0 10px 24px rgba(113, 98, 60, 0.12);
      transition: all 0.2s ease;
    }

    .btn-kembali:hover {
      background: #5f6f4d;
      border-color: #5f6f4d;
      color: #ffffff;
      text-decoration: none;
      transform: translateY(-2px);
      box-shadow: 0 14px 30px rgba(111, 127, 92, 0.22);
    }

    .back-icon {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.15rem;
      font-weight: 800;
    }

    .top-section {
      width: 100%;
      padding: 24px 40px 28px;
      background: transparent;
    }

    .student-card-main {
      background: rgba(255, 255, 255, 0.86);
      border: 1px solid var(--line);
      border-radius: 30px;
      padding: 30px;
      box-shadow: 0 18px 40px rgba(113, 98, 60, 0.08);
    }

    .student-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      flex-wrap: wrap;
      padding-bottom: 22px;
      margin-bottom: 22px;
      border-bottom: 1px solid var(--line);
    }

    .student-info {
      display: flex;
      align-items: center;
      gap: 18px;
      flex-wrap: wrap;
    }

    .student-avatar {
      width: 72px;
      height: 72px;
      border-radius: 24px;
      background: linear-gradient(135deg, #9caf86, #6f7f5c);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.55rem;
      font-weight: 800;
      box-shadow: 0 16px 30px rgba(111, 127, 92, 0.24);
    }

    .student-label {
      font-size: 0.95rem;
      color: var(--text-soft);
      margin-bottom: 2px;
      font-weight: 500;
    }

    .student-name {
      font-size: 2rem;
      font-weight: 800;
      color: var(--text-main);
      line-height: 1.1;
    }

    .progress-badge-top {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border-radius: 999px;
      background: var(--green-soft);
      color: var(--green-dark);
      font-size: 0.95rem;
      font-weight: 800;
      border: 1px solid rgba(146, 166, 125, 0.25);
      white-space: nowrap;
    }

    .headline {
      font-size: 2.7rem;
      font-weight: 800;
      margin-bottom: 12px;
      color: var(--text-main);
      letter-spacing: -1px;
      line-height: 1.15;
    }

    .subheadline {
      color: var(--text-soft);
      font-size: 1.08rem;
      line-height: 1.9;
      width: 100%;
      margin-bottom: 0;
      font-weight: 500;
    }

    .progress-section {
      width: 100%;
      padding: 0 40px;
      background: transparent;
      margin-bottom: 28px;
    }

    .progress-card {
      background: rgba(255, 255, 255, 0.82);
      border: 1px solid var(--line);
      border-radius: 28px;
      padding: 26px;
      box-shadow: 0 16px 35px rgba(113, 98, 60, 0.08);
    }

    .progress-header {
      display: flex;
      justify-content: space-between;
      align-items: end;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 14px;
    }

    .progress-title {
      font-size: 1.35rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .progress-caption {
      color: var(--text-soft);
      margin-bottom: 0;
    }

    .progress-percent {
      font-size: 2rem;
      font-weight: 800;
      color: var(--green-dark);
      line-height: 1;
    }

    .progress-bar-wrap {
      width: 100%;
      height: 22px;
      background: #ebe3d2;
      border-radius: 999px;
      overflow: hidden;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .progress-bar-fill {
      width: 0%;
      height: 100%;
      background: linear-gradient(90deg, #a7b893 0%, #7b8d67 100%);
      border-radius: 999px;
      transition: width 0.8s ease;
      position: relative;
    }

    .progress-bar-fill::after {
      content: "";
      position: absolute;
      right: 6px;
      top: 50%;
      transform: translateY(-50%);
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.95);
    }

    .stats-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-top: 22px;
    }

    .stat-card {
      background: #fffdf7;
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: 18px 20px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(113, 98, 60, 0.08);
    }

    .stat-label {
      font-size: 0.95rem;
      color: var(--text-soft);
      margin-bottom: 6px;
    }

    .stat-value {
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--text-main);
      line-height: 1.2;
    }

    .materi-section {
      width: 100%;
      padding: 0 40px 50px;
    }

    .materi-box {
      background: rgba(255, 255, 255, 0.86);
      border: 1px solid var(--line);
      border-radius: 30px;
      padding: 26px;
      box-shadow: 0 18px 40px rgba(113, 98, 60, 0.08);
    }

    .materi-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 18px;
      flex-wrap: wrap;
      padding-bottom: 18px;
      margin-bottom: 18px;
      border-bottom: 1px solid var(--line);
    }

    .section-title {
      font-size: 1.55rem;
      font-weight: 800;
      margin: 0;
      color: var(--text-main);
    }

    .materi-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .materi-card {
      display: block;
      text-decoration: none;
      color: inherit;
      background: #fffdf7;
      border: 1px solid #eee5d3;
      border-radius: 22px;
      padding: 20px 22px;
      transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .materi-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 14px 30px rgba(113, 98, 60, 0.11);
      border-color: rgba(146, 166, 125, 0.5);
      background: #ffffff;
      color: inherit;
    }

    .materi-card:hover .materi-title {
      color: var(--green-dark);
      text-decoration: underline;
    }

    .materi-card-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      width: 100%;
    }

    .materi-left {
      display: flex;
      align-items: center;
      gap: 16px;
      min-width: 0;
      flex: 1;
    }

    .materi-number {
      width: 42px;
      height: 42px;
      border-radius: 15px;
      background: var(--green-soft);
      color: var(--green-dark);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 0.95rem;
      flex: 0 0 auto;
    }

    .materi-text {
      min-width: 0;
      flex: 1;
    }

    .materi-title {
      font-size: 1.08rem;
      font-weight: 800;
      color: var(--text-main);
      line-height: 1.45;
      margin: 0;
    }

    .materi-right {
      display: flex;
      align-items: center;
      gap: 14px;
      flex: 0 0 auto;
    }

    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 13px;
      font-weight: 700;
      white-space: nowrap;
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
      width: 8px;
      height: 8px;
      border-radius: 50%;
      display: inline-block;
    }

    .status-pill.done .dot {
      background: #469059;
    }

    .status-pill.pending .dot {
      background: #cc9723;
    }

    .empty-card {
      text-align: center;
      padding: 34px 20px;
      border: 1px dashed var(--line);
      border-radius: 22px;
      background: #fffdf7;
      color: var(--text-soft);
      font-weight: 600;
    }

    @media (max-width: 991px) {
      .headline {
        font-size: 2rem;
      }

      .student-name {
        font-size: 1.55rem;
      }

      .student-avatar {
        width: 62px;
        height: 62px;
        border-radius: 20px;
      }

      .progress-percent {
        font-size: 1.6rem;
      }

      .stats-row {
        grid-template-columns: 1fr;
      }

      .back-section,
      .top-section,
      .progress-section,
      .materi-section {
        padding-left: 24px;
        padding-right: 24px;
      }
    }

    @media (max-width: 576px) {
      body {
        padding-top: 76px;
      }

      .navbar-polymathica {
        height: 76px;
      }

      .back-section {
        padding: 18px 18px 0;
      }

      .btn-kembali {
        width: 100%;
        justify-content: center;
        padding: 11px 14px;
        font-size: 0.9rem;
      }

      .top-section {
        padding: 18px 18px 24px;
      }

      .student-card-main {
        border-radius: 24px;
        padding: 22px;
      }

      .student-card-header {
        align-items: flex-start;
      }

      .progress-section,
      .materi-section {
        padding-left: 18px;
        padding-right: 18px;
      }

      .progress-card,
      .materi-box {
        border-radius: 24px;
        padding: 20px;
      }

      .headline {
        font-size: 1.75rem;
      }

      .subheadline {
        font-size: 0.98rem;
      }

      .materi-card {
        padding: 18px;
      }

      .materi-card-content {
        flex-direction: column;
        align-items: stretch;
      }

      .materi-left {
        align-items: center;
      }

      .materi-right {
        justify-content: flex-start;
        padding-left: 58px;
      }

      .section-title {
        font-size: 1.35rem;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-polymathica px-4 fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand d-flex flex-column align-items-center text-center" href="{{ route('landingpage') }}">
        <img src="{{ asset('img/2.png') }}" class="logo-img" alt="Logo">
        <span class="logo-word">POLIMATHICA</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
        aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <ul class="navbar-nav gap-4">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('landingpage') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('petunjukpenggunaan') }}">Petunjuk Penggunaan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('progressbelajar') }}">Progres Belajar</a>
          </li>
        </ul>
      </div>
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

    <section class="back-section">
      <a href="{{ $previousUrl }}" class="btn-kembali">
        <span class="back-icon">‹</span>
        Kembali ke Materi
      </a>
    </section>

    <section class="top-section">
      <div class="student-card-main">
        <div class="student-card-header">
          <div class="student-info">
            <div class="student-avatar">{{ $inisial }}</div>

            <div>
              <div class="student-label">Siswa aktif</div>
              <div class="student-name">{{ $namaSiswa }}</div>
            </div>
          </div>

          <div class="progress-badge-top">
            Progress {{ $safePercent }}%
          </div>
        </div>

        <h1 class="headline">Progres Belajar Kamu</h1>

        <p class="subheadline">
          @if ($done === 0)
            Pantau perkembangan belajar polinomialmu di sini. Mulailah dari materi pertama agar progresmu segera terisi.
          @elseif ($done === $total)
            Semua materi dan kuis telah selesai. Hasil belajarmu sangat baik dan progresmu sudah lengkap.
          @else
            Pantau perkembangan belajar polinomialmu di sini. Selesaikan materi satu per satu agar progresmu terus meningkat dan belajarmu lebih terarah.
          @endif
        </p>
      </div>
    </section>

    <section class="progress-section">
      <div class="progress-card">
        <div class="progress-header">
          <div>
            <div class="progress-title">
              {{ $done }} dari {{ $total }} materi/kuis telah diselesaikan
            </div>

            <p class="progress-caption">
              Terus lanjutkan materi dan latihan untuk meningkatkan progres belajarmu.
            </p>
          </div>

          <div class="progress-percent">
            {{ $safePercent }}%
          </div>
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

          <div class="stat-card">
            <div class="stat-label">Total materi/kuis</div>
            <div class="stat-value">{{ $total }}</div>
          </div>
        </div>
      </div>
    </section>

    <section id="daftarMateriKuis" class="materi-section">
      <div class="materi-box">
        <div class="materi-header">
          <h2 class="section-title">Daftar Materi dan Kuis</h2>

          <div class="progress-badge-top">
            {{ $done }} / {{ $total }} selesai
          </div>
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

                /*
                  Aturan:
                  - Kalau item sudah selesai, klik ke halaman item tersebut.
                  - Kalau item belum selesai, klik ke materi sebelumnya yang sudah selesai.
                  - Kalau belum ada materi sebelumnya yang selesai, fallback ke halaman sebelumnya.
                */
                $targetUrl = $itemCompleted ? $itemUrl : ($lastCompletedUrl ?? $previousUrl);
              @endphp

              <a href="{{ $targetUrl }}" class="materi-card">
                <div class="materi-card-content">
                  <div class="materi-left">
                    <div class="materi-number">
                      {{ $loop->iteration }}
                    </div>

                    <div class="materi-text">
                      <h3 class="materi-title">{{ $itemTitle }}</h3>
                    </div>
                  </div>

                  <div class="materi-right">
                    @if ($itemCompleted)
                      <span class="status-pill done">
                        <span class="dot"></span>
                        Selesai
                      </span>
                    @else
                      <span class="status-pill pending">
                        <span class="dot"></span>
                        Belum Selesai
                      </span>
                    @endif
                  </div>
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

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
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