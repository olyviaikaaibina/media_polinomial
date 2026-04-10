@extends('layout.navbarguru')

@section('title', 'Daftar Siswa')

@section('content')
    <style>
        .export-note {
            font-size: .9rem;
            margin-top: 6px;
            color: #222;
        }

        .btn-add {
            border-radius: 999px;
            padding: 10px 16px;
            font-weight: 600;
        }

        .export-dropdown .btn {
            border-radius: 999px;
            padding: 10px 14px;
            font-weight: 600;
            width: auto;
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

        /* dropdown filter kelas */
        .kelas-filter {
            width: 220px;
        }
    </style>

    <div class="container-fluid">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap">

            {{-- KIRI --}}
            <div>
                <h4 class="fw-semibold mb-1">Daftar Siswa</h4>
                <p class="text-muted small mb-2">Kelola data siswa dengan mudah</p>

                <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2 flex-wrap">
                    <select name="kelas" class="form-select form-select-sm rounded-pill kelas-filter">
                        <option value="">Semua Kelas</option>
                        <option value="XI 1" {{ request('kelas') == 'XI 1' ? 'selected' : '' }}>XI 1</option>
                        <option value="XI 2" {{ request('kelas') == 'XI 2' ? 'selected' : '' }}>XI 2</option>
                        <option value="XI 3" {{ request('kelas') == 'XI 3' ? 'selected' : '' }}>XI 3</option>
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
            <div class="d-flex align-items-start gap-1">

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

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="table-light">
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
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->email }}</td>
                                <td>{{ $siswa->nis ?? '-' }}</td>
                                <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $siswa->kelas ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#editSiswa" data-id="{{ $siswa->id }}"
                                        data-nama="{{ $siswa->nama }}" data-email="{{ $siswa->email }}"
                                        data-nis="{{ $siswa->nis }}" data-jenis_kelamin="{{ $siswa->jenis_kelamin }}"
                                        data-kelas="{{ $siswa->kelas }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin mau hapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    Belum ada data siswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $siswas->withQueryString()->links() }}
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
                        <button class="btn-close" data-bs-dismiss="modal"></button>
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
                                <option value="XI 1">XI 1</option>
                                <option value="XI 2">XI 2</option>
                                <option value="XI 3">XI 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
                        <button class="btn-close" data-bs-dismiss="modal"></button>
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
                            <select name="kelas" id="edit_kelas"class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="XI 1">XI 1</option>
                                <option value="XI 2">XI 2</option>
                                <option value="XI 3">XI 3</option>
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
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT: SET ACTION FORM EDIT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editSiswa');
            const form = document.getElementById('formEditSiswa');
            if (!editModal || !form) return;

            editModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;
                if (!btn) return;

                const id = btn.getAttribute('data-id');

                document.getElementById('edit_nama').value = btn.getAttribute('data-nama') || '';
                document.getElementById('edit_email').value = btn.getAttribute('data-email') || '';
                document.getElementById('edit_nis').value = btn.getAttribute('data-nis') || '';
                document.getElementById('edit_jenis_kelamin').value = btn.getAttribute('data-jenis_kelamin') || 'L';
                document.getElementById('edit_kelas').value = btn.getAttribute('data-kelas') || '';

                form.action = `/siswa/${id}`;
            });
        });
    </script>
@endsection