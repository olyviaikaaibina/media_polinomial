@extends('layout.navbarguru')

@section('title', 'Daftar Siswa')

@section('content')

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
        | Tombol Burger Mobile
        |--------------------------------------------------------------------------
        */
        .page-mobile-header {
            display: none;
            width: 100%;
            margin-bottom: 18px;
        }

        .page-burger-btn {
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

        .page-burger-btn:hover {
            background: #f7faf4;
            transform: translateY(-1px);
        }

        .page-burger-btn i {
            font-size: 34px;
            line-height: 1;
        }

        .page-sidebar-overlay {
            position: fixed;
            inset: 0;
            display: none;
            background: rgba(47, 43, 37, 0.45);
            z-index: 998;
        }

        .page-sidebar-overlay.show {
            display: block;
        }

        /*
        |--------------------------------------------------------------------------
        | Sidebar Existing dari layout.navbarguru
        |--------------------------------------------------------------------------
        */
        @media (max-width: 992px) {
            body.sidebar-mobile-open {
                overflow: hidden;
            }

            body.sidebar-mobile-open .page-sidebar-overlay {
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
        | Halaman Daftar Siswa
        |--------------------------------------------------------------------------
        */
        .siswa-page {
            min-height: 100vh;
            padding: 28px 36px 55px;
            background: transparent !important;
            color: #2f2b25;
            overflow-x: hidden;
        }

        .siswa-content {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
        }

        .siswa-header-card {
            margin-bottom: 24px;
            padding: 28px 30px;
            border-radius: 26px;
            background: #ffffff;
            border: 1px solid rgba(139, 115, 88, 0.18);
            box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
        }

        .siswa-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
        }

        .siswa-title-wrap {
            min-width: 260px;
            flex: 1;
        }

        .siswa-label {
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

        .siswa-title {
            margin: 0;
            color: #2f2b25;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.1;
            font-weight: 950;
            letter-spacing: -1.2px;
        }

        .siswa-subtitle {
            margin: 10px 0 0;
            color: #675f52;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 600;
        }

        .siswa-actions {
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .kelas-filter {
            width: 220px;
            max-width: 100%;
            border-radius: 999px;
            font-weight: 600;
        }

        .btn-add {
            border-radius: 999px;
            padding: 10px 16px;
            font-weight: 700;
            white-space: nowrap;
        }

        .export-dropdown .btn {
            border-radius: 999px;
            padding: 10px 14px;
            font-weight: 700;
            width: auto;
            white-space: nowrap;
        }

        .export-dropdown .dropdown-menu {
            border-radius: 14px;
            padding: 6px;
        }

        .export-dropdown .dropdown-item {
            border-radius: 10px;
            padding: 10px 12px;
            font-weight: 600;
        }

        .siswa-table-card {
            border: 0;
            border-radius: 24px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
        }

        .siswa-table-card .card-body {
            padding: 24px;
        }

        .table-responsive-custom {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .siswa-table {
            width: 100%;
            min-width: 850px;
            margin-bottom: 0;
        }

        .siswa-table thead th {
            padding: 14px 12px;
            color: #786e61;
            background: #f6f1e9;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            white-space: nowrap;
            vertical-align: middle;
        }

        .siswa-table tbody td {
            padding: 15px 12px;
            color: #3d3933;
            font-size: 14px;
            font-weight: 600;
            vertical-align: middle;
            white-space: nowrap;
        }

        .siswa-name {
            color: #2f2b25;
            font-weight: 900;
        }

        .siswa-email {
            color: #5f574d;
            font-weight: 650;
        }

        .aksi-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .empty-data {
            padding: 28px 10px;
            text-align: center;
            color: #70685d;
            font-weight: 700;
        }

        .pagination {
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 18px;
            margin-bottom: 0;
        }

        .modal-content {
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(47, 43, 37, 0.22);
        }

        .modal-header {
            background: #f6f1e9;
            border-bottom: 1px solid rgba(139, 115, 88, 0.18);
        }

        .modal-title {
            color: #2f2b25;
            font-weight: 900;
        }

        .modal-footer {
            border-top: 1px solid rgba(139, 115, 88, 0.18);
        }

        /*
        |--------------------------------------------------------------------------
        | Laptop kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 1199px) {
            .siswa-page {
                padding: 26px 28px 50px;
            }

            .siswa-content {
                max-width: 100%;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Tablet
        |--------------------------------------------------------------------------
        */
        @media (max-width: 992px) {
            .page-mobile-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }

            .siswa-page {
                padding: 22px 22px 48px;
            }

            .siswa-header-card {
                padding: 26px;
                border-radius: 22px;
            }

            .siswa-header {
                flex-direction: column;
                align-items: stretch;
            }

            .siswa-actions {
                justify-content: flex-start;
            }

            .siswa-table-card {
                border-radius: 22px;
            }

            .siswa-table-card .card-body {
                padding: 20px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HP besar
        |--------------------------------------------------------------------------
        */
        @media (max-width: 768px) {
            .siswa-page {
                padding: 18px 16px 44px;
            }

            .page-mobile-header {
                margin-bottom: 16px;
            }

            .page-burger-btn {
                width: 66px;
                height: 66px;
                border-radius: 20px;
            }

            .page-burger-btn i {
                font-size: 34px;
            }

            .siswa-header-card {
                padding: 22px;
                border-radius: 20px;
            }

            .siswa-title {
                font-size: 32px;
            }

            .siswa-subtitle {
                font-size: 14px;
            }

            .filter-form {
                align-items: stretch;
                width: 100%;
            }

            .kelas-filter {
                width: 100%;
            }

            .filter-form .btn,
            .filter-form a {
                width: auto;
            }

            .siswa-actions {
                width: 100%;
                gap: 8px;
            }

            .export-dropdown,
            .export-dropdown .dropdown,
            .export-dropdown .btn {
                width: 100%;
            }

            .btn-add {
                width: 100%;
            }

            .siswa-table-card .card-body {
                padding: 18px;
            }

            .siswa-table {
                min-width: 820px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HP kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 576px) {
            .siswa-page {
                padding: 14px 12px 38px;
            }

            .page-burger-btn {
                width: 66px;
                height: 66px;
                border-radius: 20px;
                border-width: 3px;
            }

            .page-burger-btn i {
                font-size: 34px;
            }

            .siswa-header-card {
                padding: 18px;
                border-radius: 18px;
            }

            .siswa-label {
                font-size: 10.5px;
                padding: 7px 11px;
            }

            .siswa-title {
                font-size: 27px;
                line-height: 1.15;
            }

            .siswa-subtitle {
                font-size: 13.5px;
            }

            .filter-form .btn,
            .filter-form a {
                flex: 1;
            }

            .siswa-table-card {
                border-radius: 18px;
            }

            .siswa-table-card .card-body {
                padding: 14px;
            }

            .siswa-table {
                min-width: 780px;
            }

            .siswa-table thead th,
            .siswa-table tbody td {
                padding-left: 10px;
                padding-right: 10px;
                font-size: 13px;
            }

            .aksi-wrap .btn {
                padding: 5px 10px;
                font-size: 12px;
            }

            .modal-dialog {
                margin: 12px;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HP sangat kecil
        |--------------------------------------------------------------------------
        */
        @media (max-width: 380px) {
            .siswa-page {
                padding: 12px 10px 34px;
            }

            .page-burger-btn {
                width: 62px;
                height: 62px;
                border-radius: 19px;
            }

            .page-burger-btn i {
                font-size: 32px;
            }

            .siswa-header-card {
                padding: 16px;
            }

            .siswa-title {
                font-size: 24px;
            }

            .siswa-table {
                min-width: 740px;
            }
        }
    </style>

    <div class="page-sidebar-overlay" id="pageSidebarOverlay"></div>

    <div class="siswa-page">
        <div class="siswa-content">

            {{-- Tombol Burger Mobile --}}
            <div class="page-mobile-header">
                <button type="button" class="page-burger-btn" id="pageBurgerBtn" aria-label="Buka Sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- HEADER --}}
            <div class="siswa-header-card">
                <div class="siswa-header">

                    {{-- KIRI --}}
                    <div class="siswa-title-wrap">
                        <div class="siswa-label">
                            <i class="bi bi-people-fill"></i>
                            Manajemen Siswa
                        </div>

                        <h4 class="siswa-title">Daftar Siswa</h4>
                        <p class="siswa-subtitle">Kelola data siswa dengan mudah.</p>

                        <form method="GET" action="{{ url()->current() }}" class="filter-form">
                            <select name="kelas" class="form-select form-select-sm kelas-filter">
                                <option value="">Semua Kelas</option>
                                <option value="XI1" {{ request('kelas') == 'XI1' ? 'selected' : '' }}>XI1</option>
                                <option value="XI2" {{ request('kelas') == 'XI2' ? 'selected' : '' }}>XI2</option>
                                <option value="XI3" {{ request('kelas') == 'XI3' ? 'selected' : '' }}>XI3</option>
                            </select>

                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" type="submit">
                                <i class="bi bi-funnel me-1"></i> Terapkan
                            </button>

                            @if(request('kelas'))
                                <a href="{{ url()->current() }}" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    {{-- KANAN --}}
                    <div class="siswa-actions">

                        {{-- EXPORT --}}
                        <div class="export-dropdown">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary rounded-pill px-4 dropdown-toggle" type="button"
                                    id="dropdownExport" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-download me-1"></i> Export Data
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownExport">
                                    <li>
                                        <a class="dropdown-item text-danger fw-semibold" href="{{ route('siswa.export.pdf') }}">
                                            <i class="bi bi-file-earmark-pdf me-2"></i>
                                            Export as PDF
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-success fw-semibold" href="{{ route('siswa.export.excel') }}">
                                            <i class="bi bi-file-earmark-excel me-2"></i>
                                            Export as Excel
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- TAMBAH SISWA --}}
                        <button class="btn btn-success rounded-pill px-4 fw-semibold btn-add" data-bs-toggle="modal"
                            data-bs-target="#tambahSiswa">
                            + Tambah Siswa
                        </button>

                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="card siswa-table-card">
                <div class="card-body">
                    <div class="table-responsive-custom">
                        <table class="table align-middle siswa-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NIS</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($siswas as $index => $siswa)
                                    <tr>
                                        <td>{{ $siswas->firstItem() + $index }}</td>
                                        <td>
                                            <span class="siswa-name">{{ $siswa->nama }}</span>
                                        </td>
                                        <td>
                                            <span class="siswa-email">{{ $siswa->email }}</span>
                                        </td>
                                        <td>{{ $siswa->nis ?? '-' }}</td>
                                        <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                        <td>{{ $siswa->kelas ? str_replace(' ', '', $siswa->kelas) : '-' }}</td>
                                        <td>
                                            <div class="aksi-wrap">
                                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSiswa"
                                                    data-id="{{ $siswa->id }}"
                                                    data-nama="{{ $siswa->nama }}"
                                                    data-email="{{ $siswa->email }}"
                                                    data-nis="{{ $siswa->nis }}"
                                                    data-jenis_kelamin="{{ $siswa->jenis_kelamin }}"
                                                    data-kelas="{{ str_replace(' ', '', $siswa->kelas) }}">
                                                    Edit
                                                </button>

                                                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin mau hapus siswa ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-data">
                                                Belum ada data siswa.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $siswas->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="tambahSiswa" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="XI1">XI1</option>
                                <option value="XI2">XI2</option>
                                <option value="XI3">XI3</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="editSiswa" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditSiswa" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" id="edit_nis" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-select" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas" id="edit_kelas" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="XI1">XI1</option>
                                <option value="XI2">XI2</option>
                                <option value="XI3">XI3</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password <small class="text-muted">(kosongkan jika tidak diubah)</small>
                            </label>
                            <input type="password" name="password" class="form-control" minlength="6">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /*
            |--------------------------------------------------------------------------
            | Burger Untuk Membuka Sidebar Existing dari layout.navbarguru
            |--------------------------------------------------------------------------
            */
            const burgerBtn = document.getElementById('pageBurgerBtn');
            const overlay = document.getElementById('pageSidebarOverlay');

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
            | Modal Edit Siswa
            |--------------------------------------------------------------------------
            */
            const editModal = document.getElementById('editSiswa');
            const form = document.getElementById('formEditSiswa');

            if (!editModal || !form) {
                return;
            }

            editModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;

                if (!btn) {
                    return;
                }

                const id = btn.getAttribute('data-id');

                document.getElementById('edit_nama').value = btn.getAttribute('data-nama') || '';
                document.getElementById('edit_email').value = btn.getAttribute('data-email') || '';
                document.getElementById('edit_nis').value = btn.getAttribute('data-nis') || '';
                document.getElementById('edit_jenis_kelamin').value = btn.getAttribute('data-jenis_kelamin') || 'L';

                const kelas = (btn.getAttribute('data-kelas') || '').replace(/\s+/g, '');
                document.getElementById('edit_kelas').value = kelas;

                form.action = `/siswa/${id}`;
            });
        });
    </script>

@endsection