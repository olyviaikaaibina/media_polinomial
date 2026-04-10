<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Progres Belajar - Polimathica</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
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

    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(180deg, #fffdf7 0%, #fff9ec 100%);
      color: var(--text-main);
      padding-top: 92px;
    }

    .navbar-polymathica {
      background: rgba(255, 255, 255, 0.96);
      border-bottom: 1px solid #eee6d4;
      backdrop-filter: blur(8px);
      height: 82px;
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
      font-weight: 600;
    }

    .page-wrap {
      max-width: 1120px;
    }

    .top-section {
      padding: 24px 0 10px;
    }

    .student-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      flex-wrap: wrap;
      margin-bottom: 18px;
    }

    .student-info {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }

    .student-avatar {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--green-main), var(--green-dark));
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      font-weight: 700;
      box-shadow: 0 8px 18px rgba(111, 127, 92, 0.18);
    }

    .student-label {
      font-size: 0.9rem;
      color: var(--text-soft);
      margin-bottom: 2px;
    }

    .student-name {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
    }

    .headline {
      font-size: 2.3rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--text-main);
    }

    .subheadline {
      color: var(--text-soft);
      font-size: 1.04rem;
      line-height: 1.9;
      max-width: 760px;
      margin-bottom: 26px;
    }

    .progress-section {
      background: transparent;
      margin-bottom: 28px;
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
      font-weight: 700;
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
      height: 100%;
      width: 0%;
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
      background: rgba(255,255,255,0.95);
    }

    .stats-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-top: 22px;
    }

    .stat-card {
      background: rgba(255, 255, 255, 0.72);
      border: 1px solid var(--line);
      border-radius: 18px;
      padding: 18px 20px;
    }

    .stat-label {
      font-size: 0.95rem;
      color: var(--text-soft);
      margin-bottom: 6px;
    }

    .stat-value {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
    }

    .section-title {
      font-size: 1.35rem;
      font-weight: 700;
      margin: 30px 0 16px;
    }

    .table-wrap {
      background: rgba(255,255,255,0.85);
      border: 1px solid var(--line);
      border-radius: 22px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(113, 98, 60, 0.05);
    }

    .table {
      margin-bottom: 0;
    }

    .table thead {
      background: #faf6ea;
    }

    .table th {
      padding: 16px 18px;
      font-weight: 700;
      color: #5d5648;
      border-bottom: 1px solid #ece3cf;
    }

    .table td {
      padding: 16px 18px;
      border-color: #f1ead8;
      vertical-align: middle;
    }

    .table tbody tr:hover {
      background: #fffdf7;
    }

    .materi-name {
      font-weight: 500;
      color: var(--text-main);
    }

    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 13px;
      font-weight: 600;
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

    @media (max-width: 991px) {
      .headline {
        font-size: 1.8rem;
      }

      .student-name {
        font-size: 1.45rem;
      }

      .progress-percent {
        font-size: 1.6rem;
      }

      .stats-row {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-polymathica px-4 fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand d-flex flex-column align-items-center text-center" href="#">
        <img src="{{ asset('img/2.png') }}" class="logo-img" alt="Logo">
        <span class="logo-word">POLIMATHICA</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <ul class="navbar-nav gap-4">
          <li class="nav-item"><a class="nav-link" href="{{ route('landingpage') }}">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('petunjukpenggunaan') }}">Petunjuk Penggunaan</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Progres Belajar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  @php
    use Illuminate\Support\Facades\Auth;
    $namaSiswa = Auth::guard('siswa')->user()->nama ?? 'Guest';
    $inisial = strtoupper(substr($namaSiswa, 0, 1));
  @endphp

  <div class="container page-wrap mb-5">

    <div class="top-section">
      <div class="student-row">
        <div class="student-info">
          <div class="student-avatar">{{ $inisial }}</div>
          <div>
            <div class="student-label">Siswa aktif</div>
            <div class="student-name">{{ $namaSiswa }}</div>
          </div>
        </div>
      </div>

      <h1 class="headline">Progres Belajar Kamu</h1>
      <p class="subheadline" id="descText">
        Pantau perkembangan belajar polinomialmu di sini. Mulailah dari materi pertama agar progresmu segera terisi.
      </p>
    </div>

    <div class="progress-section">
      <div class="progress-header">
        <div>
          <div class="progress-title" id="summaryText">0 dari 0 materi telah diselesaikan</div>
          <p class="progress-caption">Terus lanjutkan materi dan latihan untuk meningkatkan progres belajarmu.</p>
        </div>
        <div class="progress-percent" id="percentText">0%</div>
      </div>

      <div class="progress-bar-wrap">
        <div class="progress-bar-fill" id="progressBar"></div>
      </div>

      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-label">Materi selesai</div>
          <div class="stat-value" id="doneCount">0</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Materi tersisa</div>
          <div class="stat-value" id="leftCount">0</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Total materi</div>
          <div class="stat-value" id="totalCount">0</div>
        </div>
      </div>
    </div>

    <div class="section-title">Daftar Materi</div>

    <div class="table-wrap">
      <div class="table-responsive">
        <table class="table align-middle" id="materiTable">
          <thead>
            <tr>
              <th style="width: 70%;">Materi</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr data-status="pending">
              <td><span class="materi-name">Pengenalan Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Derajat Suatu Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Fungsi Polinomial dan Grafiknya</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Kuis - Polinomial &amp; Fungsi Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Penjumlahan Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Pengurangan Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Perkalian Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Kuis - Penjumlahan, Pengurangan dan Perkalian</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Pembagian Bersusun</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Metode Horner</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Teorema Sisa</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Kuis - Pembagian Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Teorema Faktor</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Faktor dan Pembuat Nol</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Kuis - Faktor &amp; Pembuat Nol</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Identitas Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Kuis - Identitas Polinomial</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
            <tr data-status="pending">
              <td><span class="materi-name">Evaluasi</span></td>
              <td><span class="status-pill pending"><span class="dot"></span>Belum Tuntas</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    (function () {
      const rows = document.querySelectorAll("#materiTable tbody tr");
      const total = rows.length;
      const done = Array.from(rows).filter(row => row.dataset.status === "done").length;
      const left = total - done;
      const percent = total === 0 ? 0 : Math.round((done / total) * 100);

      document.getElementById("summaryText").textContent = `${done} dari ${total} materi telah diselesaikan`;
      document.getElementById("percentText").textContent = `${percent}%`;
      document.getElementById("doneCount").textContent = done;
      document.getElementById("leftCount").textContent = left;
      document.getElementById("totalCount").textContent = total;
      document.getElementById("progressBar").style.width = `${percent}%`;

      document.getElementById("descText").textContent =
        done === 0
          ? "Pantau perkembangan belajar polinomialmu di sini. Mulailah dari materi pertama agar progresmu segera terisi."
          : done === total
            ? "Semua materi telah selesai. Hasil belajarmu sangat baik dan progresmu sudah lengkap."
            : "Pantau perkembangan belajar polinomialmu di sini. Selesaikan materi satu per satu agar progresmu terus meningkat dan belajarmu lebih terarah.";
    })();
  </script>

</body>

</html>