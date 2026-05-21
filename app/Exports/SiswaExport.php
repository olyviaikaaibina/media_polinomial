<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Siswa::select('nama', 'email', 'nis', 'jenis_kelamin', 'kelas')
            ->get()
            ->map(function ($siswa) {
                return [
                    'nama' => $siswa->nama,
                    'email' => $siswa->email,
                    'nis' => $siswa->nis,
                    'jenis_kelamin' => $siswa->jenis_kelamin,
                    'kelas' => str_replace(' ', '', $siswa->kelas),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NIS',
            'Jenis Kelamin',
            'Kelas',
        ];
    }
}