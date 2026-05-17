<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Polimathica</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root {
      --green-soft: #AAB99A;
      --cream-box: #F3E0C5;
      --cream-bg: #FFFDE6;
      --text-main: #4F4A3F;
      --sage-dark: #8F9F76;
      --sage-line: rgba(79, 74, 63, 0.12);
      --sidebar-width: 280px;
      --navbar-height: 80px;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      width: 100%;
      min-height: 100%;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: var(--cream-bg);
      color: var(--text-main);
      padding-top: var(--navbar-height);
      overflow: hidden;
    }

    img {
      max-width: 100%;
      height: auto;
    }

    .navbar-polymathica {
      border-bottom: 1px solid var(--sage-line);
      background: #ffffff;
      min-height: var(--navbar-height);
      z-index: 1300;
    }

    .navbar-polymathica .container-fluid {
      min-height: calc(var(--navbar-height) - 1px);
      gap: 10px;
    }

    .brand-inline {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      line-height: 1;
      max-width: 100%;
    }

    .brand-inline .logo-img {
      height: 38px;
      width: auto;
      display: block;
      margin: 0;
      flex-shrink: 0;
    }

    .brand-inline .logo-word {
      font-family: "Playfair Display", serif;
      font-size: 1rem;
      font-weight: 700;
      letter-spacing: 2px;
      color: var(--sage-dark);
      margin: 0;
      white-space: nowrap;
    }

    .navbar-polymathica .nav-link {
      color: #4F4A3F;
      font-weight: 600;
      opacity: 1;
    }

    .navbar-polymathica .nav-link:hover,
    .navbar-polymathica .nav-link.active {
      color: var(--sage-dark);
    }

    .navbar-polymathica .logout-form {
      display: flex;
      align-items: center;
      margin: 0;
    }

    .navbar-polymathica .btn-logout {
      background-color: #dc3545;
      color: #ffffff !important;
      font-weight: 600;
      border: none;
      border-radius: 999px;
      padding: 8px 18px;
      line-height: 1.2;
      text-decoration: none;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .navbar-polymathica .btn-logout:hover {
      background-color: #bb2d3b;
      color: #ffffff !important;
    }

    .layout-wrapper {
      height: calc(100vh - var(--navbar-height));
      overflow: hidden;
      position: relative;
    }

    .sidebar {
      width: var(--sidebar-width);
      background: #AAB99A;
      padding: 1.6rem 1.2rem 1.2rem 1.2rem;
      overflow-y: auto;
      position: fixed;
      top: var(--navbar-height);
      left: 0;
      height: calc(100vh - var(--navbar-height));
      z-index: 1200;
      transition: transform 0.25s ease;
      will-change: transform;
      scrollbar-width: thin;
    }

    body.sidebar-collapsed .sidebar {
      transform: translateX(calc(-1 * var(--sidebar-width)));
    }

    .btn-sidebar-toggle {
      border: 1px solid rgba(255, 255, 255, 0.65);
      background: rgba(255, 255, 255, 0.88);
      border-radius: 12px;
      padding: 8px 10px;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 18px;
      font-weight: 800;
      color: var(--text-main);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
    }

    .btn-sidebar-toggle:hover {
      background: #ffffff;
    }

    .sidebar-menu-item {
      width: 100%;
      padding: 10px 14px;
      background: var(--cream-box);
      border-radius: 10px;
      border: 1px solid rgba(79, 74, 63, 0.10);
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 12px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 10px;
      line-height: 1.3;
      cursor: pointer;
      text-align: left;
      color: var(--text-main);
    }

    .sidebar-menu-item:hover,
    .sidebar-menu-item.active {
      background: rgba(243, 224, 197, 0.72);
      border-color: rgba(79, 74, 63, 0.14);
    }

    .dropdown-arrow {
      font-size: 1.1rem;
      font-weight: 800;
      transition: transform 0.2s ease;
      color: var(--text-main);
      opacity: 0.85;
      flex-shrink: 0;
    }

    .dropdown-toggle-btn.open .dropdown-arrow {
      transform: rotate(180deg);
    }

    .dropdown-group {
      margin-bottom: 14px;
    }

    .dropdown-content {
      display: none;
      margin-left: 10px;
      margin-top: 8px;
      padding-left: 16px;
      padding-top: 2px;
      position: relative;
      width: calc(100% - 10px);
    }

    .dropdown-content::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 4px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.55);
      pointer-events: none;
    }

    .dropdown-item {
      background: rgba(255, 255, 255, 0.35);
      padding: 8px 10px;
      border-radius: 10px;
      display: block;
      margin-bottom: 6px;
      font-size: 0.8rem;
      text-decoration: none;
      color: var(--text-main);
      white-space: normal;
      word-break: break-word;
      line-height: 1.4;
      border: 1px solid rgba(79, 74, 63, 0.10);
      backdrop-filter: blur(2px);
    }

    .dropdown-item:hover {
      background: rgba(255, 255, 255, 0.55);
      border-color: rgba(79, 74, 63, 0.14);
    }

    .dropdown-item.active {
      background: var(--cream-box);
      border-color: rgba(79, 74, 63, 0.28);
      color: var(--text-main);
      font-weight: 800;
      border-left: 6px solid var(--sage-dark);
      padding-left: 14px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.10);
    }

    .dropdown-item.locked {
      opacity: .7;
      cursor: not-allowed;
      color: var(--text-main);
    }

    .dropdown-item.locked:hover {
      background: rgba(255, 255, 255, 0.35);
    }

    .main-content {
      margin-left: var(--sidebar-width);
      height: calc(100vh - var(--navbar-height));
      padding: 1.25rem;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: margin-left 0.25s ease;
    }

    body.sidebar-collapsed .main-content {
      margin-left: 0;
    }

    .main-inner {
      background: #ffffff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 0 1px rgba(79, 74, 63, 0.10);
      flex: 1;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      min-height: 0;
    }

    .content-scroll {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      min-height: 0;
      padding-right: 4px;
    }

    .content-navigation {
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid var(--sage-line);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn-nav {
      background: #8F9F76;
      color: #ffffff;
      font-size: 0.85rem;
      font-weight: 600;
      padding: 9px 18px;
      border-radius: 999px;
      text-decoration: none;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(79, 74, 63, 0.10);
      min-width: 110px;
      text-align: center;
    }

    .btn-nav:hover {
      background: var(--sage-dark);
      color: #ffffff;
    }

    .btn-nav.disabled {
      opacity: 0.55;
      pointer-events: none;
    }

    .sidebar-handle {
      position: fixed;
      left: 18px;
      top: calc(var(--navbar-height) + 18px);
      z-index: 1250;
      display: none;
    }

    body.sidebar-collapsed .sidebar-handle {
      display: block;
    }

    .sidebar-handle button {
      height: 48px;
      width: 48px;
      border-radius: 14px;
      background: #ffffff;
      color: var(--text-main);
      border: 2px solid var(--green-soft);
      font-size: 22px;
      font-weight: 800;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.18);
      cursor: pointer;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar-handle button:hover {
      background: rgba(255, 255, 255, 0.95);
      transform: translateX(3px);
    }

    .sidebar-overlay {
      display: none;
    }

    /* =========================
       INPUT MATEMATIKA BERPANGKAT
       Contoh:
       7^3          -> 7³
       7x3          -> 7x³
       x2           -> x²
       3x2          -> 3x²
       ab2          -> ab²
       xyz3         -> xyz³
       x^(n+1)      -> xⁿ⁺¹
       x{n+1}       -> xⁿ⁺¹
       (x+1)^2      -> (x+1)²
       (x+1)x2      -> (x+1)²
    ========================== */

    input[type="text"] {
      font-family: "Times New Roman", "Cambria Math", "STIX Two Text", "Latin Modern Roman", serif;
      font-style: normal;
      font-size: 18px;
    }

    .math-power-input {
      font-family: "Times New Roman", "Cambria Math", "STIX Two Text", "Latin Modern Roman", serif !important;
      font-style: normal;
      font-size: 18px;
    }

    @media (max-width: 1199.98px) {
      :root {
        --sidebar-width: 260px;
      }

      .main-content {
        padding: 1rem;
      }

      .main-inner {
        padding: 1.5rem;
      }

      .sidebar {
        padding: 1.4rem 1rem 1rem;
      }

      .navbar-polymathica .navbar-nav {
        gap: 1rem !important;
      }

      .navbar-polymathica .nav-link {
        font-size: 0.92rem;
      }
    }

    @media (max-width: 991.98px) {
      :root {
        --navbar-height: 74px;
        --sidebar-width: 290px;
      }

      body {
        overflow: auto;
        padding-top: var(--navbar-height);
      }

      .navbar-polymathica {
        min-height: var(--navbar-height);
      }

      .navbar-polymathica .container-fluid {
        min-height: calc(var(--navbar-height) - 1px);
      }

      .navbar-collapse {
        background: #ffffff;
        margin-top: 12px;
        border: 1px solid var(--sage-line);
        border-radius: 16px;
        padding: 14px;
        box-shadow: 0 12px 26px rgba(0, 0, 0, 0.10);
      }

      .navbar-polymathica .navbar-nav {
        gap: 0.35rem !important;
      }

      .navbar-polymathica .nav-link {
        padding: 10px 12px;
        border-radius: 10px;
      }

      .navbar-polymathica .nav-link:hover,
      .navbar-polymathica .nav-link.active {
        background: rgba(170, 185, 154, 0.18);
      }

      .navbar-polymathica .logout-form {
        width: 100%;
        padding-top: 6px;
      }

      .navbar-polymathica .btn-logout {
        width: 100%;
        padding: 10px 18px;
      }

      .layout-wrapper {
        height: auto;
        min-height: calc(100vh - var(--navbar-height));
        overflow: visible;
      }

      .sidebar {
        transform: translateX(calc(-1 * var(--sidebar-width)));
        width: var(--sidebar-width);
        max-width: 86vw;
        height: calc(100vh - var(--navbar-height));
        z-index: 1200;
        box-shadow: 14px 0 28px rgba(0, 0, 0, 0.18);
      }

      body.sidebar-open .sidebar {
        transform: translateX(0);
      }

      body.sidebar-open .sidebar-handle {
        display: none;
      }

      body.sidebar-collapsed .sidebar {
        transform: translateX(calc(-1 * var(--sidebar-width)));
      }

      .main-content {
        margin-left: 0 !important;
        height: auto;
        min-height: calc(100vh - var(--navbar-height));
        padding: 1rem;
        overflow: visible;
      }

      .main-inner {
        min-height: calc(100vh - var(--navbar-height) - 100px);
        padding: 1.4rem;
        overflow: visible;
      }

      .content-scroll {
        overflow: visible;
        padding-right: 0;
      }

      .sidebar-handle {
        display: block;
        left: 16px;
        top: calc(var(--navbar-height) + 16px);
      }

      .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.28);
        z-index: 1150;
      }

      body.sidebar-open .sidebar-overlay {
        display: block;
      }

      .content-navigation {
        position: sticky;
        bottom: 0;
        background: var(--cream-bg);
        border-top: 1px solid var(--sage-line);
        padding: 12px 0 0;
        z-index: 10;
      }
    }

    @media (max-width: 767.98px) {
      :root {
        --navbar-height: 70px;
        --sidebar-width: 280px;
      }

      .navbar-polymathica {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
      }

      .brand-inline {
        gap: 9px;
      }

      .brand-inline .logo-img {
        height: 34px;
      }

      .brand-inline .logo-word {
        font-size: 0.9rem;
        letter-spacing: 1.5px;
      }

      .navbar-toggler {
        padding: 6px 9px;
        border-radius: 10px;
      }

      .main-content {
        padding: 0.75rem;
      }

      .main-inner {
        padding: 1rem;
        border-radius: 14px;
        min-height: calc(100vh - var(--navbar-height) - 92px);
      }

      .sidebar {
        padding: 1.2rem 0.9rem 1rem;
        max-width: 88vw;
      }

      .btn-sidebar-toggle {
        font-size: 17px;
        padding: 8px 10px;
      }

      .sidebar-menu-item {
        font-size: 0.82rem;
        padding: 10px 12px;
      }

      .dropdown-content {
        margin-left: 6px;
        padding-left: 12px;
        width: calc(100% - 6px);
      }

      .dropdown-item {
        font-size: 0.78rem;
        padding: 8px 9px;
      }

      .sidebar-handle {
        left: 14px;
        top: calc(var(--navbar-height) + 14px);
      }

      .sidebar-handle button {
        height: 46px;
        width: 46px;
        border-radius: 14px;
        font-size: 21px;
      }

      .content-navigation {
        gap: 10px;
      }

      .btn-nav {
        flex: 1 1 0;
        min-width: 0;
        padding: 9px 12px;
        font-size: 0.82rem;
      }

      input[type="text"],
      .math-power-input {
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      :root {
        --navbar-height: 66px;
        --sidebar-width: 270px;
      }

      .brand-inline .logo-img {
        height: 30px;
      }

      .brand-inline .logo-word {
        font-size: 0.78rem;
        letter-spacing: 1.2px;
      }

      .navbar-collapse {
        margin-top: 10px;
        padding: 12px;
        border-radius: 14px;
      }

      .navbar-polymathica .nav-link {
        font-size: 0.86rem;
        padding: 9px 10px;
      }

      .main-content {
        padding: 0.55rem;
      }

      .main-inner {
        padding: 0.85rem;
        border-radius: 12px;
      }

      .sidebar {
        max-width: 90vw;
        padding: 1rem 0.75rem;
      }

      .sidebar-menu-item {
        font-size: 0.78rem;
        padding: 9px 10px;
        border-radius: 9px;
      }

      .dropdown-item {
        font-size: 0.75rem;
        border-radius: 9px;
      }

      .sidebar-handle {
        left: 12px;
        top: calc(var(--navbar-height) + 12px);
      }

      .sidebar-handle button {
        height: 44px;
        width: 44px;
        border-radius: 13px;
        font-size: 20px;
      }

      .content-navigation {
        flex-direction: column;
        align-items: stretch;
      }

      .btn-nav {
        width: 100%;
        flex: none;
      }

      input[type="text"],
      .math-power-input {
        font-size: 15px;
      }
    }

    @media (max-width: 390px) {
      .brand-inline .logo-word {
        display: none;
      }

      .brand-inline .logo-img {
        height: 32px;
      }

      .main-inner {
        padding: 0.75rem;
      }

      .sidebar {
        max-width: 92vw;
      }
    }
  </style>
</head>

<body>

  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <div class="sidebar-handle">
    <button type="button" id="openSidebarHandle" aria-label="Buka Sidebar">☰</button>
  </div>

  <nav class="navbar navbar-expand-lg navbar-polymathica px-4 fixed-top">
    <div class="container-fluid">

      <a href="{{ route('landingpage') }}" class="brand-inline">
        <img src="{{ asset('img/2.png') }}" alt="Logo Polimathica" class="logo-img">
        <span class="logo-word">POLIMATHICA</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar"
        aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="topNavbar">
        <ul class="navbar-nav gap-4">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('landingpage') ? 'active' : '' }}"
              href="{{ route('landingpage') }}">
              Beranda
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('petunjukpenggunaan') ? 'active' : '' }}"
              href="{{ route('petunjukpenggunaan') }}">
              Petunjuk Penggunaan
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('progressbelajar') ? 'active' : '' }}"
              href="{{ route('progressbelajar') }}">
              Progres Belajar
            </a>
          </li>

          <li class="nav-item d-flex align-items-center">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
              @csrf
              <button type="submit" class="btn-logout">
                Logout
              </button>
            </form>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  <div class="layout-wrapper">

    <aside class="sidebar" id="sidebar">

      <div class="d-flex justify-content-start mb-3">
        <button class="btn-sidebar-toggle" type="button" id="toggleSidebar" aria-label="Toggle Sidebar">☰</button>
      </div>

      {{-- PENGANTAR --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Pengantar</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        @php
          $currentSlug = request()->route('slug');
          $currentQuizId = request()->route('id');

          $unlockedSlugs = $unlockedSlugs ?? ['pengertianpolinomial'];

          $materiActive = function ($slug) {
            return request()->routeIs('materi.show') && request()->route('slug') === $slug ? 'active' : '';
          };

          $quizActive = function ($id) {
            return request()->routeIs('quiz.show') && (string) request()->route('id') === (string) $id ? 'active' : '';
          };

          $isMateriUnlocked = function ($slug) use ($unlockedSlugs) {
            return in_array($slug, $unlockedSlugs);
          };

          $isQuizAUnlocked = $canAccessQuizByBab[1] ?? false;
          $isQuizBUnlocked = $canAccessQuizByBab[2] ?? false;
          $isQuizCUnlocked = $canAccessQuizByBab[3] ?? false;
          $isQuizDUnlocked = $canAccessQuizByBab[4] ?? false;
          $isQuizEUnlocked = $canAccessQuizByBab[5] ?? false;

          $studentId = auth('siswa')->id();

          $sudahLulusKuisE = \App\Models\QuizAttempt::where('student_id', $studentId)
            ->where('quiz_id', 5)
            ->where('is_passed', 1)
            ->exists();

          $isEvaluasiUnlocked = $sudahLulusKuisE;
        @endphp

        <div class="dropdown-content">
          <a href="{{ route('petakonsep') }}"
            class="dropdown-item {{ request()->routeIs('petakonsep') ? 'active' : '' }}">
            Peta Konsep
          </a>

          <a href="{{ route('pendahuluan') }}"
            class="dropdown-item {{ request()->routeIs('pendahuluan') ? 'active' : '' }}">
            Apersepsi
          </a>
        </div>
      </div>

      {{-- BAB 1 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Polinomial & Fungsi Polinomial</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          <a href="{{ route('materi.show', ['slug' => 'pengertianpolinomial']) }}"
            class="dropdown-item {{ $materiActive('pengertianpolinomial') }}">
            Pengertian Polinomial
          </a>

          @if ($isMateriUnlocked('derajatsuatupolinomial'))
            <a href="{{ route('materi.show', ['slug' => 'derajatsuatupolinomial']) }}"
              class="dropdown-item {{ $materiActive('derajatsuatupolinomial') }}">
              Derajat Suatu Polinomial
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Derajat Suatu Polinomial</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isMateriUnlocked('fungsipolinomialdangrafiknya'))
            <a href="{{ route('materi.show', ['slug' => 'fungsipolinomialdangrafiknya']) }}"
              class="dropdown-item {{ $materiActive('fungsipolinomialdangrafiknya') }}">
              Fungsi Polinomial dan Grafiknya
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Fungsi Polinomial dan Grafiknya</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isQuizAUnlocked)
            <a href="{{ route('quiz.show', ['id' => 1]) }}" class="dropdown-item {{ $quizActive(1) }}">
              Kuis A
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Kuis A</span>
              <span>🔒</span>
            </div>
          @endif
        </div>
      </div>

      {{-- BAB 2 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Penjumlahan, Pengurangan dan Perkalian</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          @if ($isMateriUnlocked('penjumlahanpolinomial'))
            <a href="{{ route('materi.show', ['slug' => 'penjumlahanpolinomial']) }}"
              class="dropdown-item {{ $materiActive('penjumlahanpolinomial') }}">
              Penjumlahan Polinomial
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Penjumlahan Polinomial</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isMateriUnlocked('penguranganpolinomial'))
            <a href="{{ route('materi.show', ['slug' => 'penguranganpolinomial']) }}"
              class="dropdown-item {{ $materiActive('penguranganpolinomial') }}">
              Pengurangan Polinomial
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Pengurangan Polinomial</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isMateriUnlocked('perkalianpolinomial'))
            <a href="{{ route('materi.show', ['slug' => 'perkalianpolinomial']) }}"
              class="dropdown-item {{ $materiActive('perkalianpolinomial') }}">
              Perkalian Polinomial
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Perkalian Polinomial</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isQuizBUnlocked)
            <a href="{{ route('quiz.show', ['id' => 2]) }}" class="dropdown-item {{ $quizActive(2) }}">
              Kuis B
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Kuis B</span>
              <span>🔒</span>
            </div>
          @endif
        </div>
      </div>

      {{-- BAB 3 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Pembagian Polinomial</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          @if ($isMateriUnlocked('pembagianbersusun'))
            <a href="{{ route('materi.show', ['slug' => 'pembagianbersusun']) }}"
              class="dropdown-item {{ $materiActive('pembagianbersusun') }}">
              Pembagian Bersusun
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Pembagian Bersusun</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isMateriUnlocked('metodehorner'))
            <a href="{{ route('materi.show', ['slug' => 'metodehorner']) }}"
              class="dropdown-item {{ $materiActive('metodehorner') }}">
              Metode Horner
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Metode Horner</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isMateriUnlocked('teoremasisa'))
            <a href="{{ route('materi.show', ['slug' => 'teoremasisa']) }}"
              class="dropdown-item {{ $materiActive('teoremasisa') }}">
              Teorema Sisa
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Teorema Sisa</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isQuizCUnlocked)
            <a href="{{ route('quiz.show', ['id' => 3]) }}" class="dropdown-item {{ $quizActive(3) }}">
              Kuis C
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Kuis C</span>
              <span>🔒</span>
            </div>
          @endif
        </div>
      </div>

      {{-- BAB 4 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Faktor & Pembuat Nol</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          @if ($isMateriUnlocked('teoremafaktor'))
            <a href="{{ route('materi.show', ['slug' => 'teoremafaktor']) }}"
              class="dropdown-item {{ $materiActive('teoremafaktor') }}">
              Teorema Faktor
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Teorema Faktor</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isMateriUnlocked('faktordanpembuatnol'))
            <a href="{{ route('materi.show', ['slug' => 'faktordanpembuatnol']) }}"
              class="dropdown-item {{ $materiActive('faktordanpembuatnol') }}">
              Faktor dan Pembuat Nol
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Faktor dan Pembuat Nol</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isQuizDUnlocked)
            <a href="{{ route('quiz.show', ['id' => 4]) }}" class="dropdown-item {{ $quizActive(4) }}">
              Kuis D
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Kuis D</span>
              <span>🔒</span>
            </div>
          @endif
        </div>
      </div>

      {{-- BAB 5 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Identitas Polinomial</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          @if ($isMateriUnlocked('identitaspolinomial'))
            <a href="{{ route('materi.show', ['slug' => 'identitaspolinomial']) }}"
              class="dropdown-item {{ $materiActive('identitaspolinomial') }}">
              Identitas Polinomial
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Identitas Polinomial</span>
              <span>🔒</span>
            </div>
          @endif

          @if ($isQuizEUnlocked)
            <a href="{{ route('quiz.show', ['id' => 5]) }}" class="dropdown-item {{ $quizActive(5) }}">
              Kuis E
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Kuis E</span>
              <span>🔒</span>
            </div>
          @endif
        </div>
      </div>

      {{-- EVALUASI --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Evaluasi</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          @if ($isEvaluasiUnlocked)
            <a href="{{ route('quiz.show', ['id' => 6]) }}" class="dropdown-item {{ $quizActive(6) }}">
              Evaluasi
            </a>
          @else
            <div class="dropdown-item locked d-flex justify-content-between align-items-center">
              <span>Evaluasi</span>
              <span>🔒</span>
            </div>
          @endif
        </div>
      </div>
    </aside>

    <main class="main-content">
      <div class="main-inner">
        <div class="content-scroll">
          @yield('content')
        </div>
      </div>

      <div class="content-navigation">
        @yield('nav')
      </div>
    </main>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/p5@1.9.0/lib/p5.min.js"></script>

  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const handleBtn = document.getElementById('openSidebarHandle');

    function isMobile() {
      return window.matchMedia('(max-width: 991.98px)').matches;
    }

    function closeSidebarMobile() {
      document.body.classList.remove('sidebar-open');
    }

    function openSidebarMobile() {
      document.body.classList.add('sidebar-open');
    }

    function toggleSidebar() {
      if (isMobile()) {
        document.body.classList.toggle('sidebar-open');
      } else {
        document.body.classList.toggle('sidebar-collapsed');
      }
    }

    if (toggleBtn) {
      toggleBtn.addEventListener('click', toggleSidebar);
    }

    if (handleBtn) {
      handleBtn.addEventListener('click', function () {
        if (isMobile()) {
          openSidebarMobile();
        } else {
          document.body.classList.remove('sidebar-collapsed');
        }
      });
    }

    if (overlay) {
      overlay.addEventListener('click', closeSidebarMobile);
    }

    window.addEventListener('resize', function () {
      if (!isMobile()) {
        closeSidebarMobile();
      }
    });

    const groups = document.querySelectorAll(".dropdown-group");

    function closeAllDropdowns(exceptGroup = null) {
      groups.forEach(function (g) {
        if (exceptGroup && g === exceptGroup) return;

        g.classList.remove("is-open");

        const btn = g.querySelector(".dropdown-toggle-btn");
        const content = g.querySelector(".dropdown-content");

        if (btn) btn.classList.remove("open");
        if (content) content.style.display = "none";
      });
    }

    groups.forEach(function (group) {
      const btn = group.querySelector(".dropdown-toggle-btn");
      const content = group.querySelector(".dropdown-content");

      if (!btn || !content) return;

      btn.addEventListener("click", function () {
        const isOpen = group.classList.contains("is-open");

        if (isOpen) {
          group.classList.remove("is-open");
          btn.classList.remove("open");
          content.style.display = "none";
        } else {
          closeAllDropdowns(group);
          group.classList.add("is-open");
          btn.classList.add("open");
          content.style.display = "block";
        }
      });
    });

    (function openActiveDropdown() {
      let opened = false;

      groups.forEach(function (group) {
        const activeLink = group.querySelector(".dropdown-item.active");

        if (activeLink && !opened) {
          closeAllDropdowns(group);

          const btn = group.querySelector(".dropdown-toggle-btn");
          const content = group.querySelector(".dropdown-content");

          group.classList.add("is-open");

          if (btn) btn.classList.add("open");
          if (content) content.style.display = "block";

          opened = true;
        }
      });
    })();

    document.querySelectorAll(".sidebar .dropdown-item:not(.locked)").forEach(function (item) {
      item.addEventListener("click", function () {
        if (isMobile()) {
          closeSidebarMobile();
        }
      });
    });
  </script>

  <script>
    /*
      FITUR INPUT PANGKAT OTOMATIS
  
      Contoh hasil:
      7x3          -> 7x³
      7x3y2z7      -> 7x³y²z⁷
      12a4b3c2     -> 12a⁴b³c²
      x2           -> x²
      xy2          -> xy²
      3x2-5y7      -> 3x²-5y⁷
      x^7          -> x⁷
      x^10         -> x¹⁰
      x^(n+1)      -> xⁿ⁺¹
      x^{n+1}      -> xⁿ⁺¹
      (x+1)^2      -> (x+1)²
      (x+1)x2      -> (x+1)²
    */

    function toSuperscript(text) {
      const supMap = {
        '0': '⁰',
        '1': '¹',
        '2': '²',
        '3': '³',
        '4': '⁴',
        '5': '⁵',
        '6': '⁶',
        '7': '⁷',
        '8': '⁸',
        '9': '⁹',

        '+': '⁺',
        '-': '⁻',
        '=': '⁼',
        '(': '⁽',
        ')': '⁾',

        'a': 'ᵃ',
        'b': 'ᵇ',
        'c': 'ᶜ',
        'd': 'ᵈ',
        'e': 'ᵉ',
        'f': 'ᶠ',
        'g': 'ᵍ',
        'h': 'ʰ',
        'i': 'ⁱ',
        'j': 'ʲ',
        'k': 'ᵏ',
        'l': 'ˡ',
        'm': 'ᵐ',
        'n': 'ⁿ',
        'o': 'ᵒ',
        'p': 'ᵖ',
        'q': 'ᑫ',
        'r': 'ʳ',
        's': 'ˢ',
        't': 'ᵗ',
        'u': 'ᵘ',
        'v': 'ᵛ',
        'w': 'ʷ',
        'x': 'ˣ',
        'y': 'ʸ',
        'z': 'ᶻ',

        'A': 'ᴬ',
        'B': 'ᴮ',
        'C': 'ᶜ',
        'D': 'ᴰ',
        'E': 'ᴱ',
        'F': 'ᶠ',
        'G': 'ᴳ',
        'H': 'ᴴ',
        'I': 'ᴵ',
        'J': 'ᴶ',
        'K': 'ᴷ',
        'L': 'ᴸ',
        'M': 'ᴹ',
        'N': 'ᴺ',
        'O': 'ᴼ',
        'P': 'ᴾ',
        'Q': 'ᑫ',
        'R': 'ᴿ',
        'S': 'ˢ',
        'T': 'ᵀ',
        'U': 'ᵁ',
        'V': 'ⱽ',
        'W': 'ᵂ',
        'X': 'ˣ',
        'Y': 'ʸ',
        'Z': 'ᶻ'
      };

      return String(text)
        .split('')
        .map(function (char) {
          return supMap[char] || char;
        })
        .join('');
    }

    function normalizeExponentText(exponent) {
      if (!exponent) return '';

      let result = String(exponent).trim();

      if (
        (result.startsWith('{') && result.endsWith('}')) ||
        (result.startsWith('(') && result.endsWith(')'))
      ) {
        result = result.slice(1, -1);
      }

      return result.trim();
    }

    function convertCaretPower(text) {
      let value = String(text);

      // x^{n+1}
      value = value.replace(/\^\{([^{}]+)\}/g, function (match, exponent) {
        return toSuperscript(normalizeExponentText(exponent));
      });

      // x^(n+1)
      value = value.replace(/\^\(([^()]+)\)/g, function (match, exponent) {
        return toSuperscript(normalizeExponentText(exponent));
      });

      // x^3, x^-2, x^10, x^n, x^n+1
      value = value.replace(/\^([+-]?[a-zA-Z0-9]+(?:[+\-][a-zA-Z0-9]+)?)/g, function (match, exponent) {
        return toSuperscript(normalizeExponentText(exponent));
      });

      return value;
    }

    function convertParenthesesPower(text) {
      let value = String(text);

      // (x+1)^2
      value = value.replace(/(\([^()]+\))\^\{([^{}]+)\}/g, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      value = value.replace(/(\([^()]+\))\^\(([^()]+)\)/g, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      value = value.replace(/(\([^()]+\))\^([+-]?\d+|[a-zA-Z])/g, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      // (x+1)x2
      value = value.replace(/(\([^()]+\))x\{([^{}]+)\}/gi, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      value = value.replace(/(\([^()]+\))x\(([^()]+)\)/gi, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      value = value.replace(/(\([^()]+\))x([+-]?\d+|[a-zA-Z])/gi, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      return value;
    }

    function convertBracketVariablePower(text) {
      let value = String(text);

      // x{2}, y{7}, a{n+1}
      value = value.replace(/([a-zA-Z])\{([^{}]+)\}/g, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      // x(2), y(7), a(n+1)
      value = value.replace(/([a-zA-Z])\(([^()]+)\)/g, function (match, base, exponent) {
        return base + toSuperscript(normalizeExponentText(exponent));
      });

      return value;
    }

    function convertChainedVariablePower(text) {
      let value = String(text);
      let result = '';

      for (let i = 0; i < value.length; i++) {
        const current = value[i];
        const next = value[i + 1];

        /*
          Kalau huruf diikuti angka, angka itu dijadikan pangkat huruf tersebut.
  
          7x3       -> 7x³
          7x3y2z7   -> 7x³y²z⁷
          12a4b3c2  -> 12a⁴b³c²
        */
        if (/[a-zA-Z]/.test(current) && /[0-9]/.test(next || '')) {
          let exponent = '';
          let j = i + 1;

          while (j < value.length && /[0-9]/.test(value[j])) {
            exponent += value[j];
            j++;
          }

          result += current + toSuperscript(exponent);
          i = j - 1;
          continue;
        }

        result += current;
      }

      return result;
    }

    function convertPowerInput(value) {
      if (!value) return value;

      let text = String(value);

      text = convertCaretPower(text);
      text = convertParenthesesPower(text);
      text = convertBracketVariablePower(text);
      text = convertChainedVariablePower(text);

      return text;
    }

    function setCursorToEnd(input) {
      const length = input.value.length;

      input.focus();

      try {
        input.setSelectionRange(length, length);
      } catch (error) {
        // Abaikan jika input tidak mendukung selection range.
      }
    }

    function dispatchNativeInput(input) {
      const inputEvent = new Event('input', {
        bubbles: true
      });

      input.dispatchEvent(inputEvent);
    }

    function commitPowerInput(input) {
      const oldValue = input.value;
      const newValue = convertPowerInput(oldValue);

      if (oldValue !== newValue) {
        input.value = newValue;
        dispatchNativeInput(input);
      }
    }

    function enhancePowerInput(input) {
      if (!input || input.dataset.powerEnhanced === 'true') return;

      input.dataset.powerEnhanced = 'true';
      input.classList.add('math-power-input');

      input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
          event.preventDefault();

          commitPowerInput(input);
          setCursorToEnd(input);
          input.blur();
        }

        if (event.key === ' ') {
          event.preventDefault();

          commitPowerInput(input);

          if (input.value.trim() !== '') {
            input.value = input.value.trimEnd() + ' ';
            setCursorToEnd(input);
            dispatchNativeInput(input);
          }
        }

        if (event.key === 'Tab') {
          commitPowerInput(input);
        }
      });

      input.addEventListener('blur', function () {
        commitPowerInput(input);
      });

      input.addEventListener('change', function () {
        commitPowerInput(input);
      });

      input.addEventListener('paste', function () {
        setTimeout(function () {
          commitPowerInput(input);
          setCursorToEnd(input);
        }, 50);
      });
    }

    function initPowerInputs() {
      document.querySelectorAll('input[type="text"]').forEach(function (input) {
        enhancePowerInput(input);
      });
    }

    document.addEventListener('DOMContentLoaded', initPowerInputs);
  </script>

</body>

</html>