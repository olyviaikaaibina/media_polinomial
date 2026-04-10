@extends('layout.navbarguru')

@section('title', 'Aktivitas Siswa')

@section('content')
<div class="container-fluid">

    {{-- BAR ATAS: JUDUL + AKSI --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

            {{-- Kiri: Judul & Deskripsi --}}
            <div>
                <h4 class="mb-1 fw-semibold">Aktivitas Siswa</h4>
                <p class="text-muted small mb-2">
                    Pantau aktivitas siswa seperti pengerjaan kuis, evaluasi, dan interaksi dengan materi.
                </p>

                {{-- Info ringkas (dummy) --}}
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge rounded-pill bg-light text-dark">
                        <i class="bi bi-lightning-charge me-1"></i> Aktivitas Hari Ini: 0
                    </span>
                    <span class="badge rounded-pill bg-light text-dark">
                        <i class="bi bi-clock-history me-1"></i> Minggu Ini: 0
                    </span>
                </div>
            </div>

            {{-- Kanan: Filter Periode + Export --}}
            <div class="d-flex flex-column gap-2 align-items-end">

                {{-- Filter periode --}}
                <select class="form-select form-select-sm rounded-pill" style="width: 200px;">
                    <option>Periode: Hari ini</option>
                    <option>Minggu ini</option>
                    <option>Bulan ini</option>
                    <option>Semua waktu</option>
                </select>

                {{-- Export dropdown (rapi) --}}
                <div class="dropdown">
                    <button
                        class="btn btn-secondary btn-sm rounded-pill px-3 dropdown-toggle"
                        type="button"
                        id="dropdownExport"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-download me-1"></i> Export
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownExport">
                        <li>
                            <a class="dropdown-item fw-semibold text-danger" href="#">
                                <i class="bi bi-file-earmark-pdf me-2"></i> Export as PDF
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-semibold text-success" href="#">
                                <i class="bi bi-file-earmark-excel me-2"></i> Export as Excel
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    {{-- ===================== CARD 1: TABEL AKTIVITAS ===================== --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white border-0 pb-1">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                {{-- Tabs --}}
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary active">Semua</button>
                    <button class="btn btn-outline-secondary">Kuis</button>
                    <button class="btn btn-outline-secondary">Evaluasi</button>
                    <button class="btn btn-outline-secondary">Materi</button>
                </div>

                {{-- Search --}}
                <div class="input-group input-group-sm" style="max-width: 260px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Cari nama / aktivitas">
                    <button class="btn btn-outline-secondary btn-sm">Cari</button>
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0 8px;">
                    <thead>
                        <tr style="background: #f7f9fc;">
                            <th class="py-3 px-3 rounded-start fw-semibold">No</th>
                            <th class="py-3 fw-semibold">Nama Siswa</th>
                            <th class="py-3 fw-semibold">Kelas</th>
                            <th class="py-3 fw-semibold">Aktivitas</th>
                            <th class="py-3 fw-semibold">Jenis</th>
                            <th class="py-3 fw-semibold">Waktu</th>
                            <th class="py-3 px-3 rounded-end fw-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- DATA AKTIVITAS --}}
                        {{--
                        @foreach ($aktivitas as $item)
                        <tr style="background: #ffffff;">
                            <td class="px-3">{{ $loop->iteration }}</td>

                            <td class="fw-semibold">
                                {{ $item->nama_siswa }}
                            </td>

                            <td>
                                <span class="badge rounded-pill bg-light text-dark">
                                    {{ $item->kelas }}
                                </span>
                            </td>

                            <td class="text-start">
                                <div class="fw-semibold">{{ $item->judul_aktivitas }}</div>
                                <div class="small text-muted">{{ $item->subbab ?? '-' }}</div>
                            </td>

                            <td>
                                <span class="badge rounded-pill bg-light text-dark">
                                    {{ $item->jenis }}
                                </span>
                            </td>

                            <td>
                                <div class="small fw-semibold">{{ $item->waktu->format('d M Y') }}</div>
                                <div class="small text-muted">{{ $item->waktu->format('H:i') }} WIB</div>
                            </td>

                            <td>
                                <span class="badge rounded-pill
                                    @if($item->status == 'Selesai') bg-success
                                    @elseif($item->status == 'Sedang dikerjakan') bg-warning text-dark
                                    @else bg-secondary
                                    @endif">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        --}}

                        {{-- STATE KOSONG --}}
                        <tr>
                            <td colspan="7" class="text-center py-5 bg-white rounded">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3"
                                         style="width: 80px; height: 80px; background: #f0f3ff;">
                                        <i class="bi bi-activity fs-2 text-primary"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Belum ada aktivitas tercatat</h6>
                                    <p class="text-muted small mb-3" style="max-width: 420px;">
                                        Aktivitas siswa akan muncul di sini setelah siswa mulai belajar.
                                    </p>
                                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                        <i class="bi bi-arrow-repeat me-1"></i> Muat Ulang Aktivitas
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
