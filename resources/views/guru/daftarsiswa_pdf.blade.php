<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Siswa</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px; 
        }

        h3 {
            text-align: center;
            margin-bottom: 16px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
        }

        th, td { 
            border: 1px solid #000; 
            padding: 6px; 
        }

        th { 
            background: #eee; 
        }
    </style>
</head>
<body>
    <h3>
        Daftar Siswa
        @if(isset($kelas) && $kelas && $kelas !== 'semua')
            Kelas {{ str_replace(' ', '', $kelas) }}
        @else
            Semua Kelas
        @endif
    </h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NIS</th>
                <th>JK</th>
                <th>Kelas</th>
            </tr>
        </thead>

        <tbody>
            @foreach($siswas as $i => $s)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->email ?? '-' }}</td>
                    <td>{{ $s->nis ?? '-' }}</td>
                    <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ str_replace(' ', '', $s->kelas) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>