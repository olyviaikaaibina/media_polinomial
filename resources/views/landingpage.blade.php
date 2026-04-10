<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Polymathica – Landing Page</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>

  <style>
    :root {
      --cream-bg: #FDFDE8;
      --hero-bg: #FDFDE8;
      --brown-main: #b58b63;
      --brown-dark: #a3774c;
      --text-main: #4f4a3f;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: var(--cream-bg);
      color: var(--text-main);
    }

    /* ===== NAVBAR (SAMA SEPERTI SEBELUMNYA) ===== */
    nav.navbar {
      background-color: #ffffff !important;
      border-bottom: 1px solid #e2d7c9;
      padding: 0.75rem 1.25rem;
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }

    .brand img {
      width: 44px;
      height: auto;
    }

    .brand span {
      font-family: "Playfair Display", serif;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 3px;
      color: #85977B;
      line-height: 1.1;
      white-space: nowrap;
    }

    .nav-link {
      font-size: 0.95rem;
      color: var(--text-main) !important;
    }

    .btn-nav {
      font-size: 0.85rem;
      border-radius: 22px;
      border: 1px solid #d7c1aa;
      background-color: #f6ebdf;
      padding: 0.45rem 1.4rem;
    }

    .btn-nav-outline {
      background-color: transparent;
    }

    .btn-nav:hover {
      background-color: #e3cfb7;
    }

    /* ===== HERO ===== */
    .hero {
      background-color: var(--hero-bg);
      padding: 1.3rem 0;
    }

    .hero-img {
      max-width: 480px;
      width: 100%;
    }

    .hero-title {
      font-family: "Playfair Display", serif;
      font-size: 1.5rem;
      font-weight: 600;
    }

    .hero-subtitle {
      font-size: 0.9rem;
      font-style: italic;
      color: #7c7467;
    }

    .hero-body {
      font-size: 0.9rem;
      line-height: 1.6;
      color: #6e6458;
      text-align: justify;
    }

    .hero-text-wrapper {
      max-width: 500px;
    }

    .btn-primary-custom {
      border-radius: 22px;
      background-color: var(--brown-main);
      border: none;
      font-size: 0.85rem;
      padding: 0.5rem 2.5rem;
      color: white;
    }

    .btn-primary-custom:hover {
      background-color: var(--brown-dark);
    }

    /* ===== FITUR ===== */
    .fitur-section {
      background-color: #c7ad95;
      padding: 3rem 0;
    }

    .fitur-card {
      background: #f2e7d8;
      border-radius: 18px;
      padding: 30px 25px;
      max-width: 360px;
      min-height: 360px;
      display: flex;
      align-items: center;
      text-align: center;
      flex-direction: column;
      box-shadow: 0px 12px 28px rgba(0,0,0,0.10);
    }

    .fitur-img {
      width: 120px;
      margin-bottom: 15px;
    }

    footer {
      background-color: #ffffff;
      padding: 10px;
      border-top: 1px solid #e2d7c9;
      font-size: 0.75rem;
      color: #8f8375;
      text-align: center;
    }
  </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container-fluid">

    <!-- LOGO -->
    <a href="{{ route('landingpage') }}" class="brand me-4">
      <img src="{{ asset('img/2.png') }}" alt="Logo Polymathica">
      <span>POLIMATHICA</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto gap-lg-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('landingpage') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('daftarmateri') }}">Daftar Materi</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('petunjukpenggunaan') }}">Petunjuk Penggunaan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('tentang') }}">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Halaman Guru</a></li>
      </ul>

      <div class="d-flex gap-2 ms-3">
        <a href="{{ route('registersiswa') }}" class="btn btn-nav">Daftar</a>
        <a href="{{ route('masuksiswa') }}" class="btn btn-nav btn-nav-outline">Masuk</a>
      </div>
    </div>

  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container-fluid">
    <div class="row align-items-center g-3">
      <div class="col-md-6 text-center">
        <img src="{{ asset('img/1.png') }}" class="hero-img">
      </div>

      <div class="col-md-6">
        <div class="hero-text-wrapper">
          <h1 class="hero-title mb-1">Selamat datang di Polimathica</h1>
          <p class="hero-subtitle mb-3">a quiet place to learn, understand, and evolve</p>
          <p class="hero-body mb-4">
            Media pembelajaran ini menghadirkan metode tutorial yang memandu kamu
            memahami Polinomial Kelas 11 secara bertahap, runtut, dan interaktif.
          </p>
          <a href="{{ route('masuksiswa') }}" class="btn btn-primary-custom">
            Mulai Sekarang
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FITUR -->
<section class="fitur-section">
  <div class="container">
    <h2 class="text-center mb-5"
        style="font-family:'Playfair Display', serif; color:#fff; font-weight:700; letter-spacing:3px;">
      3 FITUR UTAMA
    </h2>

    <div class="row g-4 justify-content-center">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="fitur-card">
          <img src="{{ asset('img/4.png') }}" class="fitur-img">
          <h4>Materi Interaktif</h4>
          <p>Siswa mendapatkan umpan balik otomatis dari setiap latihan.</p>
        </div>
      </div>

      <div class="col-md-4 d-flex justify-content-center">
        <div class="fitur-card">
          <img src="{{ asset('img/5.png') }}" class="fitur-img">
          <h4>Kuis & Evaluasi</h4>
          <p>Kuis dan evaluasi tersedia untuk mengukur pemahaman siswa.</p>
        </div>
      </div>

      <div class="col-md-4 d-flex justify-content-center">
        <div class="fitur-card">
          <img src="{{ asset('img/6.png') }}" class="fitur-img">
          <h4>Dashboard Guru</h4>
          <p>Guru dapat memonitor perkembangan dan hasil pekerjaan siswa.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<footer>
  © 2026 Polimathica. Olyvia Ika Albina
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
