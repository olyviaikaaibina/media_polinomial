{{-- resources/views/guru/dashboardguru.blade.php --}}
@extends('layout.navbarguru')

@section('title', 'Halaman Guru - Dashboard')

@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /*
        |--------------------------------------------------------------------------
        | Reset Layout
        |--------------------------------------------------------------------------
        */
        .content-area,
        .main-content,
        .page-content,
        .content-wrapper,
        .dashboard-wrapper {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }

        * {
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
        }

        /*
        |--------------------------------------------------------------------------
        | Tombol Burger Seperti Gambar
        |--------------------------------------------------------------------------
        */
        .dashboard-mobile-header {
            display: none;
            width: 100%;
            margin-bottom: 18px;
        }

        .dashboard-burger-btn {
            width: 68px;
            height: 68px;
            border: 3px solid #8fa283;
            border-radius: 20px;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #4b453d;
            box-shadow: none;
            transition: 0.2s ease;
        }

        .dashboard-burger-btn:hover {
            background: #f7faf4;
            transform: translateY(-1px);
        }

        .dashboard-burger-btn i {
            font-size: 34px;
            line-height: 1;
        }

        .dashboard-sidebar-overlay {
            position: fixed;
            inset: 0;
            display: none;
            background: rgba(47, 43, 37, 0.45);
            z-index: 998;
        }

        .dashboard-sidebar-overlay.show {
            display: block;
        }

        /*
        |--------------------------------------------------------------------------
        | Sidebar Mobile Existing dari layout.navbarguru
        |--------------------------------------------------------------------------
        | Ini memanggil sidebar bawaan layout, bukan membuat sidebar baru.
        | Warna sidebar dibuat hijau agar sama dengan tampilan dashboard.
        |--------------------------------------------------------------------------
        */
        @media (max-width: 992px) {
            body.sidebar-mobile-open {
                overflow: hidden;
            }

            body.sidebar-mobile-open .dashboard-sidebar-overlay {
                display: block;
            }

            body :is(
                .sidebar,
                .sidebar-guru,
                .guru-sidebar,
                .navbarguru-sidebar,
                .navbar-guru-sidebar,
                .layout-sidebar,
                .side-menu,
                .side-navbar
            ) {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 280px !important;
                max-width: 84vw !important;
                height: 100vh !important;
                min-height: 100vh !important;
                overflow-y: auto !important;
                background: #9caf8f !important;
                background-color: #9caf8f !important;
                z-index: 999 !important;
                transform: translateX(-110%) !important;
                transition: transform 0.25s ease !important;
                box-shadow: 18px 0 40px rgba(47, 43, 37, 0.22) !important;
                border-right: none !important;
            }

            body.sidebar-mobile-open :is(
                .sidebar,
                .sidebar-guru,
                .guru-sidebar,
                .navbarguru-sidebar,
                .navbar-guru-sidebar,
                .layout-sidebar,
                .side-menu,
                .side-navbar
            ) {
                transform: translateX(0) !important;
            }

            /*
            | Paksa bagian dalam sidebar agar tidak putih.
            */
            body.sidebar-mobile-open :is(
                .sidebar,
                .sidebar-guru,
                .guru-sidebar,
                .navbarguru-sidebar,
                .navbar-guru-sidebar,
                .layout-sidebar,
                .side-menu,
                .side-navbar
            ) :is(
                .brand,
                .logo,
                .sidebar-brand,
                .sidebar-header,
                .menu,
                .nav,
                .navbar-nav,
                .sidebar-menu,
                .menu-wrapper,
                .nav-wrapper,
                .collapse,
                .offcanvas-body
            ) {
                background: transparent !important;
                background-color: transparent !important;
            }

            /*
            | Jika layout punya area putih di atas sidebar, ikut dibuat hijau.
            */
            body.sidebar-mobile-open :is(
                .sidebar,
                .sidebar-guru,
                .guru-sidebar,
                .navbarguru-sidebar,
                .navbar-guru-sidebar,
                .layout-sidebar,
                .side-menu,
                .side-navbar
            ) > * {
                background-color: transparent !important;
            }

            /*
            | Menu item tetap warna krem seperti tampilan asli.
            */
            body.sidebar-mobile-open :is(
                .sidebar,
                .sidebar-guru,
                .guru-sidebar,
                .navbarguru-sidebar,
                .navbar-guru-sidebar,
                .layout-sidebar,
                .side-menu,
                .side-navbar
            ) a {
                color: #2f2b25;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */
        .guru-dashboard {
            min-height: 100vh;
            padding: 28px 36px 55px;
            background: transparent !important;
            color: #2f2b25;
            overflow-x: hidden;
        }

        .dashboard-content {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Welcome Card
        |--------------------------------------------------------------------------
        */
        .welcome-card {
            margin-bottom: 24px;
            padding: 30px 34px;
            border-radius: 26px;
            background: #ffffff;
            border: 1px solid rgba(139, 115, 88, 0.18);
            box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
        }

        .welcome-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            padding: 8px 14px;
            border-radius: 999px;
            color: #536948;
            background: #edf4e8;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.7px;
            text-transform: uppercase;
        }

        .welcome-title {
            margin: 0;
            color: #2f2b25;
            font-size: clamp(30px, 4vw, 52px);
            line-height: 1.08;
            font-weight: 950;
            letter-spacing: -1.5px;
            word-break: break-word;
        }

        .welcome-title span {
            color: #8b6f3d;
        }

        .welcome-text {
            max-width: 760px;
            margin: 12px 0 0;
            color: #675f52;
            font-size: 15.5px;
            line-height: 1.75;
            font-weight: 600;
        }

        .welcome-icon {
            width: 82px;
            height: 82px;
            flex: 0 0 82px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #536948;
            background: #edf4e8;
            font-size: 36px;
        }

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
            margin-bottom: 24px;
        }

        .stat-card {
            min-width: 0;
            padding: 26px;
            border-radius: 24px;
            background: #ffffff;
            border: 1px solid rgba(139, 115, 88, 0.18);
            box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
            transition: 0.22s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 38px rgba(83, 68, 47, 0.12);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            margin-bottom: 18px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .stat-card.green .stat-icon {
            color: #536948;
            background: #edf4e8;
        }

        .stat-card.gold .stat-icon {
            color: #9a6a22;
            background: #fff1d5;
        }

        .stat-label {
            margin-bottom: 7px;
            color: #786e61;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        .stat-number {
            margin: 0;
            color: #2f2b25;
            font-size: clamp(36px, 5vw, 44px);
            line-height: 1;
            font-weight: 950;
            letter-spacing: -1.2px;
        }

        .stat-desc {
            display: block;
            margin-top: 11px;
            color: #6d6559;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 600;
        }

        /*
        |--------------------------------------------------------------------------
        | Card Chart dan Aktivitas
        |--------------------------------------------------------------------------
        */
        .chart-card,
        .activity-card {
            width: 100%;
            margin-bottom: 24px;
            padding: 26px;
            border-radius: 24px;
            background: #ffffff;
            border: 1px solid rgba(139, 115, 88, 0.18);
            box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 22px;
        }

        .section-heading {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            min-width: 0;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            border-radius: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            background: #eaf4ff;
            font-size: 22px;
        }

        .section-title {
            margin: 0 0 4px;
            color: #2f2b25;
            font-size: 21px;
            font-weight: 950;
            letter-spacing: -0.4px;
        }

        .section-subtitle {
            margin: 0;
            color: #70685d;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 600;
        }

        .chart-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 13px;
            border-radius: 999px;
            color: #2563eb;
            background: #eaf4ff;
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .chart-area {
            position: relative;
            width: 100%;
            height: 350px;
        }

        .chart-area canvas {
            width: 100% !important;
            height: 100% !important;
        }

        /*
        |--------------------------------------------------------------------------
        | Tabel Aktivitas
        |--------------------------------------------------------------------------
        */
        .activity-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .activity-table {
            width: 100%;
            min-width: 680px;
            border-collapse: collapse;
            margin: 0;
        }

        .activity-table thead th {
            padding: 14px 12px;
            color: #786e61;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            border-bottom: 1px solid rgba(139, 115, 88, 0.22);
            white-space: nowrap;
            text-align: left;
        }

        .activity-table tbody td {
            padding: 16px 12px;
            color: #3d3933;
            font-size: 14px;
            font-weight: 650;
            border-bottom: 1px solid rgba(139, 115, 88, 0.16);
            vertical-align: middle;
        }

        .activity-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 180px;
        }

        .student-avatar {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg,
                    rgba(33, 150, 243, 1),
                    rgba(59, 169, 245, 0.95),
                    rgba(112, 196, 247, 0.85));
            color: #ffffff;
            font-size: 15px;
            font-weight: 950;
            box-shadow: 0 8px 18px rgba(33, 150, 243, 0.22);
        }

        .student-name {
            color: #2f2b25;
            font-weight: 900;
            word-break: break-word;
        }

        .material-text {
            color: #4f483f;
            font-weight: 750;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 950;
            white-space: nowrap;
        }

        .status-success {
            color: #1f7a4d;
            background: #dbf7e6;
        }

        .status-warning {
            color: #a05b10;
            background: #fff0d5;
        }

        .status-secondary {
            color: #70685d;
            background: #eee7dc;
        }

        .time-text {
            color: #8a8172;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | Empty State
        |--------------------------------------------------------------------------
        */
        .empty-state {
            padding: 34px 0;
            text-align: center;
        }

        .empty-icon {
            width: 62px;
            height: 62px;
            margin: 0 auto 14px;
            border-radius: 21px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #536948;
            background: #edf4e8;
            font-size: 30px;
        }

        .empty-state h6 {
            margin-bottom: 8px;
            color: #2f2b25;
            font-size: 16px;
            font-weight: 950;
        }

        .empty-state p {
            max-width: 340px;
            margin: 0 auto;
            color: #70685d;
            font-size: 13px;
            line-height: 1.6;
            font-weight: 600;
        }

        /*
        |--------------------------------------------------------------------------
        | Laptop Kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 1199px) {
            .guru-dashboard {
                padding: 26px 28px 50px;
            }

            .dashboard-content {
                max-width: 100%;
            }

            .welcome-card,
            .chart-card,
            .activity-card,
            .stat-card {
                border-radius: 22px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Tablet
        |--------------------------------------------------------------------------
        */
        @media (max-width: 992px) {
            .dashboard-mobile-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }

            .guru-dashboard {
                padding: 22px 22px 48px;
            }

            .welcome-card {
                padding: 28px;
            }

            .stat-row {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .chart-area {
                height: 320px;
            }

            .section-title {
                font-size: 20px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HP Besar
        |--------------------------------------------------------------------------
        */
        @media (max-width: 768px) {
            .guru-dashboard {
                padding: 18px 16px 44px;
            }

            .dashboard-mobile-header {
                margin-bottom: 16px;
            }

            .dashboard-burger-btn {
                width: 66px;
                height: 66px;
                border-radius: 20px;
            }

            .dashboard-burger-btn i {
                font-size: 34px;
            }

            .welcome-card,
            .chart-card,
            .activity-card {
                padding: 22px;
                border-radius: 20px;
            }

            .stat-card {
                padding: 22px;
                border-radius: 20px;
            }

            .welcome-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
            }

            .welcome-title {
                font-size: 32px;
                letter-spacing: -1px;
            }

            .welcome-text {
                font-size: 14px;
                line-height: 1.65;
            }

            .welcome-icon {
                width: 68px;
                height: 68px;
                flex-basis: 68px;
                font-size: 30px;
                border-radius: 20px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .section-heading {
                gap: 11px;
            }

            .section-icon {
                width: 44px;
                height: 44px;
                flex-basis: 44px;
                font-size: 20px;
            }

            .section-title {
                font-size: 18px;
            }

            .section-subtitle {
                font-size: 13.5px;
            }

            .chart-badge {
                font-size: 11.5px;
                padding: 8px 12px;
            }

            .chart-area {
                height: 280px;
            }

            .activity-table {
                min-width: 640px;
            }

            .activity-table thead th,
            .activity-table tbody td {
                padding-left: 10px;
                padding-right: 10px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HP Kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 576px) {
            .guru-dashboard {
                padding: 14px 12px 38px;
            }

            .dashboard-burger-btn {
                width: 66px;
                height: 66px;
                border-radius: 20px;
                border-width: 3px;
            }

            .dashboard-burger-btn i {
                font-size: 34px;
            }

            .welcome-card,
            .chart-card,
            .activity-card,
            .stat-card {
                padding: 18px;
                border-radius: 18px;
            }

            .welcome-label {
                font-size: 10.5px;
                padding: 7px 11px;
            }

            .welcome-title {
                font-size: 27px;
                line-height: 1.15;
            }

            .welcome-text {
                font-size: 13.5px;
            }

            .welcome-icon {
                width: 60px;
                height: 60px;
                flex-basis: 60px;
                font-size: 27px;
                border-radius: 18px;
            }

            .stat-icon {
                width: 48px;
                height: 48px;
                border-radius: 16px;
                font-size: 22px;
                margin-bottom: 15px;
            }

            .stat-label {
                font-size: 11px;
            }

            .stat-number {
                font-size: 34px;
            }

            .stat-desc {
                font-size: 13px;
            }

            .section-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 15px;
                font-size: 18px;
            }

            .section-title {
                font-size: 17px;
            }

            .section-subtitle {
                font-size: 13px;
            }

            .chart-area {
                height: 250px;
            }

            .activity-table-wrapper {
                margin: 0 -4px;
                padding-bottom: 4px;
            }

            .activity-table {
                min-width: 600px;
            }

            .student-avatar {
                width: 38px;
                height: 38px;
                flex-basis: 38px;
                border-radius: 13px;
            }

            .empty-state {
                padding: 28px 8px;
            }

            .empty-icon {
                width: 56px;
                height: 56px;
                font-size: 27px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HP Sangat Kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 380px) {
            .guru-dashboard {
                padding: 12px 10px 34px;
            }

            .dashboard-burger-btn {
                width: 62px;
                height: 62px;
                border-radius: 19px;
            }

            .dashboard-burger-btn i {
                font-size: 32px;
            }

            .welcome-card,
            .chart-card,
            .activity-card,
            .stat-card {
                padding: 16px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .chart-area {
                height: 230px;
            }

            .activity-table {
                min-width: 560px;
            }
        }
    </style>

    @php
        $jumlahSiswa = $jumlahSiswa ?? 0;
        $pengunjungHariIni = $pengunjungHariIni ?? 0;
        $subbab = $subbab ?? ['Sub-bab 1', 'Sub-bab 2'];
        $nilaiRata = $nilaiRata ?? [0, 0];
        $aktivitas = $aktivitas ?? [];

        $namaGuru = auth('guru')->check()
            ? auth('guru')->user()->nama
            : 'Guru';
    @endphp

    <div class="dashboard-sidebar-overlay" id="dashboardSidebarOverlay"></div>

    <div class="guru-dashboard">
        <div class="dashboard-content">

            {{-- Tombol Burger Mobile --}}
            <div class="dashboard-mobile-header">
                <button type="button" class="dashboard-burger-btn" id="dashboardBurgerBtn" aria-label="Buka Sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <script type="application/json" id="chart-labels">
                {!! json_encode($subbab) !!}
            </script>

            <script type="application/json" id="chart-values">
                {!! json_encode($nilaiRata) !!}
            </script>

            <div class="welcome-card">
                <div class="welcome-inner">
                    <div>
                        <div class="welcome-label">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard Guru
                        </div>

                        <h1 class="welcome-title">
                            Selamat datang, <span>{{ $namaGuru }}</span>
                        </h1>

                        <p class="welcome-text">
                            Ringkasan aktivitas siswa dan hasil kuis pada materi Polinomial.
                        </p>
                    </div>

                    <div class="welcome-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                </div>
            </div>

            <div class="stat-row">
                <div class="stat-card green">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div class="stat-label">Jumlah Siswa</div>
                    <h2 class="stat-number">{{ $jumlahSiswa }}</h2>

                    <span class="stat-desc">
                        Total siswa yang terdaftar.
                    </span>
                </div>

                <div class="stat-card gold">
                    <div class="stat-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                    <div class="stat-label">Siswa yang Mengunjungi Hari Ini</div>
                    <h2 class="stat-number">{{ $pengunjungHariIni }}</h2>

                    <span class="stat-desc">
                        Siswa yang membuka pembelajaran hari ini.
                    </span>
                </div>
            </div>

            <div class="chart-card">
                <div class="section-header">
                    <div class="section-heading">
                        <div class="section-icon">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>

                        <div>
                            <h5 class="section-title">Nilai Rata-rata Siswa</h5>
                            <p class="section-subtitle">
                                Perbandingan nilai rata-rata siswa.
                            </p>
                        </div>
                    </div>

                    <div class="chart-badge">
                        <i class="bi bi-graph-up-arrow"></i>
                        Skala 0 - 100
                    </div>
                </div>

                <div class="chart-area">
                    <canvas id="chartKuis"></canvas>
                </div>
            </div>

            <div class="activity-card">
                <div class="section-header">
                    <div class="section-heading">
                        <div class="section-icon">
                            <i class="bi bi-activity"></i>
                        </div>

                        <div>
                            <h5 class="section-title">Aktivitas Siswa Terbaru</h5>
                            <p class="section-subtitle">
                                Daftar aktivitas terakhir siswa pada materi pembelajaran.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="activity-table-wrapper">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Materi</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($aktivitas as $a)
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                {{ strtoupper(substr($a->nama, 0, 1)) }}
                                            </div>

                                            <div class="student-name">
                                                {{ $a->nama }}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="material-text">{{ $a->materi }}</span>
                                    </td>

                                    <td>
                                        @if ($a->status === 'Selesai')
                                            <span class="status-badge status-success">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Selesai
                                            </span>
                                        @elseif ($a->status === 'Sedang dikerjakan')
                                            <span class="status-badge status-warning">
                                                <i class="bi bi-hourglass-split"></i>
                                                Sedang dikerjakan
                                            </span>
                                        @else
                                            <span class="status-badge status-secondary">
                                                <i class="bi bi-dash-circle-fill"></i>
                                                Belum mulai
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="time-text">{{ $a->waktu }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="bi bi-journal-text"></i>
                                            </div>

                                            <h6>Belum ada aktivitas siswa</h6>

                                            <p>
                                                Aktivitas siswa akan muncul setelah siswa mulai membuka materi
                                                atau mengerjakan kuis.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /*
            |--------------------------------------------------------------------------
            | Burger Untuk Membuka Sidebar Existing dari layout.navbarguru
            |--------------------------------------------------------------------------
            */
            const burgerBtn = document.getElementById('dashboardBurgerBtn');
            const overlay = document.getElementById('dashboardSidebarOverlay');

            function openSidebar() {
                document.body.classList.add('sidebar-mobile-open');

                if (overlay) {
                    overlay.classList.add('show');
                }
            }

            function closeSidebar() {
                document.body.classList.remove('sidebar-mobile-open');

                if (overlay) {
                    overlay.classList.remove('show');
                }
            }

            if (burgerBtn) {
                burgerBtn.addEventListener('click', function () {
                    openSidebar();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function () {
                    closeSidebar();
                });
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 992) {
                    closeSidebar();
                }
            });

            /*
            |--------------------------------------------------------------------------
            | Chart Kuis
            |--------------------------------------------------------------------------
            */
            const canvas = document.getElementById('chartKuis');
            const labelsElement = document.getElementById('chart-labels');
            const valuesElement = document.getElementById('chart-values');

            if (!canvas || !labelsElement || !valuesElement || !window.Chart) {
                return;
            }

            let labels = [];
            let dataNilai = [];

            try {
                labels = JSON.parse(labelsElement.textContent);
                dataNilai = JSON.parse(valuesElement.textContent);
            } catch (error) {
                labels = [];
                dataNilai = [];
            }

            const ctx = canvas.getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 340);
            gradient.addColorStop(0, 'rgba(59, 169, 245, 0.95)');
            gradient.addColorStop(0.55, 'rgba(112, 196, 247, 0.78)');
            gradient.addColorStop(1, 'rgba(179, 222, 250, 0.55)');

            new window.Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Nilai Rata-rata',
                            data: dataNilai,
                            backgroundColor: gradient,
                            borderColor: 'rgba(33, 150, 243, 1)',
                            borderWidth: 2,
                            borderRadius: 14,
                            borderSkipped: false,
                            barThickness: function (context) {
                                const width = context.chart.width;

                                if (width <= 380) {
                                    return 24;
                                }

                                if (width <= 576) {
                                    return 30;
                                }

                                if (width <= 768) {
                                    return 36;
                                }

                                return 42;
                            },
                            maxBarThickness: 56,
                            hoverBackgroundColor: 'rgba(93, 190, 248, 0.95)',
                            hoverBorderColor: 'rgba(25, 118, 210, 1)'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 850,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'end',
                            labels: {
                                color: '#3d3933',
                                boxWidth: 10,
                                boxHeight: 10,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: function (context) {
                                    const width = context.chart.width;

                                    return {
                                        size: width <= 576 ? 11 : 13,
                                        weight: 'bold'
                                    };
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: '#1f2937',
                            titleColor: '#ffffff',
                            bodyColor: '#eaf4ff',
                            padding: 14,
                            cornerRadius: 14,
                            displayColors: false,
                            callbacks: {
                                title: function (context) {
                                    return context[0].label;
                                },
                                label: function (context) {
                                    return 'Nilai rata-rata: ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.08)'
                            },
                            border: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.12)'
                            },
                            ticks: {
                                color: '#70685d',
                                maxRotation: 45,
                                minRotation: 0,
                                autoSkip: false,
                                font: function (context) {
                                    const width = context.chart.width;

                                    return {
                                        size: width <= 576 ? 10 : 13,
                                        weight: 'bold'
                                    };
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            max: 100,
                            border: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.12)'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.08)',
                                drawTicks: false
                            },
                            ticks: {
                                stepSize: 20,
                                color: '#70685d',
                                padding: 10,
                                font: function (context) {
                                    const width = context.chart.width;

                                    return {
                                        size: width <= 576 ? 10 : 13,
                                        weight: 'bold'
                                    };
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

@endsection