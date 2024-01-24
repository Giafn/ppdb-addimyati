<?php

namespace App\Exports\Sheets;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetNamaSiswaJurusan implements FromView, ShouldAutoSize, WithTitle
{
    private $data;

    public function __construct($data = ['tahun_ajaran' => null, 'gelombang' => null , 'jurusan' => '', 'jurusan_nama' => ''])
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        $selectedTahunAjaran = $data['tahun_ajaran'];
        $tahunAjaran = $selectedTahunAjaran ?? PpdbSettingController::getPPDBInfo()['ppdbOpen']->tahun_ajaran;
        $gelombang = $data['gelombang'];
        $jurusan = $data['jurusan'];

        $data = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->select('calon_siswa.nama_lengkap', 'calon_siswa.jenis_kelamin')
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->when($gelombang, function($query, $gelombang) {
                return $query->where('ppdb.gelombang', $gelombang);
            })
            ->where('pendaftaran.status_pembayaran', '!=', 0)
            ->where('calon_siswa.program_keahlian_id', $jurusan)
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        foreach ($data as $key => $value) {
            $data[$key] = [
                'no' => $key + 1,
                'nama' => $value->nama_lengkap,
                'jenis_kelamin' => strtoupper($value->jenis_kelamin),
            ];
        }

        return view('export.data-jurusan', [
            'data' => $data,
            'namaJurusan' => $this->data['jurusan_nama'],
            'tahunAjaran' => $tahunAjaran,
        ]);
    }

    public function title(): string
    {
        return $this->data['jurusan_nama'];
    }
}
