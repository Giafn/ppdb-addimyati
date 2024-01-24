<?php

namespace App\Exports\Sheets;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetNamaSiswa implements FromView, ShouldAutoSize, WithTitle
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

        $dataLaki = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->select('calon_siswa.nama_lengkap', 'calon_siswa.jenis_kelamin')
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->when($gelombang, function($query, $gelombang) {
                return $query->where('ppdb.gelombang', $gelombang);
            })
            ->when($isAll == false, function($query) {
                return $query->where('pendaftaran.status_pembayaran', '!=', 0);
            })
            ->where('jenis_kelamin', 'l')
            ->orderBy('nama_lengkap', 'asc')
            ->get();
        
        $dataPerempuan = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->select('calon_siswa.nama_lengkap', 'calon_siswa.jenis_kelamin')
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->when($gelombang, function($query, $gelombang) {
                return $query->where('ppdb.gelombang', $gelombang);
            })
            ->when($isAll == false, function($query) {
                return $query->where('pendaftaran.status_pembayaran', '!=', 0);
            })
            ->where('jenis_kelamin', 'p')
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        $dataExport = [
            'laki_laki' => [],
            'perempuan' => [],
        ];
        foreach ($dataLaki as $key => $value) {
            $dataExport['laki_laki'][$key] = [
                'no' => $key + 1,
                'nama' => $value->nama_lengkap,
                'jenis_kelamin' => strtoupper($value->jenis_kelamin),
            ];
        }
        foreach ($dataPerempuan as $key => $value) {
            $dataExport['perempuan'][$key] = [
                'no' => $key + 1,
                'nama' => $value->nama_lengkap,
                'jenis_kelamin' => strtoupper($value->jenis_kelamin),
            ];
        }

        return view('export.data-nama-siswa', [
            'data' => $dataExport,
        ]);
    }

    public function title(): string
    {
        return 'Data Nama Siswa';
    }
}
