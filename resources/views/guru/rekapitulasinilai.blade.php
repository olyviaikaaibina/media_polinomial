@extends('layout.navbarguru')

@section('title', 'Rekapitulasi Nilai')

@section('content')

    @php
        $quizzes = $quizzes ?? collect();
        $rekapNilai = $rekapNilai ?? collect();
        $siswaDinilai = $siswaDinilai ?? 0;
        $rataRataNilai = $rataRataNilai ?? 0;
        $chartLabels = $chartLabels ?? [];
        $chartData = $chartData ?? [];
        $progressData = $progressData ?? [];

        $jumlahRekap = $rekapNilai instanceof \Illuminate\Support\Collection
            ? $rekapNilai->count()
            : count($rekapNilai);

        $jumlahKuis = $quizzes instanceof \Illuminate\Support\Collection
            ? $quizzes->count()
            : count($quizzes);
    @endphp

    <style>
        /*
        |--------------------------------------------------------------------------
        | Reset
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
        | Burger Icon seperti gambar
        |--------------------------------------------------------------------------
        */
        .rekap-mobile-header {
            display: none;
            width: 100%;
            margin-bottom: 18px;
        }

        .rekap-burger-btn {
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
            font-size: 0;
        }

        .rekap-burger-btn:hover {
            background: #f7faf4;
            transform: translateY(-1px);
        }

        .rekap-burger-btn:active {
            transform: scale(0.97);
        }

        .rekap-burger-icon {
            width: 30px;
            height: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .rekap-burger-icon span {
            display: block;
            width: 100%;
            height: 4px;
            border-radius: 999px;
            background: #4b453d;
        }

        .rekap-sidebar-overlay {
            position: fixed;
            inset: 0;
            display: none;
            background: rgba(47, 43, 37, 0.45);
            z-index: 1020;
        }

        .rekap-sidebar-overlay.show {
            display: block;
        }

        /*
        |--------------------------------------------------------------------------
        | Paksa sidebar bawaan layout jadi drawer hijau saat mobile
        |--------------------------------------------------------------------------
        */
        @media (max-width: 991.98px) {
            body.rekap-sidebar-open {
                overflow: hidden;
            }

            body.rekap-sidebar-open .rekap-sidebar-overlay {
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
                width: 260px !important;
                max-width: 84vw !important;
                height: 100vh !important;
                min-height: 100vh !important;
                overflow-y: auto !important;
                background: #94A889 !important;
                background-color: #94A889 !important;
                z-index: 1025 !important;
                transform: translateX(-110%) !important;
                transition: transform 0.25s ease !important;
                box-shadow: 18px 0 40px rgba(47, 43, 37, 0.22) !important;
                border-right: none !important;
            }

            body.rekap-sidebar-open :is(
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

            body.rekap-sidebar-open :is(
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

            body.rekap-sidebar-open :is(
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
        }

        /*
        |--------------------------------------------------------------------------
        | Page Wrapper
        |--------------------------------------------------------------------------
        */
        .rekap-page {
            min-height: 100vh;
            padding: 28px 36px 55px;
            background: transparent !important;
            color: #2f2b25;
            overflow-x: hidden;
        }

        .rekap-content {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header Page
        |--------------------------------------------------------------------------
        */
        .rekap-header-card {
            margin-bottom: 24px;
            padding: 28px 30px;
            border-radius: 26px;
            background: #ffffff;
            border: 1px solid rgba(139, 115, 88, 0.18);
            box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
        }

        .rekap-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 22px;
            flex-wrap: wrap;
        }

        .rekap-header-left {
            flex: 1;
            min-width: 260px;
        }

        .rekap-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            padding: 8px 14px;
            border-radius: 999px;
            color: #536948;
            background: #edf4e8;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.7px;
            text-transform: uppercase;
        }

        .rekap-title {
            margin: 0;
            color: #2f2b25;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.1;
            font-weight: 950;
            letter-spacing: -1.2px;
        }

        .rekap-subtitle {
            margin: 10px 0 0;
            color: #675f52;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 600;
        }

        .rekap-summary-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .summary-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 999px;
            background: #edf4e8;
            color: #4f6047;
            font-size: 13px;
            font-weight: 850;
            border: 1px solid rgba(83, 105, 72, 0.16);
            white-space: nowrap;
        }

        .rekap-header-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .export-button {
            border: 0;
            background: #6b7280;
            color: #ffffff;
            font-weight: 800;
            box-shadow: 0 8px 18px rgba(55, 65, 81, 0.18);
            min-height: 42px;
            white-space: nowrap;
        }

        .export-button:hover {
            background: #4b5563;
            color: #ffffff;
        }

        .export-note {
            color: #70685d;
            font-size: 12.5px;
            font-weight: 600;
        }

        /*
        |--------------------------------------------------------------------------
        | Card Modern
        |--------------------------------------------------------------------------
        */
        .modern-card {
            border: 0;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 16px 35px rgba(83, 68, 47, 0.08);
            overflow: hidden;
        }

        .section-header-modern {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            padding: 24px 26px 16px;
            background: linear-gradient(135deg, #ffffff, #fbfbf4);
        }

        .section-header-left {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            min-width: 0;
        }

        .section-icon-box {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #edf4e8, #fff1d5);
            color: #536948;
            font-size: 24px;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(83, 105, 72, 0.12);
        }

        .section-title-modern {
            margin: 0;
            color: #2f2b25;
            font-size: 22px;
            font-weight: 950;
            letter-spacing: -0.4px;
        }

        .section-subtitle-modern {
            margin: 5px 0 0;
            color: #70685d;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 600;
        }

        .section-actions-inline {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
            flex-wrap: nowrap;
        }

        .section-badge-soft {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 16px;
            border-radius: 999px;
            background: #edf4e8;
            color: #536948;
            font-size: 13px;
            font-weight: 850;
            white-space: nowrap;
            min-height: 42px;
        }

        .modern-search {
            width: 300px;
            border-radius: 999px;
            overflow: hidden;
            background: #f7f8f5;
            border: 1px solid rgba(83, 105, 72, 0.16);
            flex-shrink: 0;
        }

        .modern-search .input-group-text,
        .modern-search .form-control {
            background: transparent;
            border: 0;
        }

        .modern-search .form-control:focus {
            box-shadow: none;
        }

        .modern-search .btn {
            border-radius: 999px;
            margin: 4px;
            padding-left: 16px;
            padding-right: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Table
        |--------------------------------------------------------------------------
        */
        .rekap-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-modern {
            width: 100%;
            min-width: 1050px;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-bottom: 0;
        }

        .table-modern thead tr {
            background: #f7f9f4;
        }

        .table-modern thead th {
            color: #5f574e;
            font-size: 13px;
            font-weight: 900;
            border: 0;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table-modern tbody tr {
            background: #ffffff;
            box-shadow: 0 8px 18px rgba(83, 68, 47, 0.05);
        }

        .table-modern tbody td {
            border-top: 1px solid rgba(83, 105, 72, 0.08);
            border-bottom: 1px solid rgba(83, 105, 72, 0.08);
            vertical-align: middle;
            color: #34312c;
            font-weight: 650;
            white-space: nowrap;
        }

        .table-modern tbody td:first-child {
            border-left: 1px solid rgba(83, 105, 72, 0.08);
            border-radius: 14px 0 0 14px;
        }

        .table-modern tbody td:last-child {
            border-right: 1px solid rgba(83, 105, 72, 0.08);
            border-radius: 0 14px 14px 0;
        }

        .student-name-cell {
            color: #2f2b25;
            font-weight: 900;
        }

        .kelas-badge {
            background: #f6f1e9 !important;
            color: #3d3933 !important;
            font-weight: 850;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 850;
            white-space: nowrap;
        }

        .status-pass {
            background: #dbf7e6;
            color: #1f7a4d;
        }

        .status-learning {
            background: #fff0d5;
            color: #a05b10;
        }

        .status-fail {
            background: #eee7dc;
            color: #70685d;
        }

        .empty-state-box {
            padding: 48px 0;
            text-align: center;
        }

        .empty-icon-box {
            width: 82px;
            height: 82px;
            margin: 0 auto 14px;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf4e8;
            color: #536948;
            font-size: 34px;
        }

        .table-footer-modern {
            background: #ffffff;
            border: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 16px 24px 20px;
        }

        /*
        |--------------------------------------------------------------------------
        | Chart dan Progress
        |--------------------------------------------------------------------------
        */
        .chart-progress-row {
            align-items: flex-start;
        }

        .chart-box {
            padding: 18px;
            border-radius: 18px;
            background: #fbfbf7;
            border: 1px solid rgba(83, 105, 72, 0.10);
            height: 100%;
        }

        .chart-wrapper {
            position: relative;
            width: 100%;
            height: 285px;
        }

        .chart-wrapper canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .progress-panel {
            margin-top: 0;
        }

        .progress-panel-title {
            margin: 0 0 12px;
            color: #2f2b25;
            font-size: 18px;
            font-weight: 950;
        }

        .progress-list {
            max-height: 360px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .progress-item-modern {
            padding: 12px 14px;
            margin-bottom: 10px;
            border-radius: 18px;
            background: #fbfbf7;
            border: 1px solid rgba(83, 105, 72, 0.10);
        }

        .progress-title {
            color: #2f2b25;
            font-size: 14px;
            font-weight: 900;
        }

        .progress-desc {
            color: #70685d;
            font-size: 13px;
            font-weight: 650;
            line-height: 1.4;
        }

        .progress-percent-badge {
            background: #ffffff;
            color: #2f2b25;
            border: 1px solid rgba(83, 105, 72, 0.10);
            font-weight: 850;
        }

        .progress {
            background: #e9ecef;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 999px;
            background-color: #536948;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive Laptop Kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 1199px) {
            .rekap-page {
                padding: 26px 28px 50px;
            }

            .rekap-content {
                max-width: 100%;
            }

            .rekap-header-card,
            .modern-card {
                border-radius: 22px;
            }

            .section-actions-inline {
                flex-wrap: wrap;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive Tablet
        |--------------------------------------------------------------------------
        */
        @media (max-width: 992px) {
            .rekap-mobile-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }

            .rekap-page {
                padding: 22px 22px 48px;
            }

            .rekap-header-card {
                padding: 26px;
            }

            .rekap-header {
                flex-direction: column;
                align-items: stretch;
            }

            .rekap-header-actions {
                align-items: flex-start;
            }

            .section-header-modern {
                flex-direction: column;
                align-items: stretch;
                padding: 22px;
            }

            .section-actions-inline {
                justify-content: flex-start;
                flex-wrap: wrap;
                width: 100%;
            }

            .modern-search {
                width: 100%;
            }

            .progress-list {
                max-height: none;
                overflow-y: visible;
            }

            .chart-wrapper {
                height: 300px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive HP Besar
        |--------------------------------------------------------------------------
        */
        @media (max-width: 768px) {
            .rekap-page {
                padding: 18px 16px 44px;
            }

            .rekap-mobile-header {
                margin-bottom: 16px;
            }

            .rekap-burger-btn {
                width: 66px;
                height: 66px;
                border-radius: 20px;
            }

            .rekap-header-card {
                padding: 22px;
                border-radius: 20px;
            }

            .rekap-title {
                font-size: 32px;
            }

            .rekap-subtitle {
                font-size: 14px;
            }

            .summary-badge {
                width: 100%;
                justify-content: flex-start;
            }

            .rekap-header-actions,
            .rekap-header-actions .dropdown,
            .rekap-header-actions .export-button {
                width: 100%;
            }

            .export-button {
                justify-content: center;
            }

            .modern-card {
                border-radius: 20px;
            }

            .section-header-modern {
                padding: 20px;
            }

            .section-header-left {
                gap: 12px;
            }

            .section-title-modern {
                font-size: 19px;
            }

            .section-subtitle-modern {
                font-size: 13.5px;
            }

            .section-actions-inline {
                width: 100%;
            }

            .section-badge-soft {
                width: 100%;
            }

            .modern-card .card-body {
                padding-left: 18px !important;
                padding-right: 18px !important;
            }

            .table-modern {
                min-width: 980px;
            }

            .chart-wrapper {
                height: 275px;
            }

            .table-footer-modern {
                flex-direction: column;
                align-items: flex-start;
                padding: 16px 18px 18px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive HP Kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 576px) {
            .rekap-page {
                padding: 14px 12px 38px;
            }

            .rekap-burger-btn {
                width: 66px;
                height: 66px;
                border-radius: 20px;
                border-width: 3px;
            }

            .rekap-header-card {
                padding: 18px;
                border-radius: 18px;
            }

            .rekap-label {
                font-size: 10.5px;
                padding: 7px 11px;
            }

            .rekap-title {
                font-size: 27px;
                line-height: 1.15;
            }

            .rekap-subtitle {
                font-size: 13.5px;
            }

            .summary-badge {
                font-size: 12px;
                padding: 9px 12px;
            }

            .modern-card {
                border-radius: 18px;
            }

            .section-header-modern {
                padding: 18px;
            }

            .section-header-left {
                flex-direction: column;
            }

            .section-icon-box {
                width: 46px;
                height: 46px;
                border-radius: 16px;
                font-size: 21px;
            }

            .section-title-modern {
                font-size: 18px;
            }

            .section-subtitle-modern {
                font-size: 13px;
            }

            .modern-card .card-body {
                padding-left: 14px !important;
                padding-right: 14px !important;
            }

            .modern-search {
                border-radius: 18px;
            }

            .modern-search .btn {
                padding-left: 12px;
                padding-right: 12px;
            }

            .table-modern {
                min-width: 920px;
                border-spacing: 0 8px;
            }

            .table-modern thead th,
            .table-modern tbody td {
                font-size: 12.5px;
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .status-pill {
                font-size: 11px;
                padding: 7px 10px;
            }

            .chart-box {
                padding: 14px;
                border-radius: 16px;
            }

            .chart-wrapper {
                height: 250px;
            }

            .progress-panel-title {
                font-size: 16px;
            }

            .progress-item-modern {
                padding: 11px 12px;
                border-radius: 16px;
            }

            .empty-state-box {
                padding: 36px 10px;
            }

            .empty-icon-box {
                width: 64px;
                height: 64px;
                border-radius: 22px;
                font-size: 28px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive HP Sangat Kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 380px) {
            .rekap-page {
                padding: 12px 10px 34px;
            }

            .rekap-burger-btn {
                width: 62px;
                height: 62px;
                border-radius: 19px;
            }

            .rekap-burger-icon {
                width: 28px;
                height: 22px;
            }

            .rekap-burger-icon span {
                height: 4px;
            }

            .rekap-header-card {
                padding: 16px;
            }

            .rekap-title {
                font-size: 24px;
            }

            .section-header-modern {
                padding: 16px;
            }

            .modern-card .card-body {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .table-modern {
                min-width: 880px;
            }

            .chart-wrapper {
                height: 230px;
            }
        }
    </style>

    <div class="rekap-sidebar-overlay" id="rekapSidebarOverlay"></div>

    <div class="rekap-page">
        <div class="rekap-content">

            {{-- BURGER ICON MOBILE --}}
            <div class="rekap-mobile-header">
                <button type="button" class="rekap-burger-btn" id="rekapBurgerBtn" aria-label="Buka Sidebar">
                    <span class="rekap-burger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            {{-- HEADER --}}
            <div class="rekap-header-card">
                <div class="rekap-header">

                    <div class="rekap-header-left">
                        <div class="rekap-label">
                            <i class="bi bi-clipboard-data"></i>
                            Rekapitulasi Nilai
                        </div>

                        <h4 class="rekap-title">Rekapitulasi Nilai</h4>

                        <p class="rekap-subtitle">
                            Lihat rangkuman nilai siswa berdasarkan kuis dan evaluasi.
                        </p>

                        <div class="rekap-summary-row">
                            <span class="summary-badge">
                                <i class="bi bi-people-fill"></i>
                                Siswa Dinilai: {{ $siswaDinilai }}
                            </span>

                            <span class="summary-badge">
                                <i class="bi bi-star-fill"></i>
                                Rata-rata Nilai: {{ $rataRataNilai }}
                            </span>
                        </div>
                    </div>

                    <div class="rekap-header-actions">
                        <div class="dropdown">
                            <button class="btn btn-sm rounded-pill px-4 dropdown-toggle export-button" type="button"
                                id="dropdownExport" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-download me-1"></i> Export
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownExport">
                                <li>
                                    <a class="dropdown-item fw-semibold text-danger"
                                        href="{{ route('rekapnilai.export.pdf') }}">
                                        <i class="bi bi-file-earmark-pdf me-2"></i>
                                        Export as PDF
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item fw-semibold text-success"
                                        href="{{ route('rekapnilai.export.excel') }}">
                                        <i class="bi bi-file-earmark-excel me-2"></i>
                                        Export as Excel
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <small class="export-note">
                            <i class="bi bi-info-circle me-1"></i>
                            Gunakan export untuk arsip nilai.
                        </small>
                    </div>

                </div>
            </div>

            {{-- TABLE CARD --}}
            <div class="card modern-card mb-4">
                <div class="section-header-modern">

                    <div class="section-header-left">
                        <div class="section-icon-box">
                            <i class="bi bi-table"></i>
                        </div>

                        <div>
                            <h5 class="section-title-modern">Rekap Nilai Siswa</h5>
                            <p class="section-subtitle-modern">
                                Ringkasan nilai kuis dan evaluasi siswa pada setiap sub-bab.
                            </p>
                        </div>
                    </div>

                    <div class="section-actions-inline">
                        <span class="section-badge-soft">
                            <i class="bi bi-clipboard-data"></i>
                            Total Data: {{ $jumlahRekap }}
                        </span>

                        <div class="input-group input-group-sm modern-search">
                            <span class="input-group-text">
                                <i class="bi bi-search text-muted"></i>
                            </span>

                            <input type="text" id="searchSiswa" class="form-control" placeholder="Cari nama siswa">

                            <button class="btn btn-outline-secondary btn-sm" type="button">
                                Cari
                            </button>
                        </div>
                    </div>

                </div>

                <div class="card-body px-4 pb-4">
                    <div class="rekap-table-wrapper">
                        <table class="table table-modern align-middle text-center">
                            <thead>
                                <tr>
                                    <th class="py-3 px-3 rounded-start align-middle" rowspan="2">No</th>
                                    <th class="py-3 align-middle text-start" rowspan="2">Nama Siswa</th>
                                    <th class="py-3 align-middle" rowspan="2">Kelas</th>
                                    <th class="py-3 align-middle" colspan="5">Nilai Kuis per Sub-bab</th>
                                    <th class="py-3 align-middle" rowspan="2">Nilai Evaluasi</th>
                                    <th class="py-3 px-3 rounded-end align-middle" rowspan="2">Status</th>
                                </tr>

                                <tr>
                                    <th class="py-2 small">Kuis A</th>
                                    <th class="py-2 small">Kuis B</th>
                                    <th class="py-2 small">Kuis C</th>
                                    <th class="py-2 small">Kuis D</th>
                                    <th class="py-2 small">Kuis E</th>
                                </tr>
                            </thead>

                            <tbody id="rekapTableBody">
                                @forelse ($rekapNilai as $index => $siswa)
                                    <tr class="rekap-row">
                                        <td class="px-3">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="text-start nama-siswa student-name-cell">
                                            {{ $siswa->nama ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge rounded-pill kelas-badge">
                                                {{ $siswa->kelas ?? '-' }}
                                            </span>
                                        </td>

                                        @foreach ($quizzes as $quiz)
                                            <td>
                                                {{ $siswa->nilai_kuis[$quiz->id] ?? '-' }}
                                            </td>
                                        @endforeach

                                        @for ($i = $jumlahKuis; $i < 5; $i++)
                                            <td>-</td>
                                        @endfor

                                        <td class="fw-bold">
                                            {{ $siswa->nilai_evaluasi ?? '-' }}
                                        </td>

                                        <td>
                                            @if (($siswa->status ?? '') == 'Selesai')
                                                <span class="status-pill status-pass">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    Selesai
                                                </span>
                                            @elseif (($siswa->status ?? '') == 'Sedang belajar')
                                                <span class="status-pill status-learning">
                                                    <i class="bi bi-hourglass-split me-1"></i>
                                                    Sedang belajar
                                                </span>
                                            @else
                                                <span class="status-pill status-fail">
                                                    <i class="bi bi-dash-circle-fill me-1"></i>
                                                    Belum mulai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center" style="background: #ffffff;">
                                            <div class="empty-state-box">
                                                <div class="empty-icon-box">
                                                    <i class="bi bi-clipboard-data"></i>
                                                </div>

                                                <h6 class="fw-bold mb-1">Belum ada rekap nilai</h6>

                                                <p class="text-muted small mb-0" style="max-width: 420px; margin: 0 auto;">
                                                    Data rekapitulasi nilai akan muncul di sini setelah siswa mengerjakan kuis.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer table-footer-modern">
                    <small class="text-muted">
                        Menampilkan {{ $jumlahRekap }} dari {{ $jumlahRekap }} data
                    </small>

                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">Prev</a>
                            </li>

                            <li class="page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>

                            <li class="page-item disabled">
                                <a href="#" class="page-link">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            {{-- CHART CARD --}}
            <div class="card modern-card mb-5">
                <div class="section-header-modern">

                    <div class="section-header-left">
                        <div class="section-icon-box">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>

                        <div>
                            <h5 class="section-title-modern">Rata-rata Nilai & Progres Kuis</h5>
                            <p class="section-subtitle-modern">
                                Visualisasi performa siswa dan jumlah siswa yang sudah mengerjakan kuis.
                            </p>
                        </div>
                    </div>

                    <span class="section-badge-soft">
                        <i class="bi bi-graph-up-arrow"></i>
                        Skala Nilai 0 - 100
                    </span>

                </div>

                <div class="card-body px-4 pb-4">
                    <div class="row g-4 chart-progress-row">

                        <div class="col-lg-8">
                            <div class="chart-box">
                                <p class="text-muted small mb-2">
                                    Diagram batang rata-rata nilai kuis per sub-bab.
                                </p>

                                <div class="chart-wrapper">
                                    <canvas id="subbabChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 progress-panel">
                            <h6 class="progress-panel-title">Progres Siswa Mengikuti Kuis</h6>

                            <div class="progress-list">
                                @forelse ($progressData as $progress)
                                    <div class="progress-item-modern">
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                            <div>
                                                <div class="progress-title">
                                                    {{ $progress['label'] ?? '-' }}
                                                </div>

                                                <div class="progress-desc">
                                                    {{ $progress['jumlah_ikut'] ?? 0 }}
                                                    dari
                                                    {{ $progress['total_siswa'] ?? 0 }}
                                                    siswa sudah mengerjakan
                                                </div>
                                            </div>

                                            <span class="badge rounded-pill progress-percent-badge">
                                                {{ $progress['persen'] ?? 0 }}%
                                            </span>
                                        </div>

                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar js-progress-bar"
                                                data-value="{{ $progress['persen'] ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small mb-0">
                                        Belum ada data progres kuis.
                                    </p>
                                @endforelse
                            </div>

                            <p class="small text-muted mt-3 mb-0">
                                *Angka menunjukkan jumlah siswa yang sudah mengerjakan kuis.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="application/json" id="chart-labels">
        {!! json_encode($chartLabels) !!}
    </script>

    <script type="application/json" id="chart-data">
        {!! json_encode($chartData) !!}
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /*
            |--------------------------------------------------------------------------
            | Burger Icon Untuk Buka Sidebar
            |--------------------------------------------------------------------------
            */
            const burgerBtn = document.getElementById('rekapBurgerBtn');
            const sidebarOverlay = document.getElementById('rekapSidebarOverlay');

            function openRekapSidebar() {
                document.body.classList.add('rekap-sidebar-open');

                /*
                | Ini juga membuka sidebar bawaan layout.navbarguru
                | jika layout memakai class sidebar-open.
                */
                document.body.classList.add('sidebar-open');

                if (sidebarOverlay) {
                    sidebarOverlay.classList.add('show');
                }
            }

            function closeRekapSidebar() {
                document.body.classList.remove('rekap-sidebar-open');
                document.body.classList.remove('sidebar-open');

                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('show');
                }
            }

            if (burgerBtn) {
                burgerBtn.addEventListener('click', function () {
                    openRekapSidebar();
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function () {
                    closeRekapSidebar();
                });
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeRekapSidebar();
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 991.98) {
                    closeRekapSidebar();
                }
            });

            /*
            |--------------------------------------------------------------------------
            | Progress Bar
            |--------------------------------------------------------------------------
            */
            const progressBars = document.querySelectorAll('.js-progress-bar');

            progressBars.forEach(function (bar) {
                const value = Number(bar.getAttribute('data-value')) || 0;
                bar.style.width = value + '%';
            });

            /*
            |--------------------------------------------------------------------------
            | Chart Rata-rata Nilai
            |--------------------------------------------------------------------------
            */
            const labelsElement = document.getElementById('chart-labels');
            const dataElement = document.getElementById('chart-data');

            let subbabLabels = [];
            let subbabAverage = [];

            try {
                subbabLabels = JSON.parse(labelsElement.textContent);
                subbabAverage = JSON.parse(dataElement.textContent);
            } catch (error) {
                subbabLabels = [];
                subbabAverage = [];
            }

            const canvas = document.getElementById('subbabChart');

            if (canvas && window.Chart) {
                const ctx = canvas.getContext('2d');

                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(59, 169, 245, 0.95)');
                gradient.addColorStop(0.55, 'rgba(112, 196, 247, 0.78)');
                gradient.addColorStop(1, 'rgba(179, 222, 250, 0.55)');

                new window.Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: subbabLabels,
                        datasets: [{
                            label: 'Rata-rata nilai',
                            data: subbabAverage,
                            backgroundColor: gradient,
                            borderColor: 'rgba(33, 150, 243, 1)',
                            borderWidth: 2,
                            borderRadius: 12,
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
                            maxBarThickness: 56
                        }]
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
                                        return 'Rata-rata nilai: ' + context.raw;
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
                                },
                                title: {
                                    display: true,
                                    text: 'Nilai (skala 100)',
                                    color: '#70685d',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    }
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Search Nama Siswa
            |--------------------------------------------------------------------------
            */
            const searchInput = document.getElementById('searchSiswa');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const keyword = this.value.toLowerCase();
                    const rows = document.querySelectorAll('.rekap-row');

                    rows.forEach(function (row) {
                        const namaElement = row.querySelector('.nama-siswa');
                        const nama = namaElement ? namaElement.textContent.toLowerCase() : '';

                        row.style.display = nama.includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>

@endsection