<?php

namespace App\Exports;

use App\Models\CalonSiswa;
use App\Models\ProgramKeahlian;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportJurusan implements WithMultipleSheets
{
    private $data;

    public function __construct($data = ['tahun_ajaran' => null, 'gelombang' => null])
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];

        $listJurusan = ProgramKeahlian::select('id', 'nama')->get();
        foreach ($listJurusan as $key => $value) {
            $dataCopy = $this->data;
            $dataCopy['jurusan'] = $value->id;
            $dataCopy['jurusan_nama'] = $value->nama;
            $sheets[] = new Sheets\SheetNamaSiswaJurusan($dataCopy);
        }

        return $sheets;
    }
}
