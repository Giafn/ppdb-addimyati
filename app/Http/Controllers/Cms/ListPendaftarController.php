<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\master\NominalAdministrasiController;
use App\Http\Controllers\Cms\master\PpdbSettingController;
use App\Http\Controllers\Controller;
use App\Models\Akademik;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListPendaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:listPendaftar,hak-akses']);
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
        $statusPembayaran = $request->status_pembayaran;


        $listData  = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->join('users', 'calon_siswa.user_id', '=', 'users.id')
            ->join('akademik', 'calon_siswa.akademik_id', '=', 'akademik.id')
            ->select('pendaftaran.id', 'pendaftaran.kode AS daftar_kode', 'akademik.nisn', 'calon_siswa.nama_lengkap AS nama_siswa', 'users.email', 'pendaftaran.status_pendaftaran', 'pendaftaran.status_pembayaran', 'ppdb.gelombang', 'pendaftaran.created_at')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('pendaftaran.kode', 'LIKE', '%' . $search . '%')
                    ->orWhere('akademik.nisn', 'LIKE', '%' . $search . '%')
                    ->orWhere('calon_siswa.nama_lengkap', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $search . '%');
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
            ->when(!empty($statusPembayaran), function ($query) use ($statusPembayaran) {
                $query->where('pendaftaran.status_pembayaran', $statusPembayaran);
            })
            ->orderBy('pendaftaran.id', 'desc')
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
            "1" => [
                "text" => "Belum Bayar",
            ],
            "2" => [
                "text" => "Belum Lunas",
            ],
            "3" => [
                "text" => "Lunas",
            ]
        ];

        $listStatusData = [
            "1" => [
                "text" => "Belum Lengkap",
            ],
            "2" => [
                "text" => "Sudah Lengkap",
            ]
        ];


        $listppdb = PpdbSettingController::listTahunAjaranGelombang();
        $fillSelectFilter = [
            "status_pembayaran" => $listStatusPembayaran,
            "status_pendaftaran" => $listStatusData,
            "list_tahun_ajaran" => $listppdb["listTahunAjaran"],
            "list_gelombang" => $listppdb["listGelombang"]
        ];

        return view('cms.master.list-pendaftar', compact('listData', 'paginationData', 'listStatusPembayaran', 'listStatusData', 'fillSelectFilter'));
    }

    public function daftarManual(Request $request)
    {
        $request->validate([
            'nisn'       => 'required|numeric|unique:akademik,nisn',
            'nama'       => 'required',
            'email'      => 'required|email|unique:users,email'
        ]);
        $ppdbActive = PpdbSettingController::getPPDBInfo()["ppdbOpen"];
        if (!$ppdbActive) {
            return response()->json([
                'message' => "PPDB belum dibuka"
            ], 422);
        }
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->nisn);
            $user->user_level_id = 5;
            $user->flag_active = 0;
            $user->save();

            $idUser = $user->id;

            $akademik = new Akademik();
            $akademik->nisn = $request->nisn;
            $akademik->save();

            $calonSiswa = new CalonSiswa();
            $calonSiswa->nama_lengkap = $request->nama;
            $calonSiswa->user_id = $idUser;
            $calonSiswa->akademik_id = $akademik->id;
            $calonSiswa->save();

            $pendaftaran = new Pendaftaran();
            $pendaftaran->calon_siswa_id = $calonSiswa->id;
            $pendaftaran->ppdb_id = $ppdbActive->id;
            $pendaftaran->nominal_pembayaran = NominalAdministrasiController::hitungNominal($ppdbActive->gelombang);
            $pendaftaran->kode = "PPDB-" . $akademik->nisn;
            $pendaftaran->status_pendaftaran = 1;
            $pendaftaran->status_pembayaran = 1;
            $pendaftaran->jurusan_id1 = 0;
            $pendaftaran->jurusan_id2 = 0;
            $pendaftaran->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => "Gagal menambahkan data siswa, silahkan coba lagi",
                'debug' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function detail($id)
    {
        try {
            $pendaftaran = Pendaftaran::where('id', $id)->first();
            $calonSiswa = CalonSiswa::where('id', $pendaftaran->calon_siswa_id)->first();
            $akademik = Akademik::where('id', $calonSiswa->akademik_id)->first();
            $user = User::where('id', $calonSiswa->user_id)->first();

            $data = [
                "pendaftaran" => $pendaftaran,
                "calonSiswa" => $calonSiswa,
                "akademik" => $akademik,
                "user" => $user
            ];
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => "OK",
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            $calonSiswa = null;
            if ($pendaftaran) {
                $calonSiswa = CalonSiswa::findOrFail($pendaftaran->calon_siswa_id);
            }
            if ($calonSiswa) {
                $akademik = Akademik::findOrFail($calonSiswa->akademik_id);
                $user = User::findOrFail($calonSiswa->user_id);
                $calonSiswa->delete();
                $akademik->delete();
                $user->delete();
            }
            $pendaftaran->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    // public function fillSelectfilter()
    // {
    //     $listTahunAjaran =
    // }
}
