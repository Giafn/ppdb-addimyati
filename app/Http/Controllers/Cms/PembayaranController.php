<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Http\Controllers\Controller;
use App\Models\PembayaranHistory;
use App\Models\Pendaftaran;
use App\Models\Ppdb;
use App\Models\ProgramKeahlian;
use App\Models\SiswaPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:pembayaran,hak-akses']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'serach' => 'nullable',
            "tahun_ajaran" => "nullable",
            "gelombang" => "nullable",
            "status_data" => "nullable",
            "status_pembayaran" => "nullable"
        ]);

        $search = $request->search;
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

        $listData  = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->leftJoin('siswa_pembayaran', 'pendaftaran.calon_siswa_id', '=', 'siswa_pembayaran.siswa_id')
            ->select('pendaftaran.id', 'pendaftaran.kode AS daftar_kode', 'calon_siswa.nama_lengkap AS nama_siswa', 'pendaftaran.status_pendaftaran', 'pendaftaran.status_pembayaran', 'ppdb.gelombang', 'pendaftaran.created_at', 'siswa_pembayaran.total', 'siswa_pembayaran.sisa')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('pendaftaran.kode', 'LIKE', '%' . $search . '%')
                    ->orWhere('calon_siswa.nama_lengkap', 'LIKE', '%' . $search . '%');
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
            ->when(!empty($statusData), function ($query) use ($statusData) {
                $query->where('pendaftaran.status_pendaftaran', $statusData);
            })
            ->when($statusPembayaran != null, function ($query) use ($statusPembayaran) {
                $query->where('pendaftaran.status_pembayaran', $statusPembayaran);
            })
            ->orderBy('pendaftaran.status_pembayaran', 'asc')
            ->orderBy('pendaftaran.created_at', 'desc')
            ->paginate(30);

        $listData->appends($request->input());

        $totalData = $listData->total();
        $firstData = ($listData->currentPage() - 1) * $listData->perPage();
        $lastData  = ($firstData + $listData->perPage()) > $totalData ? $totalData : ($firstData + $listData->perPage());

        $paginationData = [
            'first' => $firstData,
            'last'  => $lastData,
            'total' => $totalData,
            'prev_page_url' => $listData->previousPageUrl(),
            'next_page_url' => $listData->nextPageUrl(),
        ];

        $listStatusPembayaran = [
            "0" => [
                "text" => "Belum Bayar",
            ],
            "1" => [
                "text" => "Belum Lunas",
            ],
            "2" => [
                "text" => "Lunas",
            ]
        ];


        $listppdb = PpdbSettingController::listTahunAjaranGelombang();
        $fillSelectFilter = [
            "status_pembayaran" => $listStatusPembayaran,
            "list_tahun_ajaran" => $listppdb["listTahunAjaran"],
            "list_gelombang" => $listppdb["listGelombang"]
        ];

        $jurusan = ProgramKeahlian::select('id', 'nama')->get();

        return view('cms.pembayaran', compact('listData', 'paginationData', 'listStatusPembayaran', 'fillSelectFilter', 'jurusan'));
    }

    public function showInfoAndHistory($id)
    {
        $query = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->leftJoin('siswa_pembayaran', 'pendaftaran.calon_siswa_id', '=', 'siswa_pembayaran.siswa_id')
            ->select('pendaftaran.id', 'pendaftaran.kode AS daftar_kode', 'calon_siswa.nama_lengkap AS nama_siswa', 'pendaftaran.status_pendaftaran', 'pendaftaran.status_pembayaran', 'pendaftaran.created_at', 'siswa_pembayaran.total', 'siswa_pembayaran.sisa', 'siswa_pembayaran.id AS id_pembayaran')
            ->where('pendaftaran.id', $id)
            ->first();
        
        if(!$query) {
            return [
                "status" => "ERROR",
                "message" => "Data tidak ditemukan"
            ];
        }

        $historyPembayaran = [];
        if ($query->total != null) {
            $historyPembayaran = PembayaranHistory::where('pembayaran_id', $query->id_pembayaran)
                ->orderBy('created_at', 'desc')
                ->get();
            $historyPembayaran = $historyPembayaran->map(function ($item) {
                $item->tgl_bayar = date("d-m-Y H:i", strtotime($item->created_at));
                return $item;
            });
        }
        
        $data = [
            "nama" => $query->nama_siswa,
            "status_kode" => $query->status_pembayaran,
            "status_pembayaran" => $query->status_pembayaran == 0 ? "Belum Bayar" : ($query->status_pembayaran == 1 ? "Belum Lunas" : "Lunas"),
            "total_pembayaran" => $query->total,
            "sisa_pembayaran" => $query->sisa,
            "history_pembayaran" => $historyPembayaran
        ];
        
        return [
            "status" => "OK",
            "results" => [
                "id" => $id,
                "nama" => $data["nama"],
                "status_kode" => $data["status_kode"],
                "status_pembayaran" => $data["status_pembayaran"],
                "total_pembayaran" => $data["total_pembayaran"],
                "sisa_pembayaran" => $data["sisa_pembayaran"],
                "history_pembayaran" => $data["history_pembayaran"]
            ]
        ];
    }

    public function setHarga(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            "total_bayar" => "numeric|required|min:100000"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak valid",
                'errors' => $validator->errors()
            ], 422);
        }
        $pendaftaran = Pendaftaran::where('pendaftaran.id', $id)->first();
        if(!$pendaftaran) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak ditemukan",
                'errors' => []
            ], 404);
        }

        $pembayaran = SiswaPembayaran::where('siswa_id', $pendaftaran->calon_siswa_id)->first();
        if ($pembayaran) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data sudah ada",
                'errors' => []
            ], 422);
        }
        try {
            SiswaPembayaran::create([
                "siswa_id" => $pendaftaran->calon_siswa_id,
                "total" => $req->total_bayar,
                "sisa" => $req->total_bayar
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => "ERROR",
                'message' => "Terjadi kesalahan saat menyimpan data",
                'errors' => $th->getMessage()
            ], 500);
        }

        return $this->showInfoAndHistory($id);
    }

    public function bayar(Request $req, $id) {
        $validator = Validator::make($req->all(), [
            "nominal_bayar" => "numeric|required",
            "keterangan" => "nullable|string|max:50"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak valid",
                'errors' => $validator->errors()
            ], 422);
        }
        $pendaftaran = Pendaftaran::where('pendaftaran.id', $id)->first();
        if(!$pendaftaran) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak ditemukan",
                'errors' => []
            ], 404);
        }
        $pembayaran = SiswaPembayaran::where('siswa_id', $pendaftaran->calon_siswa_id)->first();
        if(!$pembayaran) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak ditemukan",
                'errors' => []
            ], 404);
        }
        
        if ($pendaftaran->status_pembayaran == 2) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Sudah lunas",
                'errors' => []
            ], 422);
        }
        if ($req->nominal_bayar > $pembayaran->sisa) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Nominal pembayaran melebihi sisa pembayaran",
                'errors' => []
            ], 422);
        }
        $historyPembayaran = new PembayaranHistory();
        try {
            DB::beginTransaction();
            $historyPembayaran->pembayaran_id = $pembayaran->id;
            $historyPembayaran->jumlah = $req->nominal_bayar;
            $historyPembayaran->keterangan = $req->keterangan;
            $historyPembayaran->admin_id = auth()->user()->id;
            $historyPembayaran->save();

            $pembayaran->sisa = $pembayaran->sisa - $req->nominal_bayar;
            $pembayaran->save();

            $pendaftaran->status_pembayaran = $pembayaran->sisa <= 0 ? 2 : 1;
            $pendaftaran->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => "ERROR",
                'message' => "Terjadi kesalahan saat menyimpan data",
                'errors' => $th->getMessage()
            ], 500);
        }

        return $this->showInfoAndHistory($id);
    }
}
