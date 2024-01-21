<?php

namespace App\Exports;

use App\Models\CalonSiswa;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportPPDB implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new Sheets\SheetNamaSiswa;
        $sheets[] = new Sheets\SheetAsalSekolah;
        $sheets[] = new Sheets\SheetDataSiswa;

        return $sheets;
    }
}
