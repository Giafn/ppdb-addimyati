<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ppdb;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['cms.access:dashboard,hak-akses']);
    }

    public function index(Request $request)
    {
        $listppdb = PpdbSettingController::listTahunAjaranGelombang();
        $fillSelectFilter = [
            "list_tahun_ajaran" => $listppdb["listTahunAjaran"],
            "list_gelombang" => $listppdb["listGelombang"]
        ];
        return view('cms.dashboard', compact('fillSelectFilter'));
    }

    public function data(Request $request)
    {
        $request->validate([
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
        ]);

        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang ?? null;

        $ppdb = PpdbSettingController::getPPDBInfo();
        $tahunAjaranTerakhir = Ppdb::select('tahun_ajaran', 'end_date', 'gelombang')->orderBy('end_date', 'desc')
            ->whereDate('end_date', '<=', date("Y-m-d"))
            ->first();
        
        $gelombangTerakhir = $tahunAjaranTerakhir ? $tahunAjaranTerakhir->gelombang : null;
        $tahunAjaranTerakhir = $tahunAjaranTerakhir ? $tahunAjaranTerakhir->tahun_ajaran : null;
        $tahunSelect = $ppdb["ppdbOpen"] ? $ppdb["ppdbOpen"]->tahun_ajaran : $tahunAjaranTerakhir;
        $gelombang = $gelombang ?? $gelombangTerakhir;

        $rekapPendaftarPerday = Pendaftaran::join('ppdb', 'ppdb.id', '=', 'pendaftaran.ppdb_id')
            ->selectRaw('DATE(pendaftaran.created_at) as date, count(*) as total')
            ->when($tahunAjaran, function ($query, $tahunAjaran) {
                return $query->where('tahun_ajaran', $tahunAjaran);
            })
            ->when($gelombang, function ($query, $gelombang) {
                return $query->where('gelombang', $gelombang);
            })
            ->when(!$tahunAjaran, function ($query) use ($tahunSelect) {
                return $query->where('tahun_ajaran', $tahunSelect);
            })
            ->when(!$gelombang, function ($query) use ($ppdb) {
                return $query->where('gelombang', $ppdb["ppdbOpen"]->gelombang);
            })
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $rekapPendaftarPerday = $rekapPendaftarPerday->map(function ($item) {
            $item->date = date("d M Y", strtotime($item->date));
            return $item;
        });

        // pendaftar per jurusan
        $rekapPendaftarPerJurusan = Pendaftaran::join('ppdb', 'ppdb.id', '=', 'pendaftaran.ppdb_id')
            ->join('calon_siswa', 'calon_siswa.id', '=', 'pendaftaran.calon_siswa_id')
            ->join('program_keahlian', 'program_keahlian.id', '=', 'calon_siswa.program_keahlian_id')
            ->selectRaw('program_keahlian.nama as jurusan, count(*) as total')
            ->when($tahunAjaran, function ($query, $tahunAjaran) {
                return $query->where('tahun_ajaran', $tahunAjaran);
            })
            ->when($gelombang, function ($query, $gelombang) {
                return $query->where('gelombang', $gelombang);
            })
            ->when(!$tahunAjaran, function ($query) use ($tahunSelect) {
                return $query->where('tahun_ajaran', $tahunSelect);
            })
            ->when(!$gelombang, function ($query) use ($ppdb) {
                return $query->where('gelombang', $ppdb["ppdbOpen"]->gelombang);
            })
            ->groupBy('jurusan')
            ->orderBy('jurusan', 'asc')
            ->get();
        $rekapPendaftarPerJurusan = $rekapPendaftarPerJurusan->map(function ($item) {
            $item->jurusan = ucwords($item->jurusan);
            return $item;
        });

        // jumlah semua pendafatar
        $totalPendaftar = Pendaftaran::join('ppdb', 'ppdb.id', '=', 'pendaftaran.ppdb_id')
            ->when($tahunAjaran, function ($query, $tahunAjaran) {
                return $query->where('tahun_ajaran', $tahunAjaran);
            })
            ->when(!$tahunAjaran, function ($query) use ($tahunSelect) {
                return $query->where('tahun_ajaran', $tahunSelect);
            })
            ->count();
        
        // jumlah pendaftar gelombang ini
        $totalPendaftarGelombangIni = Pendaftaran::join('ppdb', 'ppdb.id', '=', 'pendaftaran.ppdb_id')
            ->when($tahunAjaran, function ($query, $tahunAjaran) {
                return $query->where('tahun_ajaran', $tahunAjaran);
            })
            ->when($gelombang, function ($query, $gelombang) {
                return $query->where('gelombang', $gelombang);
            })
            ->when(!$tahunAjaran, function ($query) use ($tahunSelect) {
                return $query->where('tahun_ajaran', $tahunSelect);
            })
            ->when(!$gelombang, function ($query) use ($ppdb) {
                return $query->where('gelombang', $ppdb["ppdbOpen"]->gelombang);
            })
            ->count();

        // jumlah pendaftar per status_pembayaran 0 = belum bayar 1 = belum lunas 2 = lunas
        $totalPendaftarPerStatus = Pendaftaran::join('ppdb', 'ppdb.id', '=', 'pendaftaran.ppdb_id')
            ->selectRaw('status_pembayaran, count(*) as total')
            ->when($tahunAjaran, function ($query, $tahunAjaran) {
                return $query->where('tahun_ajaran', $tahunAjaran);
            })
            ->when($gelombang, function ($query, $gelombang) {
                return $query->where('gelombang', $gelombang);
            })
            ->when(!$tahunAjaran, function ($query) use ($tahunSelect) {
                return $query->where('tahun_ajaran', $tahunSelect);
            })
            ->when(!$gelombang, function ($query) use ($ppdb) {
                return $query->where('gelombang', $ppdb["ppdbOpen"]->gelombang);
            })
            ->groupBy('status_pembayaran')
            ->orderBy('status_pembayaran', 'asc')
            ->get();
        $totalPendaftarPerStatus = $totalPendaftarPerStatus->map(function ($item) use ($totalPendaftarGelombangIni) {
            $item->status_pembayaran = $item->status_pembayaran == 0 ? "Belum Bayar" : ($item->status_pembayaran == 1 ? "Belum Lunas" : "Lunas");
            $item->persen_total = round(($item->total / $totalPendaftarGelombangIni) * 100, 1);
            return $item;
        });
        $totalPendaftarPerStatus = $totalPendaftarPerStatus->toArray();

        $dataLineChart = [
            "labels" => $rekapPendaftarPerday->pluck('date')->toArray(),
            "datasets" => [
                [
                    "label" => "Jumlah Pendaftar",
                    "data" => $rekapPendaftarPerday->pluck('total')->toArray(),
                    "borderColor" => "rgba(255, 99, 132, 1)",
                    "borderWidth" => 2,
                    "fill" => false,
                ]
            ]
        ];
        
        $dataDougnutChart = [
            "labels" => $rekapPendaftarPerJurusan->pluck('jurusan')->toArray(),
            "datasets" => [
                [
                    "label" => "Jumlah Pendaftar",
                    "data" => $rekapPendaftarPerJurusan->pluck('total')->toArray(),
                    "backgroundColor" => [
                        "#FF6384","#36A2EB","#FFCE56","#4BC0C0","#9966FF","#FF9F40","#FF6384","#36A2EB","#FFCE56","#4BC0C0","#9966FF","#FF9F40",
                    ],
                    "hoverBackgroundColor" => [
                        "#FF6384","#36A2EB","#FFCE56","#4BC0C0","#9966FF","#FF9F40","#FF6384","#36A2EB","#FFCE56","#4BC0C0","#9966FF","#FF9F40",
                    ],
                ]
            ]
        ];
        $data = [
                "status" => "OK",
                "results" => [
                    "dataLineChart" => $dataLineChart,
                    "dataDougnutChart" => $dataDougnutChart,
                    "totalPendaftar" => $totalPendaftar,
                    "totalPendaftarGelombangIni" => $totalPendaftarGelombangIni,
                    "totalPendaftarPerStatus" => $totalPendaftarPerStatus,
                    "gelombangNow" => $ppdb["ppdbOpen"] ? $ppdb["ppdbOpen"]->gelombang : $gelombangTerakhir,
                    "tahunAjaranNow" => $ppdb["ppdbOpen"] ? $ppdb["ppdbOpen"]->tahun_ajaran : $tahunAjaranTerakhir,
                ]
        ];
        
        return response()->json($data);
    }
}
