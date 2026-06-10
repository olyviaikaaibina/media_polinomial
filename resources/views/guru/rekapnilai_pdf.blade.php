<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekapitulasi Nilai</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h3 {
            text-align: center;
            margin-bottom: 6px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 16px;
            font-size: 11px;
            font-weight: bold;
        }

        h4 {
            margin-top: 18px;
            margin-bottom: 8px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eeeeee;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .summary-table {
            width: 50%;
            margin-bottom: 18px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php
        $kelasAktif = $kelas ?? 'semua';
    @endphp

    <h3>Rekapitulasi Nilai</h3>

    <div class="subtitle">
        @if($kelasAktif && $kelasAktif !== 'semua')
            Kelas {{ str_replace(' ', '', $kelasAktif) }}
        @else
            Semua Kelas
        @endif
    </div>

    <table class="summary-table">
        <tr>
            <th>Siswa Dinilai</th>
            <td>{{ $siswaDinilai ?? 0 }}</td>
        </tr>
        <tr>
            <th>Rata-rata Nilai</th>
            <td>{{ $rataRataNilai ?? 0 }}</td>
        </tr>
    </table>

    <h4>Rekap Nilai Siswa</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Kuis A</th>
                <th>Kuis B</th>
                <th>Kuis C</th>
                <th>Kuis D</th>
                <th>Kuis E</th>
                <th>Nilai Evaluasi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($rekapNilai as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td class="text-left">
                        {{ $siswa->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $siswa->kelas ? str_replace(' ', '', $siswa->kelas) : '-' }}
                    </td>

                    @foreach ($quizzes as $quiz)
                        @php
                            $nilaiKuis = $siswa->nilai_kuis[$quiz->id] ?? null;
                        @endphp

                        <td>
                            {{ $nilaiKuis !== null ? $nilaiKuis : '-' }}
                        </td>
                    @endforeach

                    @for ($i = $quizzes->count(); $i < 5; $i++)
                        <td>-</td>
                    @endfor

                    <td>
                        {{ $siswa->nilai_evaluasi !== null ? $siswa->nilai_evaluasi : '-' }}
                    </td>

                    <td>
                        {{ $siswa->status ?? 'Belum mulai' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">Belum ada data rekap nilai</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="page-break"></div>

    <h3>Rata-rata Nilai & Progres Kuis</h3>

    <div class="subtitle">
        @if($kelasAktif && $kelasAktif !== 'semua')
            Kelas {{ str_replace(' ', '', $kelasAktif) }}
        @else
            Semua Kelas
        @endif
    </div>

    <h4>Rata-rata Nilai per Kuis</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kuis</th>
                <th>Rata-rata Nilai</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($chartLabels as $index => $label)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $label }}</td>
                    <td>{{ $chartData[$index] ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada data rata-rata nilai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4>Progres Siswa Mengikuti Kuis</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kuis</th>
                <th>Jumlah Ikut</th>
                <th>Total Siswa</th>
                <th>Persentase</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($progressData as $index => $progress)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $progress['label'] ?? '-' }}</td>
                    <td>{{ $progress['jumlah_ikut'] ?? 0 }}</td>
                    <td>{{ $progress['total_siswa'] ?? 0 }}</td>
                    <td>{{ $progress['persen'] ?? 0 }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data progres kuis.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>