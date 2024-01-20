<?php

namespace App\Exports\Sheets;

use App\Models\CalonSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetNamaSiswa implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data =  CalonSiswa::select('nama_lengkap', 'jenis_kelamin')->orderBy('jenis_kelamin', 'asc')->get();

        $dataExport = [];
        foreach ($data as $key => $value) {
            $dataExport[] = [
                'no' => $key + 1,
                'nama' => $value->nama_lengkap,
                'jenis_kelamin' => strtoupper($value->jenis_kelamin) == 'L' ? 'Laki-laki' : 'Perempuan',
            ];
        }

        return collect($dataExport);
    }

    public function headings(): array
    {
        return [
            'no',
            'Nama',
            'Jenis Kelamin',
        ];
    }

    public function title(): string
    {
        return 'Data Nama Siswa';
    }
}
