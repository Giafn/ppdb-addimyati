<?php

namespace App\Exports;

use App\Models\CalonSiswa;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportPPDB implements WithMultipleSheets
{
    private $data;

    public function __construct($data = ['tahun_ajaran' => null, 'gelombang' => null , 'is_all' => false])
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new Sheets\SheetDataSiswa($this->data);
        $sheets[] = new Sheets\SheetDataPembayaran($this->data);
        $sheets[] = new Sheets\SheetNamaSiswa($this->data);
        $sheets[] = new Sheets\SheetAsalSekolah($this->data);
        $sheets[] = new Sheets\SheetUkuranSeragam($this->data);

        return $sheets;
    }
}
