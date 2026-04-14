<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Polymathica – Landing Page</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <style>
    :root {
      --cream-bg: #FDFDE8;
      --hero-bg: #FDFDE8;
      --brown-main: #b58b63;
      --brown-dark: #9a6f46;
      --brown-soft: #c7ad95;
      --brown-light: #f2e7d8;
      --text-main: #4f4a3f;
      --text-soft: #6e6458;
      --shadow-main: 0 18px 40px rgba(86, 63, 43, 0.14);
      --shadow-hover: 0 25px 55px rgba(86, 63, 43, 0.22);
      --radius-xl: 28px;
    }

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: var(--cream-bg);
      color: var(--text-main);
      overflow-x: hidden;
    }

    /* ===== NAVBAR ===== */
    nav.navbar {
      background-color: rgba(255, 255, 255, 0.92) !important;
      backdrop-filter: blur(10px);
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
      position: relative;
      transition: 0.3s ease;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -4px;
      width: 0;
      height: 2px;
      background: var(--brown-main);
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .btn-nav {
      font-size: 0.85rem;
      border-radius: 999px;
      border: 1px solid #d7c1aa;
      background-color: #f6ebdf;
      padding: 0.55rem 1.5rem;
      transition: all 0.3s ease;
    }

    .btn-nav-outline {
      background-color: transparent;
    }

    .btn-nav:hover {
      background-color: #e3cfb7;
      transform: translateY(-2px);
    }

    /* ===== HERO ===== */
    .hero {
      background:
        radial-gradient(circle at top left, rgba(255, 255, 255, 0.85), transparent 35%),
        radial-gradient(circle at bottom right, rgba(181, 139, 99, 0.10), transparent 30%),
        var(--hero-bg);
      padding: 2rem 0 2.5rem;
      overflow: hidden;
      position: relative;
    }

    .hero::before,
    .hero::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      z-index: 0;
      filter: blur(10px);
      animation: floatBlob 7s ease-in-out infinite;
    }

    .hero::before {
      width: 220px;
      height: 220px;
      background: rgba(181, 139, 99, 0.08);
      top: -40px;
      left: -60px;
    }

    .hero::after {
      width: 280px;
      height: 280px;
      background: rgba(133, 151, 123, 0.08);
      bottom: -80px;
      right: -70px;
      animation-delay: 1.5s;
    }

    .hero .container-fluid {
      position: relative;
      z-index: 2;
    }

    .hero-img {
      max-width: 500px;
      width: 100%;
      animation: heroFloat 4.8s ease-in-out infinite;
      transform-origin: center;
      filter: drop-shadow(0 25px 30px rgba(0, 0, 0, 0.12));
      will-change: transform;
    }

    .hero-img:hover {
      animation-duration: 4.5s;
    }

    .hero-title {
      font-family: "Playfair Display", serif;
      font-size: 2rem;
      font-weight: 700;
      color: #5d5042;
    }

    .hero-subtitle {
      font-size: 0.95rem;
      font-style: italic;
      color: #7c7467;
    }

    .hero-body {
      font-size: 0.97rem;
      line-height: 1.8;
      color: #6e6458;
      text-align: justify;
    }

    .hero-text-wrapper {
      max-width: 540px;
    }

    .btn-primary-custom {
      border-radius: 999px;
      background: linear-gradient(135deg, var(--brown-main), var(--brown-dark));
      border: none;
      font-size: 0.9rem;
      padding: 0.75rem 2.2rem;
      color: white;
      box-shadow: 0 14px 25px rgba(181, 139, 99, 0.25);
      transition: all 0.35s ease;
      position: relative;
      overflow: hidden;
      text-decoration: none;
    }

    .btn-primary-custom:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 18px 30px rgba(181, 139, 99, 0.35);
      color: white;
    }

    /* ===== FITUR SECTION ===== */
    .fitur-section {
      position: relative;
      overflow: hidden;
      background: linear-gradient(180deg, #c8af97 0%, #c1a387 100%);
      padding: 5.5rem 0;
      isolation: isolate;
    }

    .fitur-section::before,
    .fitur-section::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      z-index: -1;
      opacity: 0.45;
      filter: blur(8px);
    }

    .fitur-section::before {
      width: 320px;
      height: 320px;
      background: rgba(255, 255, 255, 0.16);
      top: -90px;
      left: -90px;
      animation: floatBlob 9s ease-in-out infinite;
    }

    .fitur-section::after {
      width: 380px;
      height: 380px;
      background: rgba(255, 255, 255, 0.10);
      bottom: -140px;
      right: -110px;
      animation: floatBlob 10s ease-in-out infinite reverse;
    }

    .fitur-title {
      font-family: "Playfair Display", serif;
      color: #fff9f3;
      font-size: 2.6rem;
      font-weight: 700;
      letter-spacing: 2px;
      margin-bottom: 0.75rem;
    }

    .fitur-subtitle {
      color: rgba(255, 248, 240, 0.86);
      font-size: 1rem;
      max-width: 620px;
      margin: 0 auto 3rem;
      line-height: 1.8;
    }

    .fitur-wrap {
      position: relative;
      z-index: 2;
    }

    .fitur-card {
      position: relative;
      background: rgba(250, 243, 233, 0.92);
      border: 1px solid rgba(255, 255, 255, 0.45);
      border-radius: var(--radius-xl);
      padding: 2rem 1.5rem 1.8rem;
      min-height: 390px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      box-shadow: var(--shadow-main);
      overflow: hidden;
      transform: translateY(50px);
      opacity: 0;
      transition:
        transform 0.55s ease,
        box-shadow 0.35s ease,
        background 0.35s ease,
        opacity 0.55s ease;
      will-change: transform, opacity;
    }

    .fitur-card.show {
      transform: translateY(0);
      opacity: 1;
    }

    .fitur-card:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: var(--shadow-hover);
      background: rgba(255, 248, 241, 0.97);
    }

    .fitur-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at top right, rgba(181, 139, 99, 0.18), transparent 28%),
        radial-gradient(circle at bottom left, rgba(133, 151, 123, 0.12), transparent 22%);
      pointer-events: none;
    }

    .fitur-number {
      position: absolute;
      top: 16px;
      right: 20px;
      font-size: 3rem;
      font-weight: 700;
      line-height: 1;
      color: rgba(181, 139, 99, 0.15);
      font-family: "Playfair Display", serif;
    }

    .fitur-icon-wrap {
      width: 110px;
      height: 110px;
      border-radius: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(145deg, #efe1ce, #f7ecdf);
      box-shadow:
        inset 0 2px 10px rgba(255, 255, 255, 0.7),
        0 12px 18px rgba(181, 139, 99, 0.12);
      margin-bottom: 1.25rem;
      position: relative;
      z-index: 2;
      animation: floatY 4s ease-in-out infinite;
    }

    .fitur-img {
      width: 82px;
      max-width: 100%;
      object-fit: contain;
    }

    .fitur-card-materi .fitur-img {
      width: 180px;
      animation: materiMove 4.8s ease-in-out infinite;
      transform-origin: center bottom;
      filter: drop-shadow(0 12px 18px rgba(0, 0, 0, 0.08));
    }

    .fitur-card-materi:hover .fitur-img {
      animation-duration: 2.8s;
    }

    .fitur-card h4 {
      font-size: 1.6rem;
      font-weight: 600;
      color: #4b4339;
      margin-bottom: 0.9rem;
      position: relative;
      z-index: 2;
    }

    .fitur-card p {
      font-size: 0.98rem;
      line-height: 1.8;
      color: var(--text-soft);
      margin-bottom: 1.4rem;
      position: relative;
      z-index: 2;
    }

    .fitur-pill {
      margin-top: auto;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(181, 139, 99, 0.12);
      color: #8b6542;
      border: 1px solid rgba(181, 139, 99, 0.20);
      border-radius: 999px;
      padding: 0.55rem 1rem;
      font-size: 0.84rem;
      font-weight: 500;
      position: relative;
      z-index: 2;
      transition: all 0.3s ease;
    }

    .fitur-card:hover .fitur-pill {
      background: rgba(181, 139, 99, 0.18);
      transform: translateY(-2px);
    }

    .fitur-glow {
      position: absolute;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.18);
      top: -30px;
      left: -30px;
      filter: blur(6px);
      animation: pulseGlow 4s ease-in-out infinite;
    }

    .fitur-line {
      width: 72px;
      height: 4px;
      border-radius: 999px;
      margin: 0 auto 1.1rem;
      background: linear-gradient(90deg, #f7efe5, #fff, #f7efe5);
      opacity: 0.9;
    }

    footer {
      background-color: #ffffff;
      padding: 12px;
      border-top: 1px solid #e2d7c9;
      font-size: 0.78rem;
      color: #8f8375;
      text-align: center;
    }

    @keyframes floatY {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes heroFloat {
      0% {
        transform: translateY(0px) scale(1);
      }

      50% {
        transform: translateY(-18px) scale(1.015);
      }

      100% {
        transform: translateY(0px) scale(1);
      }
    }

    @keyframes floatBlob {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      50% {
        transform: translate(20px, -18px) scale(1.06);
      }
    }

    @keyframes pulseGlow {

      0%,
      100% {
        transform: scale(1);
        opacity: 0.35;
      }

      50% {
        transform: scale(1.12);
        opacity: 0.55;
      }
    }

    @keyframes materiMove {

      0%,
      100% {
        transform: translateY(0) rotate(0deg) scale(1);
      }

      25% {
        transform: translateY(-8px) rotate(-2deg) scale(1.02);
      }

      50% {
        transform: translateY(-14px) rotate(0deg) scale(1.04);
      }

      75% {
        transform: translateY(-8px) rotate(2deg) scale(1.02);
      }
    }

    @media (max-width: 991.98px) {
      .hero {
        padding: 1.5rem 0 2.5rem;
      }

      .hero-title {
        font-size: 1.75rem;
      }

      .fitur-title {
        font-size: 2.15rem;
      }

      .fitur-card {
        min-height: 360px;
      }
    }

    @media (max-width: 767.98px) {

      .hero-title,
      .hero-subtitle,
      .hero-body,
      .hero-text-wrapper {
        text-align: center;
      }

      .hero-text-wrapper {
        margin: 0 auto;
      }

      .hero-body {
        text-align: center;
      }

      .fitur-section {
        padding: 4rem 0;
      }

      .fitur-title {
        font-size: 1.8rem;
        letter-spacing: 1px;
      }

      .fitur-subtitle {
        font-size: 0.94rem;
      }

      .fitur-card {
        max-width: 100%;
        min-height: auto;
      }

      .fitur-card-materi .fitur-img {
        width: 150px;
      }

      .hero-img {
        max-width: 420px;
      }
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
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
      <div class="row align-items-center g-4">
        <div class="col-md-6 text-center">
          <img src="{{ asset('img/1.png') }}" class="hero-img" alt="Hero Polimathica">
        </div>

        <div class="col-md-6">
          <div class="hero-text-wrapper">
            <h1 class="hero-title mb-2">Selamat datang di Polimathica</h1>
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
    <div class="container fitur-wrap">
      <div class="text-center">
        <h2 class="fitur-title">3 FITUR UTAMA</h2>
        <div class="fitur-line"></div>
        <p class="fitur-subtitle">
          Fitur-fitur utama Polimathica dirancang untuk membuat proses belajar
          lebih aktif, terarah, dan menyenangkan bagi siswa maupun guru.
        </p>
      </div>

      <div class="row g-4 justify-content-center">

        <div class="col-md-6 col-lg-4 d-flex">
          <div class="fitur-card fitur-card-materi reveal-card w-100">
            <div class="fitur-glow"></div>
            <div class="fitur-number">01</div>

            <div class="fitur-icon-wrap">
              <img src="{{ asset('img/4.png') }}" class="fitur-img" alt="Materi Interaktif">
            </div>

            <h4>Materi Interaktif</h4>
            <p>
              Siswa dapat belajar dengan materi yang responsif, runtut, dan
              dilengkapi latihan yang memberi umpan balik otomatis secara langsung.
            </p>

            <div class="fitur-pill">
              <span>Belajar lebih aktif</span>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 d-flex">
          <div class="fitur-card reveal-card w-100">
            <div class="fitur-glow"></div>
            <div class="fitur-number">02</div>

            <div class="fitur-icon-wrap">
              <img src="{{ asset('img/5.png') }}" class="fitur-img" alt="Kuis dan Evaluasi">
            </div>

            <h4>Kuis & Evaluasi</h4>
            <p>
              Tersedia kuis dan evaluasi untuk membantu mengukur sejauh mana
              pemahaman siswa terhadap materi secara cepat dan terstruktur.
            </p>

            <div class="fitur-pill">
              <span>Ukur pemahaman</span>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 d-flex">
          <div class="fitur-card reveal-card w-100">
            <div class="fitur-glow"></div>
            <div class="fitur-number">03</div>

            <div class="fitur-icon-wrap">
              <img src="{{ asset('img/6.png') }}" class="fitur-img" alt="Dashboard Guru">
            </div>

            <h4>Dashboard Guru</h4>
            <p>
              Guru dapat memantau perkembangan belajar, hasil latihan, dan
              performa siswa melalui tampilan dashboard yang ringkas dan jelas.
            </p>

            <div class="fitur-pill">
              <span>Pantau progres siswa</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <footer>
    © 2026 Polimathica. Olyvia Ika Albina
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const cards = document.querySelectorAll(".reveal-card");

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              entry.target.classList.add("show");
            }, index * 180);
          }
        });
      }, {
        threshold: 0.2
      });

      cards.forEach((card) => observer.observe(card));
    });
  </script>
</body>

</html>