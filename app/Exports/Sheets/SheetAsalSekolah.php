<?php

namespace App\Exports\Sheets;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetAsalSekolah implements FromView, ShouldAutoSize, WithTitle
{
    private $data;

    public function __construct($data = ['tahun_ajaran' => null, 'gelombang' => null , 'is_all' => false])
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        $selectedTahunAjaran = $data['tahun_ajaran'];
        $tahunAjaran = $selectedTahunAjaran ?? PpdbSettingController::getPPDBInfo()['ppdbOpen']->tahun_ajaran;
        $gelombang = $data['gelombang'];
        $isAll = $data['is_all'];

        $data = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('akademik', 'calon_siswa.akademik_id', '=', 'akademik.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->select('calon_siswa.nama_lengkap', 'calon_siswa.jenis_kelamin', 'akademik.asal_sekolah')
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->when($gelombang, function($query, $gelombang) {
                return $query->where('ppdb.gelombang', $gelombang);
            })
            ->when($isAll == false, function($query) {
                return $query->where('pendaftaran.status_pembayaran', '!=', 0);
            })
            ->orderBy('nama_lengkap', 'asc')
            ->orderBy('jenis_kelamin', 'asc')
            ->get();

        $dataExport = [];
        foreach ($data as $key => $value) {
            $dataExport[] = [
                'no' => $key + 1,
                'nama' => $value->nama_lengkap,
                'jenis_kelamin' => strtoupper($value->jenis_kelamin),
                'asal_sekolah' => $value->asal_sekolah
            ];
        }

        return view('export.data-asal-sekolah', [
            'data' => $dataExport,
            'tahunAjaran' => $tahunAjaran,
        ]);
    }

    public function title(): string
    {
        return 'Asal Sekolah';
    }
}
