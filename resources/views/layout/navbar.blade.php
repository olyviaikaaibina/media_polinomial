<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Polymathica')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --page-bg: #FDFDE8;
      --text-main: #4f4a3f;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: var(--page-bg);
      color: var(--text-main);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    /* ===== NAVBAR (SEDIKIT LEBIH BESAR) ===== */
    .navbar {
      background-color: #ffffff !important;
      border-bottom: 1px solid #e2d7c9;
      padding: 0.75rem 1.25rem; /* ⬅️ NAIK DARI SEBELUMNYA */
    }

    /* ===== LOGO HORIZONTAL ===== */
    .brand {
      display: inline-flex !important;
      align-items: center !important;
      gap: 12px; /* jarak logo & teks sedikit lebih lega */
      text-decoration: none;
    }

    .brand img {
      width: 44px;              /* ⬅️ logo lebih besar */
      height: auto;
      display: inline-block !important;
      margin: 0 !important;
    }

    .brand span {
      display: inline-block !important;
      white-space: nowrap !important;
      line-height: 1.1 !important;
      margin: 0 !important;

      font-family: "Playfair Display", serif;
      font-size: 14px;          /* ⬅️ teks lebih besar */
      font-weight: 700;
      letter-spacing: 3px;
      color: #85977B;
    }

    /* NAV LINK */
    .nav-link {
      font-size: 0.95rem;       /* ⬅️ sedikit lebih besar */
      color: var(--text-main) !important;
    }

    /* BUTTON */
    .btn-nav {
      font-size: 0.85rem;       /* ⬅️ naik dikit */
      border-radius: 22px;
      border: 1px solid #d7c1aa;
      padding: 0.45rem 1.4rem;
      background-color: var(--page-bg);
    }

    .btn-nav:hover {
      background-color: #f1eadc;
    }

    /* FOOTER */
    footer {
      font-size: 0.75rem;
      color: #8f8375;
      text-align: center;
      padding: 10px 0;
      background-color: #ffffff;
      border-top: 1px solid #e2d7c9;
    }
  </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container-fluid">

    <!-- LOGO -->
    <a href="{{ route('landingpage') }}" class="brand me-4">
      <img src="{{ asset('img/2.png') }}" alt="Logo Polimathica">
      <span>POLIMATHICA</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto gap-lg-3">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('landingpage') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('daftarmateri') }}">Daftar Materi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('petunjukpenggunaan') }}">Petunjuk Penggunaan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('tentang') }}">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('halamanguru') }}">Halaman Guru</a>
        </li>
      </ul>

      <div class="d-flex gap-2 ms-3">
        <a href="{{ route('registersiswa') }}" class="btn btn-nav">Daftar</a>
        <a href="{{ route('masuksiswa') }}" class="btn btn-nav">Masuk</a>
      </div>
    </div>

  </div>
</nav>

<!-- CONTENT -->
<main>
  @yield('content')
</main>

<!-- FOOTER -->
<footer>
  © 2026 Polimathica. Olyvia Ika Albina
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
