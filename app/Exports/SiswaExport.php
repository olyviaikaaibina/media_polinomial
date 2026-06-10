<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $kelas;

    public function __construct($kelas = null)
    {
        $this->kelas = $kelas;
    }

    public function collection()
    {
        $query = Siswa::select('nama', 'email', 'nis', 'jenis_kelamin', 'kelas');

        if ($this->kelas && $this->kelas !== 'semua') {
            $query->where('kelas', $this->kelas);
        }

        return $query->orderBy('id', 'desc')
            ->get()
            ->map(function ($siswa) {
                return [
                    'nama' => $siswa->nama,
                    'email' => $siswa->email,
                    'nis' => $siswa->nis,
                    'jenis_kelamin' => $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
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