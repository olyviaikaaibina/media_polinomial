@extends('layout.navbarguru')

@section('title', 'Rekapitulasi Nilai')

@section('content')
<div class="container-fluid">

    {{-- ===================== HEADER: JUDUL + EXPORT ===================== --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

            {{-- KIRI: JUDUL --}}
            <div>
                <h4 class="mb-1 fw-semibold">Rekapitulasi Nilai</h4>
                <p class="text-muted small mb-2">
                    Lihat rangkuman nilai siswa per kelas dan mata pelajaran.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <span class="badge rounded-pill bg-light text-dark">
                        <i class="bi bi-people me-1"></i> Siswa Dinilai: 0
                    </span>
                    <span class="badge rounded-pill bg-light text-dark">
                        <i class="bi bi-star me-1"></i> Rata-rata Nilai: 0
                    </span>
                </div>
            </div>

            {{-- KANAN: EXPORT (RAPI, TIDAK SELEBAR) --}}
            <div class="text-end">
                <div class="dropdown d-inline-block">
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

                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle me-1"></i>
                    Gunakan export untuk arsip nilai.
                </small>
            </div>

        </div>
    </div>

    {{-- ===================== CARD 1: TABEL REKAP NILAI ===================== --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white border-0 pb-0">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <span class="badge rounded-pill bg-light text-dark">
                    <i class="bi bi-table me-1"></i> Rekap Nilai Siswa
                </span>

                {{-- SEARCH (UI saja) --}}
                <div class="input-group input-group-sm" style="max-width: 260px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Cari nama siswa">
                    <button class="btn btn-outline-secondary btn-sm" type="button">Cari</button>
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle mb-0 text-center" style="border-collapse: separate; border-spacing: 0 8px;">
                    <thead>
                        <tr style="background: #f7f9fc;">
                            <th class="py-3 px-3 rounded-start align-middle" rowspan="2" style="font-weight: 600;">No</th>
                            <th class="py-3 align-middle text-start" rowspan="2" style="font-weight: 600;">Nama Siswa</th>
                            <th class="py-3 align-middle" rowspan="2" style="font-weight: 600;">Kelas</th>
                            <th class="py-3 align-middle" colspan="5" style="font-weight: 600;">Nilai Kuis per Sub-bab</th>
                            <th class="py-3 align-middle" rowspan="2" style="font-weight: 600;">Nilai Evaluasi</th>
                            <th class="py-3 align-middle" rowspan="2" style="font-weight: 600;">Predikat</th>
                            <th class="py-3 px-3 rounded-end align-middle" rowspan="2" style="font-weight: 600;">Status</th>
                        </tr>

                        <tr style="background: #f7f9fc;">
                            <th class="py-2 small" style="font-weight: 600;">Kuis A</th>
                            <th class="py-2 small" style="font-weight: 600;">Kuis B</th>
                            <th class="py-2 small" style="font-weight: 600;">Kuis C</th>
                            <th class="py-2 small" style="font-weight: 600;">Kuis D</th>
                            <th class="py-2 small" style="font-weight: 600;">Kuis E</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- CONTOH NANTI (kalau sudah ada data)
                        @foreach ($siswas as $index => $siswa)
                            <tr style="background: #ffffff;">
                                <td class="px-3">{{ $index + 1 }}</td>
                                <td class="text-start fw-semibold">{{ $siswa->nama }}</td>

                                <td>
                                    <span class="badge rounded-pill bg-light text-dark">
                                        {{ $siswa->kelas }}
                                    </span>
                                </td>

                                <td>{{ $siswa->kuis_a }}</td>
                                <td>{{ $siswa->kuis_b }}</td>
                                <td>{{ $siswa->kuis_c }}</td>
                                <td>{{ $siswa->kuis_d }}</td>
                                <td>{{ $siswa->kuis_e }}</td>

                                <td class="fw-semibold">{{ $siswa->nilai_evaluasi }}</td>

                                <td>
                                    <span class="badge rounded-pill
                                        @if($siswa->predikat == 'A') bg-success
                                        @elseif($siswa->predikat == 'B') bg-primary
                                        @elseif($siswa->predikat == 'C') bg-warning text-dark
                                        @else bg-danger
                                        @endif">
                                        {{ $siswa->predikat }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge rounded-pill
                                        @if($siswa->status == 'Lulus') bg-success
                                        @else bg-secondary
                                        @endif">
                                        {{ $siswa->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        --}}

                        {{-- STATE KOSONG --}}
                        <tr>
                            <td colspan="11" class="text-center" style="padding: 50px 0; background: #ffffff; border-radius: 12px;">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3"
                                        style="width: 80px; height: 80px; background: #f0f3ff;">
                                        <i class="bi bi-clipboard-data fs-2 text-primary"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Belum ada rekap nilai</h6>
                                    <p class="text-muted small mb-3" style="max-width: 420px;">
                                        Data rekapitulasi nilai akan muncul di sini setelah nilai siswa diinput.
                                    </p>
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                        <i class="bi bi-arrow-repeat me-1"></i> Muat Ulang Rekap
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        {{-- FOOTER PAGINATION (dummy) --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center py-3">
            <small class="text-muted">Menampilkan 0 dari 0 data</small>

            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item"><a href="#" class="page-link">Prev</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    {{-- ===================== CARD 2: CHART & PROGRESS ===================== --}}
    <div class="card border-0 shadow-sm rounded-3 mb-5">
        <div class="card-header bg-white border-0">
            <h6 class="fw-semibold mb-0">Rata-rata Nilai & Progres Kuis per Sub-bab</h6>
        </div>

        <div class="card-body">
            <div class="row g-4">

                {{-- Diagram bar --}}
                <div class="col-lg-8">
                    <p class="text-muted small mb-2">Diagram batang rata-rata nilai kuis per sub-bab.</p>
                    <div style="height: 260px;">
                        <canvas id="subbabChart"></canvas>
                    </div>
                </div>

                {{-- Progress --}}
                <div class="col-lg-4">
                    <h6 class="fw-semibold mb-3">Progres Siswa Mengikuti Kuis</h6>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>Sub-bab A</span>
                            <span id="progressA-label">0% siswa</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div id="progressA" class="progress-bar" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>Sub-bab B</span>
                            <span id="progressB-label">0% siswa</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div id="progressB" class="progress-bar bg-success" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>Sub-bab C</span>
                            <span id="progressC-label">0% siswa</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div id="progressC" class="progress-bar bg-danger" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>Sub-bab D</span>
                            <span id="progressD-label">0% siswa</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div id="progressD" class="progress-bar bg-info" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="mb-1">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>Sub-bab E</span>
                            <span id="progressE-label">0% siswa</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div id="progressE" class="progress-bar bg-warning" style="width: 0%;"></div>
                        </div>
                    </div>

                    <p class="small text-muted mt-3">
                        *Data di atas masih dummy. Nanti bisa diisi dari rekap nilai siswa secara dinamis.
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- ===================== SCRIPT CHART.JS (DUMMY) ===================== --}}
<script>
    const subbabLabels = [
        'A. Polinomial & Fungsi',
        'B. Penjumlahan dsb',
        'C. Pembagian',
        'D. Faktor & Pembuat Nol',
        'E. Identitas'
    ];

    const subbabAverage = [0, 0, 0, 0, 0];

    const ctx = document.getElementById('subbabChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: subbabLabels,
            datasets: [{
                label: 'Rata-rata nilai',
                data: subbabAverage,
                borderWidth: 1,
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { stepSize: 20 },
                    title: { display: true, text: 'Nilai (skala 100)' }
                }
            }
        }
    });

    const progressData = { A: 0, B: 0, C: 0, D: 0, E: 0 };

    function setProgress(idBar, idLabel, value) {
        const bar = document.getElementById(idBar);
        const label = document.getElementById(idLabel);
        if (bar && label) {
            bar.style.width = value + '%';
            label.textContent = value + '% siswa';
        }
    }

    setProgress('progressA', 'progressA-label', progressData.A);
    setProgress('progressB', 'progressB-label', progressData.B);
    setProgress('progressC', 'progressC-label', progressData.C);
    setProgress('progressD', 'progressD-label', progressData.D);
    setProgress('progressE', 'progressE-label', progressData.E);
</script>
@endsection
