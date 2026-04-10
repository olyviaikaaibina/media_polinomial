<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Siswa</title>
    <style>
        body{ font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table{ width:100%; border-collapse: collapse; }
        th,td{ border:1px solid #000; padding:6px; }
        th{ background:#eee; }
    </style>
</head>
<body>
    <h3>Daftar Siswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Nama</th><th>Email</th><th>No HP</th><th>JK</th><th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $i => $s)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->email }}</td>
                <td>{{ $s->no_hp }}</td>
                <td>{{ $s->jenis_kelamin }}</td>
                <td>{{ $s->kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
