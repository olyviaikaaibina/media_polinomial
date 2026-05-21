@extends('layout.navbarguru')

@section('title', 'Progress Siswa')

@section('content')

@php
    $progressSiswa = $progressSiswa ?? collect();
    $aktivitasHariIni = $aktivitasHariIni ?? 0;
    $mingguIni = $mingguIni ?? 0;

    $jumlahData = $progressSiswa instanceof \Illuminate\Support\Collection
        ? $progressSiswa->count()
        : count($progressSiswa);
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
    | Burger Icon
    |--------------------------------------------------------------------------
    */
    .progress-mobile-header {
        display: none;
        width: 100%;
        margin-bottom: 18px;
    }

    .progress-burger-btn {
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

    .progress-burger-btn:hover {
        background: #f7faf4;
        transform: translateY(-1px);
    }

    .progress-burger-btn:active {
        transform: scale(0.97);
    }

    .progress-burger-icon {
        width: 30px;
        height: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .progress-burger-icon span {
        display: block;
        width: 100%;
        height: 4px;
        border-radius: 999px;
        background: #4b453d;
    }

    .progress-sidebar-overlay {
        position: fixed;
        inset: 0;
        display: none;
        background: rgba(47, 43, 37, 0.45);
        z-index: 1020;
    }

    .progress-sidebar-overlay.show {
        display: block;
    }

    /*
    |--------------------------------------------------------------------------
    | Paksa sidebar bawaan layout jadi drawer hijau di mobile
    |--------------------------------------------------------------------------
    */
    @media (max-width: 991.98px) {
        body.progress-sidebar-open {
            overflow: hidden;
        }

        body.progress-sidebar-open .progress-sidebar-overlay {
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

        body.progress-sidebar-open :is(
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

        body.progress-sidebar-open :is(
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

        body.progress-sidebar-open :is(
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
    | Page
    |--------------------------------------------------------------------------
    */
    .progress-page {
        min-height: 100vh;
        padding: 28px 36px 55px;
        background: transparent !important;
        color: #2f2b25;
        overflow-x: hidden;
    }

    .progress-content {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    /*
    |--------------------------------------------------------------------------
    | Header
    |--------------------------------------------------------------------------
    */
    .progress-header-card {
        margin-bottom: 24px;
        padding: 28px 30px;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid rgba(139, 115, 88, 0.18);
        box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 22px;
        flex-wrap: wrap;
    }

    .progress-header-left {
        flex: 1;
        min-width: 260px;
    }

    .progress-label {
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

    .page-title {
        margin: 0;
        color: #2f2b25;
        font-size: clamp(28px, 4vw, 42px);
        line-height: 1.1;
        font-weight: 950;
        letter-spacing: -1.2px;
    }

    .page-subtitle {
        margin: 10px 0 0;
        color: #675f52;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .summary-row {
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
    .table-wrapper-clean {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 4px;
    }

    .progress-table {
        width: 100%;
        min-width: 1020px;
        border-collapse: collapse;
        table-layout: auto;
        margin-bottom: 0;
    }

    .progress-table thead tr {
        background: #f7f9f4;
        border-bottom: 1px solid rgba(83, 105, 72, 0.12);
    }

    .progress-table thead th {
        color: #5f574e;
        font-size: 13px;
        font-weight: 900;
        border: 0;
        white-space: nowrap;
        vertical-align: middle;
        padding: 16px 14px;
    }

    .progress-table tbody tr {
        background: #ffffff;
        border-bottom: 1px solid rgba(83, 105, 72, 0.10);
    }

    .progress-table tbody tr:hover {
        background: #fbfbf7;
    }

    .progress-table tbody td {
        vertical-align: middle;
        color: #34312c;
        font-weight: 650;
        padding: 18px 14px;
        border: 0;
    }

    .col-no {
        width: 52px;
        text-align: center;
    }

    .col-nama {
        width: 150px;
    }

    .col-kelas {
        width: 80px;
    }

    .col-progress {
        width: 230px;
    }

    .col-kuis {
        width: 150px;
    }

    .col-evaluasi {
        width: 145px;
    }

    .col-aktivitas {
        width: 260px;
    }

    .col-status {
        width: 145px;
    }

    .student-name {
        color: #2f2b25;
        font-size: 15px;
        font-weight: 900;
        line-height: 1.35;
        word-break: break-word;
    }

    .class-text {
        color: #536948;
        font-size: 14px;
        font-weight: 900;
        white-space: nowrap;
    }

    .progress-mini {
        min-width: 0;
        max-width: 240px;
    }

    .progress-mini-text {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 7px;
        font-size: 13px;
        color: #70685d;
        font-weight: 750;
    }

    .progress {
        height: 8px;
        background: #e9ecef;
        border-radius: 999px;
        overflow: hidden;
    }

    .progress-bar {
        border-radius: 999px;
        background-color: #536948;
    }

    .plain-info {
        color: #4f6047;
        font-size: 13px;
        font-weight: 850;
        line-height: 1.45;
    }

    .plain-info.success {
        color: #1f7a4d;
    }

    .plain-info.warning {
        color: #a05b10;
    }

    .plain-info.muted {
        color: #70685d;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
    }

    .status-success {
        background: #dbf7e6;
        color: #1f7a4d;
    }

    .status-warning {
        background: #fff0d5;
        color: #a05b10;
    }

    .status-secondary {
        background: #eee7dc;
        color: #70685d;
    }

    .activity-text {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 0;
        max-width: 280px;
    }

    .activity-main {
        color: #2f2b25;
        font-size: 13px;
        font-weight: 850;
        line-height: 1.45;
        word-break: break-word;
    }

    .activity-time {
        color: #8a8172;
        font-size: 12px;
        font-weight: 750;
        white-space: nowrap;
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

    /*
    |--------------------------------------------------------------------------
    | Responsive Laptop Kecil
    |--------------------------------------------------------------------------
    */
    @media (max-width: 1199px) {
        .progress-page {
            padding: 26px 28px 50px;
        }

        .progress-content {
            max-width: 100%;
        }

        .progress-header-card,
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
        .progress-mobile-header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .progress-page {
            padding: 22px 22px 48px;
        }

        .progress-header-card {
            padding: 26px;
        }

        .progress-header {
            flex-direction: column;
            align-items: stretch;
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
    }

    /*
    |--------------------------------------------------------------------------
    | Responsive HP Besar
    |--------------------------------------------------------------------------
    */
    @media (max-width: 768px) {
        .progress-page {
            padding: 18px 16px 44px;
        }

        .progress-mobile-header {
            margin-bottom: 16px;
        }

        .progress-burger-btn {
            width: 66px;
            height: 66px;
            border-radius: 20px;
        }

        .progress-header-card {
            padding: 22px;
            border-radius: 20px;
        }

        .page-title {
            font-size: 32px;
        }

        .page-subtitle {
            font-size: 14px;
        }

        .summary-badge {
            width: 100%;
            justify-content: flex-start;
        }

        .modern-card {
            border-radius: 20px;
        }

        .section-header-modern {
            padding: 20px;
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

        .progress-table {
            min-width: 980px;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Responsive HP Kecil
    |--------------------------------------------------------------------------
    */
    @media (max-width: 576px) {
        .progress-page {
            padding: 14px 12px 38px;
        }

        .progress-burger-btn {
            width: 66px;
            height: 66px;
            border-radius: 20px;
            border-width: 3px;
        }

        .progress-header-card {
            padding: 18px;
            border-radius: 18px;
        }

        .progress-label {
            font-size: 10.5px;
            padding: 7px 11px;
        }

        .page-title {
            font-size: 27px;
            line-height: 1.15;
        }

        .page-subtitle {
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

        .progress-table {
            min-width: 920px;
        }

        .progress-table thead th,
        .progress-table tbody td {
            font-size: 12.5px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .student-name {
            font-size: 14px;
        }

        .status-pill {
            font-size: 11px;
            padding: 7px 10px;
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
        .progress-page {
            padding: 12px 10px 34px;
        }

        .progress-burger-btn {
            width: 62px;
            height: 62px;
            border-radius: 19px;
        }

        .progress-burger-icon {
            width: 28px;
            height: 22px;
        }

        .progress-burger-icon span {
            height: 4px;
        }

        .progress-header-card {
            padding: 16px;
        }

        .page-title {
            font-size: 24px;
        }

        .section-header-modern {
            padding: 16px;
        }

        .modern-card .card-body {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .progress-table {
            min-width: 880px;
        }
    }
</style>

<div class="progress-sidebar-overlay" id="progressSidebarOverlay"></div>

<div class="progress-page">
    <div class="progress-content">

        {{-- BURGER ICON MOBILE --}}
        <div class="progress-mobile-header">
            <button type="button" class="progress-burger-btn" id="progressBurgerBtn" aria-label="Buka Sidebar">
                <span class="progress-burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>

        {{-- ===================== HEADER ===================== --}}
        <div class="progress-header-card">
            <div class="progress-header">

                <div class="progress-header-left">
                    <div class="progress-label">
                        <i class="bi bi-activity"></i>
                        Progress Siswa
                    </div>

                    <h4 class="page-title">Progress Siswa</h4>

                    <p class="page-subtitle">
                        Pantau perkembangan belajar siswa berdasarkan materi, kuis, evaluasi, dan aktivitas terakhir.
                    </p>

                    <div class="summary-row">
                        <span class="summary-badge">
                            <i class="bi bi-lightning-charge-fill"></i>
                            Aktivitas Hari Ini: {{ $aktivitasHariIni }}
                        </span>

                        <span class="summary-badge">
                            <i class="bi bi-clock-history"></i>
                            Minggu Ini: {{ $mingguIni }}
                        </span>

                        <span class="summary-badge">
                            <i class="bi bi-people-fill"></i>
                            Total Siswa: {{ $jumlahData }}
                        </span>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===================== TABEL PROGRESS SISWA ===================== --}}
        <div class="card modern-card mb-4">
            <div class="section-header-modern">

                <div class="section-header-left">
                    <div class="section-icon-box">
                        <i class="bi bi-activity"></i>
                    </div>

                    <div>
                        <h5 class="section-title-modern">Tabel Progress Siswa</h5>
                        <p class="section-subtitle-modern">
                            Berisi progress materi, kuis yang lulus KKM, evaluasi, aktivitas terakhir, dan status siswa.
                        </p>
                    </div>
                </div>

                <div class="section-actions-inline">
                    <span class="section-badge-soft">
                        <i class="bi bi-clipboard-data"></i>
                        Total Data: {{ $jumlahData }}
                    </span>

                    <div class="input-group input-group-sm modern-search">
                        <span class="input-group-text">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            id="searchSiswa"
                            class="form-control"
                            placeholder="Cari nama siswa / kelas">

                        <button class="btn btn-outline-secondary btn-sm" type="button">
                            Cari
                        </button>
                    </div>
                </div>

            </div>

            <div class="card-body px-4 pb-4">
                <div class="table-wrapper-clean">
                    <table class="table progress-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-nama">Nama Siswa</th>
                                <th class="col-kelas">Kelas</th>
                                <th class="col-progress">Progress Materi</th>
                                <th class="col-kuis">Kuis</th>
                                <th class="col-evaluasi">Evaluasi</th>
                                <th class="col-aktivitas">Aktivitas Terakhir</th>
                                <th class="col-status">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($progressSiswa as $index => $item)
                                <tr class="progress-row">
                                    <td class="col-no">
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        <div class="student-name nama-siswa">
                                            {{ $item->nama }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="class-text kelas-siswa">
                                            {{ $item->kelas ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-mini-text">
                                                <span>
                                                    {{ $item->materi_selesai }} dari {{ $item->total_materi }} materi
                                                </span>

                                                <strong>{{ $item->progress_materi }}%</strong>
                                            </div>

                                            <div class="progress">
                                                <div
                                                    class="progress-bar js-progress-bar"
                                                    data-value="{{ $item->progress_materi }}">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="plain-info">
                                            {{ $item->kuis_lulus_kkm ?? $item->kuis_dikerjakan }}
                                            dari
                                            {{ $item->total_kuis }}
                                            kuis lulus KKM
                                        </div>
                                    </td>

                                    <td>
                                        @if ($item->evaluasi_status === 'Sudah')
                                            <div class="plain-info success">
                                                Sudah
                                                @if ($item->nilai_evaluasi !== null)
                                                    | Nilai {{ $item->nilai_evaluasi }}
                                                @endif
                                            </div>
                                        @elseif ($item->evaluasi_status === 'Belum Lulus')
                                            <div class="plain-info warning">
                                                Belum Lulus
                                                @if ($item->nilai_evaluasi !== null)
                                                    | Nilai {{ $item->nilai_evaluasi }}
                                                @endif
                                            </div>
                                        @else
                                            <div class="plain-info muted">
                                                Belum
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="activity-text">
                                            <span class="activity-main">
                                                {{ $item->aktivitas_terakhir }}
                                            </span>

                                            <span class="activity-time">
                                                {{ $item->aktivitas_terakhir_waktu }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($item->status === 'Selesai')
                                            <span class="status-pill status-success">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                Selesai
                                            </span>
                                        @elseif ($item->status === 'Sedang belajar')
                                            <span class="status-pill status-warning">
                                                <i class="bi bi-hourglass-split me-1"></i>
                                                Sedang belajar
                                            </span>
                                        @else
                                            <span class="status-pill status-secondary">
                                                <i class="bi bi-dash-circle-fill me-1"></i>
                                                Belum mulai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center bg-white">
                                        <div class="empty-state-box">
                                            <div class="empty-icon-box">
                                                <i class="bi bi-activity"></i>
                                            </div>

                                            <h6 class="fw-bold mb-1">Belum ada progress siswa</h6>

                                            <p class="text-muted small mb-0" style="max-width: 420px; margin: 0 auto;">
                                                Progress siswa akan muncul setelah siswa mulai membuka materi atau mengerjakan kuis.
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        /*
        |--------------------------------------------------------------------------
        | Burger Icon Untuk Buka Sidebar
        |--------------------------------------------------------------------------
        */
        const burgerBtn = document.getElementById('progressBurgerBtn');
        const sidebarOverlay = document.getElementById('progressSidebarOverlay');

        function openProgressSidebar() {
            document.body.classList.add('progress-sidebar-open');

            /*
            | Ini juga membuka sidebar bawaan layout.navbarguru
            | jika layout memakai class sidebar-open.
            */
            document.body.classList.add('sidebar-open');

            if (sidebarOverlay) {
                sidebarOverlay.classList.add('show');
            }
        }

        function closeProgressSidebar() {
            document.body.classList.remove('progress-sidebar-open');
            document.body.classList.remove('sidebar-open');

            if (sidebarOverlay) {
                sidebarOverlay.classList.remove('show');
            }
        }

        if (burgerBtn) {
            burgerBtn.addEventListener('click', function () {
                openProgressSidebar();
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function () {
                closeProgressSidebar();
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeProgressSidebar();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 991.98) {
                closeProgressSidebar();
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
        | Search Nama / Kelas
        |--------------------------------------------------------------------------
        */
        const searchInput = document.getElementById('searchSiswa');

        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                const keyword = this.value.toLowerCase();
                const rows = document.querySelectorAll('.progress-row');

                rows.forEach(function (row) {
                    const namaElement = row.querySelector('.nama-siswa');
                    const kelasElement = row.querySelector('.kelas-siswa');

                    const nama = namaElement ? namaElement.textContent.toLowerCase() : '';
                    const kelas = kelasElement ? kelasElement.textContent.toLowerCase() : '';

                    row.style.display = nama.includes(keyword) || kelas.includes(keyword) ? '' : 'none';
                });
            });
        }
    });
</script>

@endsection