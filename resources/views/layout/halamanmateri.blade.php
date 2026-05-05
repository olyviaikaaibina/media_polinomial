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

  <!-- Token kunci materi -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root {
      --green-soft: #AAB99A;
      --cream-box: #F3E0C5;
      --cream-bg: #FFFDE6;
      --text-main: #4F4A3F;

      --sage-dark: #8F9F76;
      --sage-line: rgba(79, 74, 63, 0.12);
      --drop-border: rgba(255, 255, 255, 0.55);

      --sidebar-width: 280px;
      --navbar-height: 80px;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: var(--cream-bg);
      color: var(--text-main);
      padding-top: var(--navbar-height);
      overflow: hidden;
    }

    .navbar-polymathica {
      border-bottom: 1px solid var(--sage-line);
      background: #ffffff;
      height: var(--navbar-height);
    }

    .brand-inline {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      line-height: 1;
    }

    .brand-inline .logo-img {
      height: 38px;
      width: auto;
      display: block;
      margin: 0;
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

    .navbar-polymathica .nav-link:hover {
      color: #8F9F76;
    }

    .navbar-polymathica .nav-link.active {
      color: var(--sage-dark);
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
      z-index: 1020;
      transition: transform 0.25s ease;
      will-change: transform;
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
      line-height: 1.3;
      cursor: pointer;
      text-align: left;
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
    }

    .content-scroll {
      flex: 1;
      overflow-y: auto;
    }

    .content-navigation {
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid var(--sage-line);
      display: flex;
      justify-content: space-between;
      gap: 12px;
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
    }

    .btn-nav:hover {
      background: var(--sage-dark);
    }

    .btn-nav.disabled {
      opacity: 0.55;
      pointer-events: none;
    }

    .sidebar-handle {
      position: fixed;
      left: 14px;
      top: calc(var(--navbar-height) + 16px);
      z-index: 1200;
      display: none;
    }

    body.sidebar-collapsed .sidebar-handle {
      display: block;
    }

    .sidebar-handle button {
      height: 46px;
      width: 46px;
      border-radius: 14px;
      background: #ffffff;
      color: var(--text-main);
      border: 2px solid var(--green-soft);
      font-size: 20px;
      font-weight: 800;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
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

    .sidebar-handle button:active {
      transform: translateX(2px) scale(0.97);
    }

    /* Style kunci materi */
    .dropdown-item.locked {
      opacity: .7;
      cursor: not-allowed;
      color: var(--text-main);
    }

    .dropdown-item.locked:hover {
      background: rgba(255, 255, 255, 0.35);
    }

    @media (max-width: 991.98px) {
      body {
        overflow: auto;
      }

      .sidebar {
        transform: translateX(calc(-1 * var(--sidebar-width)));
      }

      body.sidebar-open .sidebar {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0 !important;
        height: auto;
        min-height: calc(100vh - var(--navbar-height));
      }

      .sidebar-handle {
        display: none !important;
      }

      .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.25);
        z-index: 1100;
      }

      body.sidebar-open .sidebar-overlay {
        display: block;
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

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar">
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

          /*
            Kalau $unlockedSlugs belum dikirim dari controller,
            default-nya hanya materi pertama yang terbuka.
          */
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

          {{-- Pengertian Polinomial: selalu terbuka --}}
          <a href="{{ route('materi.show', ['slug' => 'pengertianpolinomial']) }}"
            class="dropdown-item {{ $materiActive('pengertianpolinomial') }}">
            Pengertian Polinomial
          </a>

          {{-- Derajat Suatu Polinomial --}}
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

          {{-- Fungsi Polinomial dan Grafiknya --}}
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

          {{-- Kuis A --}}
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
          <a href="{{ route('materi.show', ['slug' => 'penjumlahanpolinomial']) }}"
            class="dropdown-item {{ $materiActive('penjumlahanpolinomial') }}">
            Penjumlahan Polinomial
          </a>

          <a href="{{ route('materi.show', ['slug' => 'penguranganpolinomial']) }}"
            class="dropdown-item {{ $materiActive('penguranganpolinomial') }}">
            Pengurangan Polinomial
          </a>

          <a href="{{ route('materi.show', ['slug' => 'perkalianpolinomial']) }}"
            class="dropdown-item {{ $materiActive('perkalianpolinomial') }}">
            Perkalian Polinomial
          </a>

          <a href="{{ route('quiz.show', ['id' => 2]) }}" class="dropdown-item {{ $quizActive(2) }}">
            Kuis B
          </a>
        </div>
      </div>

      {{-- BAB 3 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Pembagian Polinomial</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          <a href="{{ route('materi.show', ['slug' => 'pembagianbersusun']) }}"
            class="dropdown-item {{ $materiActive('pembagianbersusun') }}">
            Pembagian Bersusun
          </a>

          <a href="{{ route('materi.show', ['slug' => 'metodehorner']) }}"
            class="dropdown-item {{ $materiActive('metodehorner') }}">
            Metode Horner
          </a>

          <a href="{{ route('materi.show', ['slug' => 'teoremasisa']) }}"
            class="dropdown-item {{ $materiActive('teoremasisa') }}">
            Teorema Sisa
          </a>

          <a href="{{ route('quiz.show', ['id' => 3]) }}" class="dropdown-item {{ $quizActive(3) }}">
            Kuis C
          </a>
        </div>
      </div>

      {{-- BAB 4 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Faktor & Pembuat Nol</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          <a href="{{ route('materi.show', ['slug' => 'teoremafaktor']) }}"
            class="dropdown-item {{ $materiActive('teoremafaktor') }}">
            Teorema Faktor
          </a>

          <a href="{{ route('materi.show', ['slug' => 'faktordanpembuatnol']) }}"
            class="dropdown-item {{ $materiActive('faktordanpembuatnol') }}">
            Faktor dan Pembuat Nol
          </a>

          <a href="{{ route('quiz.show', ['id' => 4]) }}" class="dropdown-item {{ $quizActive(4) }}">
            Kuis D
          </a>
        </div>
      </div>

      {{-- BAB 5 --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Identitas Polinomial</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          <a href="{{ route('materi.show', ['slug' => 'identitaspolinomial']) }}"
            class="dropdown-item {{ $materiActive('identitaspolinomial') }}">
            Identitas Polinomial
          </a>

          <a href="{{ route('quiz.show', ['id' => 5]) }}" class="dropdown-item {{ $quizActive(5) }}">
            Kuis E
          </a>
        </div>
      </div>

      {{-- EVALUASI --}}
      <div class="dropdown-group">
        <button class="sidebar-menu-item dropdown-toggle-btn" type="button">
          <span>Evaluasi</span>
          <span class="dropdown-arrow">&#9662;</span>
        </button>

        <div class="dropdown-content">
          <a href="{{ route('quiz.show', ['id' => 6]) }}" class="dropdown-item {{ $quizActive(6) }}">
            Evaluasi
          </a>
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

    function toggleSidebar() {
      if (isMobile()) {
        document.body.classList.toggle('sidebar-open');
      } else {
        document.body.classList.toggle('sidebar-collapsed');
      }
    }

    if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);

    if (handleBtn) {
      handleBtn.addEventListener('click', function () {
        document.body.classList.remove('sidebar-collapsed');
      });
    }

    if (overlay) overlay.addEventListener('click', closeSidebarMobile);

    window.addEventListener('resize', function () {
      if (!isMobile()) closeSidebarMobile();
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
  </script>

</body>

</html>