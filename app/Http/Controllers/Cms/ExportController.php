<?php

namespace App\Http\Controllers\Cms;

use App\Exports\ExportJurusan;
use App\Exports\ExportPPDB;
use App\Exports\Sheets\SheetAsalSekolah;
use App\Exports\Sheets\SheetDataPembayaran;
use App\Exports\Sheets\SheetDataSiswa;
use App\Exports\Sheets\SheetNamaSiswa;
use App\Exports\Sheets\SheetUkuranSeragam;
use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:laporan,hak-akses']);
    }

    public function dataSiswa(Request $request)
    {
        if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }

        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "is_all" => "nullable"
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
            "is_all" => $request->is_all ? true : false
        ];
        $namaFile = "DataSiswa" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new SheetDataSiswa($data), $namaFile);
    }

    public function dataPembayaran(Request $request)
    {
       if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "is_all" => "nullable"
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
            "is_all" => $request->is_all ? true : false
        ];
        $namaFile = "DataPembayaran" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new SheetDataPembayaran($data), $namaFile);
    }

    public function dataNamaSiswa(Request $request)
    {
       if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "is_all" => "nullable"
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
            "is_all" => $request->is_all ? true : false
        ];
        $namaFile = "DataNamaSiswa" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new SheetNamaSiswa($data), $namaFile);
    }

    public function dataAsalSekolah(Request $request)
    {
       if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "is_all" => "nullable"
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
            "is_all" => $request->is_all ? true : false
        ];
        $namaFile = "DataAsalSekolah" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new SheetAsalSekolah($data), $namaFile);
    }

    public function dataUkuranSeragam(Request $request)
    {
       if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "is_all" => "nullable"
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
            "is_all" => $request->is_all ? true : false
        ];
        $namaFile = "DataUkuranSeragam" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new SheetUkuranSeragam($data), $namaFile);
    }

    public function dataAll(Request $request)
    {
       if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "is_all" => "nullable"
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
            "is_all" => $request->is_all ? true : false
        ];
        $namaFile = "DataPPDB" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new ExportPPDB($data), $namaFile);
    }

    public function dataJurusan(Request $request)
    {
       if ($this->cekPpdb() == false) {
            return redirect()->back()->with('error', 'Data PPDB tidak ditemukan');
        }
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        
        $data = [
            "tahun_ajaran" => $tahunAjaran,
            "gelombang" => $gelombang,
        ];
        $namaFile = "DataSiswaPerJurusan" . ($tahunAjaran ? "-(" . $tahunAjaran . ")" : "") . ($gelombang ? "-gel-" . $gelombang : "") . ".xlsx";
        
        $namaFile = str_replace('/', '-', $namaFile);

        return Excel::download(new ExportJurusan($data), $namaFile);
    }

    private function cekPpdb()
    {
        $ppdb = Ppdb::all();
        if ($ppdb->count() == 0) {
            return false;
        }
        return true;
    }
}
