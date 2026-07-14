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

  @php
    $currentUrl = rtrim(url()->current(), '/');

    $berandaUrl = rtrim(route('landingpage'), '/');
    $daftarMateriUrl = rtrim(route('daftarmateri'), '/');
    $petunjukUrl = rtrim(route('petunjukpenggunaan'), '/');
    $tentangUrl = rtrim(route('tentang'), '/');
    $guruUrl = rtrim(route('halamanguru'), '/');
    $daftarUrl = rtrim(route('registersiswa'), '/');
    $masukUrl = rtrim(route('masuksiswa'), '/');

    $isBeranda = $currentUrl === $berandaUrl;
    $isDaftarMateri = $currentUrl === $daftarMateriUrl || request()->routeIs('materi.*');
    $isPetunjuk = $currentUrl === $petunjukUrl;
    $isTentang = $currentUrl === $tentangUrl;
    $isGuru = $currentUrl === $guruUrl || request()->routeIs('guru.*');
    $isDaftar = $currentUrl === $daftarUrl;
    $isMasuk = $currentUrl === $masukUrl;
  @endphp

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

    .navbar {
      background-color: #ffffff !important;
      border-bottom: 1px solid #e2d7c9;
      padding: 0.75rem 1.25rem;
    }

    .brand {
      display: inline-flex !important;
      align-items: center !important;
      gap: 12px;
      text-decoration: none;
    }

    .brand img {
      width: 44px;
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
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 3px;
      color: #85977B;
    }

    .nav-link {
      font-size: 0.95rem;
      color: var(--text-main) !important;
      padding: 0.45rem 0.9rem !important;
      border-radius: 22px;
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      background-color: #f6f1e6;
      color: #6f815f !important;
    }

    /* HIGHLIGHT MENU AKTIF */
    .nav-link.active-page {
      background-color: #D0DDD0 !important;
      color: #4f6f42 !important;
      font-weight: 600 !important;
      box-shadow: 0 4px 12px rgba(133, 151, 123, 0.25);
    }

    .btn-nav {
      font-size: 0.85rem;
      border-radius: 22px;
      border: 1px solid #d7c1aa;
      padding: 0.45rem 1.4rem;
      background-color: var(--page-bg);
      color: var(--text-main);
      transition: all 0.2s ease;
    }

    .btn-nav:hover {
      background-color: #f1eadc;
      border-color: #c8aa8c;
    }

    .btn-nav.active-page {
      background-color: #D0DDD0 !important;
      border-color: #85977B !important;
      color: #4f6f42 !important;
      font-weight: 600 !important;
      box-shadow: 0 4px 12px rgba(133, 151, 123, 0.25);
    }

    footer {
      font-size: 0.75rem;
      color: #8f8375;
      text-align: center;
      padding: 10px 0;
      background-color: #ffffff;
      border-top: 1px solid #e2d7c9;
    }

    @media (max-width: 991px) {
      .navbar-nav {
        margin-top: 15px;
        gap: 6px !important;
      }

      .nav-link {
        padding: 0.6rem 1rem !important;
      }

      .d-flex.gap-2.ms-3 {
        margin-left: 0 !important;
        margin-top: 12px;
      }
    }
  </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container-fluid">

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
          <a class="nav-link {{ $isBeranda ? 'active-page' : '' }}"
             href="{{ route('landingpage') }}">
            Beranda
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ $isDaftarMateri ? 'active-page' : '' }}"
             href="{{ route('daftarmateri') }}">
            Daftar Materi
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ $isPetunjuk ? 'active-page' : '' }}"
             href="{{ route('petunjukpenggunaan') }}">
            Petunjuk Penggunaan
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ $isTentang ? 'active-page' : '' }}"
             href="{{ route('tentang') }}">
            Tentang
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ $isGuru ? 'active-page' : '' }}"
             href="{{ route('halamanguru') }}">
            Halaman Guru
          </a>
        </li>

      </ul>

      <div class="d-flex gap-2 ms-3">
        <a href="{{ route('registersiswa') }}"
           class="btn btn-nav {{ $isDaftar ? 'active-page' : '' }}">
          Daftar
        </a>

        <a href="{{ route('masuksiswa') }}"
           class="btn btn-nav {{ $isMasuk ? 'active-page' : '' }}">
          Masuk
        </a>
      </div>
    </div>

  </div>
</nav>

<main>
  @yield('content')
</main>

<footer>
  © 2026 Polimathica. Olyvia Ika Albina
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>