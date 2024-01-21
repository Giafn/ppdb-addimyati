<?php

namespace App\Exports\Sheets;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetAsalSekolah implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tahunAjaran = PpdbSettingController::getPPDBInfo()['ppdbOpen']->tahun_ajaran;
        $data = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('akademik', 'calon_siswa.akademik_id', '=', 'akademik.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->select('calon_siswa.nama_lengkap', 'calon_siswa.jenis_kelamin', 'akademik.asal_sekolah')
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->orderBy('jenis_kelamin', 'asc')
            ->get();

        $dataExport = [];
        foreach ($data as $key => $value) {
            $dataExport[] = [
                'no' => $key + 1,
                'nama' => $value->nama_lengkap,
                'jenis_kelamin' => strtoupper($value->jenis_kelamin) == 'L' ? 'Laki-laki' : 'Perempuan',
                'asal_sekolah' => $value->asal_sekolah
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
            'Asal Sekolah'
        ];
    }

    public function title(): string
    {
        return 'Asal Sekolah';
    }
}
