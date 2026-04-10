{{-- resources/views/dashboardguru.blade.php --}}
@extends('layout.navbarguru')

@section('title', 'Halaman Guru – Dashboard')

@section('content')
<div class="container-fluid">

    @php
        $jumlahSiswa = $jumlahSiswa ?? 0;
        $pengunjungHariIni = $pengunjungHariIni ?? 0;
        $subbab = $subbab ?? ['Sub-bab 1', 'Sub-bab 2'];
        $nilaiRata = $nilaiRata ?? [0, 0];
        $aktivitas = $aktivitas ?? [];
    @endphp

    <div class="mb-4">
        <h6 class="text-uppercase text-muted mb-1" style="letter-spacing: 1px;">
            Selamat Datang {{ auth('guru')->user()->nama }}
        </h6>
        <h3 class="fw-semibold mb-0">Dashboard</h3>
        <p class="text-muted mt-1 mb-0">
            Ringkasan aktivitas siswa dan hasil kuis pada materi Polinomial.
        </p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Jumlah Siswa</h6>
                    <h3 class="fw-semibold mb-0">{{ $jumlahSiswa }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Siswa yang Mengunjungi Hari Ini</h6>
                    <h3 class="fw-semibold mb-0">{{ $pengunjungHariIni }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Nilai Rata-rata Kuis per Sub-bab</h6>
            </div>
            <canvas id="chartKuis" height="100"></canvas>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Aktivitas Siswa Terbaru</h6>
                <a href="{{ url('/guru/aktivitas') }}" class="small text-decoration-none">Lihat semua</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
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
                                <td>{{ $a->nama }}</td>
                                <td>{{ $a->materi }}</td>
                                <td>
                                    @if ($a->status === 'Selesai')
                                        <span class="badge bg-success-subtle text-success">Selesai</span>
                                    @elseif ($a->status === 'Sedang dikerjakan')
                                        <span class="badge bg-warning-subtle text-warning">Sedang dikerjakan</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">Belum mulai</span>
                                    @endif
                                </td>
                                <td>{{ $a->waktu }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada aktivitas siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('chartKuis');
            if (!ctx) return;

            const labels = @json($subbab);
            const dataNilai = @json($nilaiRata);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nilai Rata-rata',
                        data: dataNilai,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        });
    </script>
@endsection
