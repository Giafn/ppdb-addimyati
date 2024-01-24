<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\Ppdb;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class PilihanProgramStudi extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:pilihanJurusan,hak-akses']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'serach' => 'nullable|alpha_space',
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable|numeric",
            "jurusan_pengganti" => "nullable|numeric|exists:program_keahlian,id",
        ]);

        $search = $request->search;
        $jurusanPengganti = $request->jurusan_pengganti;
        $tahunAjaran = $request->tahun_ajaran;
        $gelombang = $request->gelombang;
        $statusData = $request->status_data;
        $statusPembayaran = (string) $request->status_pembayaran;

        $ppdb = PpdbSettingController::getPPDBInfo();
        $tahunAjaranTerakhir = Ppdb::select('tahun_ajaran', 'end_date')->orderBy('end_date', 'desc')
            ->whereDate('end_date', '<=', date("Y-m-d"))
            ->first();
        $tahunAjaranTerakhir = $tahunAjaranTerakhir ? $tahunAjaranTerakhir->tahun_ajaran : null;
        $tahunSelect = $ppdb["ppdbOpen"] ? $ppdb["ppdbOpen"]->tahun_ajaran : $tahunAjaranTerakhir;

        $listData  = Pendaftaran::join('calon_siswa', 'calon_siswa.id' ,'pendaftaran.calon_siswa_id')
            ->join('ppdb', 'ppdb.id', 'pendaftaran.ppdb_id')
            ->leftJoin('program_keahlian as pk1', 'pk1.id', 'pendaftaran.jurusan_id1')
            ->leftJoin('program_keahlian as pk2', 'pk2.id', 'pendaftaran.jurusan_id2')
            ->select('pendaftaran.id', 'calon_siswa.nama_lengkap', 'calon_siswa.program_keahlian_id as jurusan', 'pk1.id as id_jurusan1', 'pk1.nama as nama_jurusan1', 'pk2.id as id_jurusan2', 'pk2.nama as nama_jurusan2', 'pendaftaran.status_pembayaran')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('calon_siswa.nama_lengkap', 'like', '%' . $search . '%');
            })
            ->when(empty($tahunAjaran), function ($query) use ($tahunSelect) {
                $query->where('ppdb.tahun_ajaran', $tahunSelect);
                request()->merge([
                    'tahun_ajaran' => $tahunSelect
                ]);
            })
            ->when(!empty($tahunAjaran), function ($query) use ($tahunAjaran) {
                $query->where('ppdb.tahun_ajaran', $tahunAjaran);
            })
            ->when(!empty($gelombang), function ($query) use ($gelombang) {
                $query->where('ppdb.gelombang', $gelombang);
            })
            ->when(!empty($jurusanPengganti), function ($query) use ($jurusanPengganti) {
                $query->where('pendaftaran.jurusan_id2', $jurusanPengganti);
            })
            ->where('pendaftaran.status_pembayaran', '!=', '0')
            ->orderBy('pendaftaran.id', 'desc')
            ->get()->groupBy('jurusan');

        $listData = $listData->map(function ($item, $key) {
            $item = $item->map(function ($item2, $key2) {
                $item2->nama_jurusan2 = $item2->nama_jurusan2 ? $item2->nama_jurusan2 : "-";
                return $item2;
            });
            return $item;
        });

        $listppdb = PpdbSettingController::listTahunAjaranGelombang();
        $fillSelectFilter = [
            "list_tahun_ajaran" => $listppdb["listTahunAjaran"],
            "list_gelombang" => $listppdb["listGelombang"]
        ];

        $jurusan = ProgramKeahlian::select('id', 'nama')->get();

        $dataList = [];
        foreach ($jurusan as $key => $value) {
            if (array_key_exists($value->id, $listData->toArray())) {
                $dataList[$value->id] = [
                    "jumlah" => count($listData[$value->id]),
                    "data" => $listData[$value->id]
                ];
            } else {
                $dataList[$value->id] = [
                    "jumlah" => 0,
                    "data" => []
                ];
            }
        }

        return view('cms.pilihan-jurusan', compact('dataList', 'fillSelectFilter', 'jurusan'));
    }

    public function ubahJurusan(Request $request, $id)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:program_keahlian,id'
        ]);

        try {
            $pendaftaran = Pendaftaran::findOrFail($id);

            $calonSiswa = CalonSiswa::findOrFail($pendaftaran->calon_siswa_id);

            $calonSiswa->program_keahlian_id = $request->jurusan_id;
            $calonSiswa->save();
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengubah pilihan jurusan'
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Berhasil mengubah pilihan jurusan'
        ], 200);
    }
}
