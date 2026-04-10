<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Siswa::select('nama','email','no_hp','jenis_kelamin','kelas')->get();
    }

    public function headings(): array
    {
        return ['Nama','Email','No HP','Jenis Kelamin','Kelas'];
    }
}
