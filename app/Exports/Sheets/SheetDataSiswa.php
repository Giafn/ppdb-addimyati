<?php

namespace App\Exports\Sheets;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetDataSiswa implements FromView, ShouldAutoSize, WithTitle
{
    public function view(): View
    {
        $tahunAjaran = PpdbSettingController::getPPDBInfo()['ppdbOpen']->tahun_ajaran;
        $data =  Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('akademik', 'calon_siswa.akademik_id', '=', 'akademik.id')
            ->leftJoin('orang_tua_wali as ayah', function($join) {
                $join->on('calon_siswa.id', '=', 'ayah.calon_siswa_id')
                     ->where('ayah.jenis', '=', 'Ayah');
            })
            ->leftJoin('orang_tua_wali as ibu', function($join) {
                $join->on('calon_siswa.id', '=', 'ibu.calon_siswa_id')
                     ->where('ibu.jenis', '=', 'Ibu');
            })
            ->leftJoin('orang_tua_wali as wali', function($join) {
                $join->on('calon_siswa.id', '=', 'wali.calon_siswa_id')
                     ->where('wali.jenis', '=', 'Wali');
            })
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->join('alamat', 'calon_siswa.alamat_id', '=', 'alamat.id')
            ->select(
                'calon_siswa.nama_lengkap',
                'calon_siswa.jenis_kelamin',
                'calon_siswa.anak_ke',
                'ayah.nama_lengkap as nama_ayah',
                'ibu.nama_lengkap as nama_ibu',
                'wali.nama_lengkap as nama_wali',
                'ayah.pendidikan_terakhir as pendidikan_ayah',
                'ibu.pendidikan_terakhir as pendidikan_ibu',
                'wali.pendidikan_terakhir as pendidikan_wali',
                'ayah.pekerjaan as pekerjaan_ayah',
                'ibu.pekerjaan as pekerjaan_ibu',
                'wali.pekerjaan as pekerjaan_wali',
                'alamat.gang as alamat_gg',
                'alamat.jalan as alamat_jln',
                'alamat.rt as alamat_rt',
                'alamat.rw as alamat_rw',
                'alamat.desa as alamat_desa',
                'alamat.kecamatan as alamat_kecamatan',
                'alamat.kota as alamat_kab_kota',
                'akademik.asal_sekolah as asal_sekolah',
                'calon_siswa.telepon as nomor_wa',
                'akademik.nisn as nisn',
                'ppdb.gelombang as gelombang'
            )
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->orderBy('jenis_kelamin', 'asc')
            ->get()->groupBy('gelombang');

        return view('export.data-siswa', [
            'data' => $data
        ]);
    }

    public function title(): string
    {
        return 'Data Siswa';
    }
}
