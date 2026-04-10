{{-- resources/views/layout/navbarguru.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Polimathica – Dashboard Guru')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet" />

  <style>
    :root {
      --cream-bg: #FCFCE8;
      --sidebar-bg: #94A889;
      --menu-bg: #EAD9C7;
      --menu-hover: #F8EDDD;
      --text-main: #4f4a3f;

      --sidebar-width: 260px;
      --navbar-height: 78px;

      --content-pad: 24px;
      --content-top-gap: 14px;

      --collapsed-offset: 96px;

      --active-bg: #F8EDDD;
      --active-border: rgba(79, 74, 63, 0.25);
      --active-text: #2f2b24;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", sans-serif;
      background-color: var(--cream-bg);
      color: var(--text-main);
      margin: 0;
      min-height: 100vh;
      overflow-x: hidden;
    }

    nav.navbar {
      background-color: #ffffff !important;
      border-bottom: 1px solid #e2d7c9;
      padding: 0.75rem 1.25rem;
      min-height: var(--navbar-height);
      z-index: 1030;
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
      white-space: nowrap;
      line-height: 1.1;
    }

    .navbar .nav-item.d-flex {
      align-items: center;
    }

    .navbar .nav-link.active {
      font-weight: 700;
      color: var(--active-text) !important;
      position: relative;
    }

    .navbar .nav-link.active::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: -6px;
      height: 2px;
      background: #94A889;
      border-radius: 2px;
    }

    .sidebar {
      width: var(--sidebar-width);
      height: 100vh;
      background-color: var(--sidebar-bg);
      padding: 18px 14px 24px;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: calc(var(--navbar-height) + 14px);
      overflow-y: auto;
      transition: transform 0.25s ease;
      z-index: 1025;
    }

    body.sidebar-collapsed .sidebar {
      transform: translateX(calc(-1 * var(--sidebar-width)));
    }

    .sidebar-menu {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .btn-sidebar-toggle {
      border: 1px solid rgba(255, 255, 255, 0.65);
      background: rgba(255, 255, 255, 0.90);
      border-radius: 12px;
      padding: 0.45rem 0.65rem;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-sidebar-toggle:hover {
      background: rgba(255, 255, 255, 1);
    }

    .sidebar-group-header {
      background-color: var(--menu-bg);
      border-radius: 12px;
      padding: 10px 14px;
      display: flex;
      align-items: center;
      font-size: 15px;
      font-weight: 600;
      color: #3b3129;
      cursor: pointer;
      border: none;
      width: 100%;
      text-align: left;
      transition: background 0.15s ease, box-shadow 0.15s ease;
    }

    .sidebar-group-header:hover {
      background-color: var(--menu-hover);
    }

    .sidebar-icon-main {
      font-size: 20px;
      margin-right: 10px;
    }

    .sidebar-chevron {
      margin-left: auto;
      font-size: 14px;
      transition: transform 0.2s ease;
    }

    .sidebar-group-header[aria-expanded="true"] .sidebar-chevron {
      transform: rotate(180deg);
    }

    .sidebar-submenu-wrapper {
      margin-top: 6px;
      padding-left: 16px;
      border-left: 2px solid rgba(255, 255, 255, 0.7);
    }

    .sidebar-subcard {
      display: block;
      background-color: var(--menu-bg);
      border-radius: 12px;
      padding: 8px 12px;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: 500;
      color: #3f3f3f;
      text-decoration: none;
      transition: background 0.15s ease, box-shadow 0.15s ease;
    }

    .sidebar-subcard:hover {
      background-color: var(--menu-hover);
    }

    .sidebar-single {
      background-color: var(--menu-bg);
      border-radius: 12px;
      padding: 10px 14px;
      display: flex;
      align-items: center;
      font-size: 15px;
      font-weight: 600;
      color: #3b3129;
      text-decoration: none;
      transition: background 0.15s ease, box-shadow 0.15s ease;
    }

    .sidebar-single:hover {
      background-color: var(--menu-hover);
    }

    .sidebar-single.active,
    .sidebar-subcard.active,
    .sidebar-group-header.active {
      background-color: #BDA489 !important;
      color: #2A241E !important;
      box-shadow: inset 0 0 0 2px rgba(0, 0, 0, 0.15);
    }

    .content-area {
      margin-left: var(--sidebar-width);
      padding: var(--content-pad);
      padding-top: var(--content-top-gap);
      transition: margin-left 0.25s ease, padding 0.25s ease;
    }

    body.sidebar-collapsed .content-area {
      margin-left: 0;
      padding-left: var(--collapsed-offset);
      padding-top: var(--content-top-gap);
    }

    .sidebar-handle {
      position: fixed;
      left: 16px;
      top: calc(var(--navbar-height) + 15px);
      z-index: 1031;
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
      color: #4f4a3f;
      border: 2px solid #94A889;
      font-size: 20px;
      font-weight: 700;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
      cursor: pointer;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar-handle button:hover {
      background: #f4f7f2;
      transform: translateX(3px);
    }

    .sidebar-handle button:active {
      transform: translateX(2px) scale(0.97);
    }

    @media (max-width: 991.98px) {
      :root {
        --navbar-height: 74px;
        --content-pad: 16px;
        --content-top-gap: 12px;
      }

      body:not(.sidebar-open) .sidebar {
        transform: translateX(calc(-1 * var(--sidebar-width)));
      }

      body.sidebar-open .sidebar {
        transform: translateX(0);
      }

      .content-area {
        margin-left: 0;
        padding: var(--content-pad);
        padding-top: var(--content-top-gap);
      }

      .sidebar-handle {
        display: none !important;
      }

      .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.25);
        z-index: 1020;
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

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">

      <a class="brand me-4" href="{{ route('landingpage') }}">
        <img src="{{ asset('img/2.png') }}" alt="Logo Polimathica">
        <span>POLIMATHICA</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-lg-3">

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('landingpage') ? 'active' : '' }}" href="{{ route('landingpage') }}">
              Beranda
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('petunjukpenggunaan') ? 'active' : '' }}"
              href="{{ route('petunjukpenggunaan') }}">
              Petunjuk Penggunaan
            </a>
          </li>

          <li class="nav-item d-flex">
            <form action="{{ route('guru.logout') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="nav-link btn btn-link p-0" style="cursor:pointer;">
                Logout
              </button>
            </form>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="sidebar" id="sidebar">

    <div class="d-flex justify-content-start mb-3">
      <button class="btn-sidebar-toggle" type="button" id="toggleSidebar" aria-label="Toggle Sidebar">
        ☰
      </button>
    </div>

    <div class="sidebar-menu">

      <a href="{{ route('dashboardguru') }}"
        class="sidebar-single {{ request()->routeIs('dashboardguru') ? 'active' : '' }}">
        <span style="font-size:20px; margin-right:10px;">📊</span>
        Dashboard
      </a>

      <div class="sidebar-group">
        @php
          $siswaActive = request()->routeIs('daftarsiswa') ||
                         request()->routeIs('rekapitulasinilai') ||
                         request()->routeIs('aktivitassiswa');
        @endphp

        <button class="sidebar-group-header {{ $siswaActive ? 'active' : '' }}" data-bs-toggle="collapse"
          data-bs-target="#groupSiswa" aria-expanded="{{ $siswaActive ? 'true' : 'false' }}">
          <span class="sidebar-icon-main">🧑‍🏫</span>
          Manajemen Siswa
          <span class="sidebar-chevron">▾</span>
        </button>

        <div class="collapse {{ $siswaActive ? 'show' : '' }}" id="groupSiswa">
          <div class="sidebar-submenu-wrapper">
            <a href="{{ route('daftarsiswa') }}"
              class="sidebar-subcard {{ request()->routeIs('daftarsiswa') ? 'active' : '' }}">
              Daftar Siswa
            </a>
            <a href="{{ route('rekapitulasinilai') }}"
              class="sidebar-subcard {{ request()->routeIs('rekapitulasinilai') ? 'active' : '' }}">
              Rekapitulasi Nilai
            </a>
            <a href="{{ route('aktivitassiswa') }}"
              class="sidebar-subcard {{ request()->routeIs('aktivitassiswa') ? 'active' : '' }}">
              Aktivitas Siswa
            </a>
          </div>
        </div>
      </div>

      <a href="{{ route('daftarkuis') }}"
        class="sidebar-single {{ request()->routeIs('daftarkuis') ? 'active' : '' }}">
        <span style="font-size:20px; margin-right:10px;">📝</span>
        Manajemen Kuis
      </a>

      <a href="{{ route('daftarmateriguru') }}"
        class="sidebar-single {{ request()->routeIs('daftarmateriguru') ? 'active' : '' }}">
        <span style="font-size:20px; margin-right:10px;">📘</span>
        Daftar Materi
      </a>

    </div>
  </div>

  <div class="content-area">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

    toggleBtn.addEventListener('click', toggleSidebar);

    if (handleBtn) {
      handleBtn.addEventListener('click', () => {
        document.body.classList.remove('sidebar-collapsed');
      });
    }

    overlay.addEventListener('click', closeSidebarMobile);

    window.addEventListener('resize', () => {
      if (!isMobile()) {
        closeSidebarMobile();
      }
    });
  </script>

  @yield('scripts')
</body>

</html>