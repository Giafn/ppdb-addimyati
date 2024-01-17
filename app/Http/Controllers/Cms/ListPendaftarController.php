<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Master\NominalAdministrasiController;
use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Http\Controllers\Controller;
use App\Models\Akademik;
use App\Models\Alamat;
use App\Models\CalonSiswa;
use App\Models\OrangTua;
use App\Models\Pendaftaran;
use App\Models\Ppdb;
use App\Models\ProgramKeahlian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $statusPembayaran = (string) $request->status_pembayaran;

        $ppdb = PpdbSettingController::getPPDBInfo();
        $tahunAjaranTerakhir = Ppdb::select('tahun_ajaran', 'end_date')->orderBy('end_date', 'desc')
            ->whereDate('end_date', '<=', date("Y-m-d"))
            ->first();
        $tahunAjaranTerakhir = $tahunAjaranTerakhir ? $tahunAjaranTerakhir->tahun_ajaran : null;
        $tahunSelect = $ppdb["ppdbOpen"] ? $ppdb["ppdbOpen"]->tahun_ajaran : $tahunAjaranTerakhir;

        $listData  = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->join('akademik', 'calon_siswa.akademik_id', '=', 'akademik.id')
            ->select('pendaftaran.id', 'pendaftaran.kode AS daftar_kode', 'akademik.nisn', 'calon_siswa.nama_lengkap AS nama_siswa', 'pendaftaran.status_pendaftaran', 'pendaftaran.status_pembayaran', 'ppdb.gelombang', 'pendaftaran.created_at')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('pendaftaran.kode', 'LIKE', '%' . $search . '%')
                    ->orWhere('akademik.nisn', 'LIKE', '%' . $search . '%')
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

        $jurusan = ProgramKeahlian::select('id', 'nama')->get();

        return view('cms.master.list-pendaftar', compact('listData', 'paginationData', 'listStatusPembayaran', 'listStatusData', 'fillSelectFilter', 'jurusan'));
    }

    public function daftarManual(Request $request)
    {
        $request->validate([
            'nisn'       => 'required|numeric|unique:akademik,nisn',
            'nama'       => 'required|string',
        ]);
        $ppdbActive = PpdbSettingController::getPPDBInfo()["ppdbOpen"];
        if (!$ppdbActive) {
            return response()->json([
                'message' => "PPDB belum dibuka"
            ], 422);
        }
        try {
            DB::beginTransaction();

            $akademik = new Akademik();
            $akademik->nisn = $request->nisn;
            $akademik->asal_sekolah = "-";
            $akademik->save();

            $alamat = new Alamat();
            $alamat->provinsi = "-";
            $alamat->kota = "-";
            $alamat->kecamatan = "-";
            $alamat->desa = "-";
            $alamat->jalan = "-";
            $alamat->gang = "-";
            $alamat->rt = 0;
            $alamat->rw = 0;
            $alamat->no_rumah = 0;
            $alamat-> kode_pos = 0;
            $alamat->save();

            $calonSiswa = new CalonSiswa();
            $calonSiswa->nik = "0";
            $calonSiswa->nama_lengkap = $request->nama;
            $calonSiswa->telepon = "0";
            $calonSiswa->jenis_kelamin = "L";
            $calonSiswa->tanggal_lahir = "2000-01-01";
            $calonSiswa->tempat_lahir = "-";
            $calonSiswa->agama = "Islam";
            $calonSiswa->anak_ke = 0;
            $calonSiswa->jml_saudara_kandung = 0;
            $calonSiswa->alamat_id = $alamat->id;
            $calonSiswa->program_keahlian_id = 0;
            $calonSiswa->ukuran_seragam = "L";
            $calonSiswa->akademik_id = $akademik->id;
            $calonSiswa->save();

            $pendaftaran = new Pendaftaran();
            $pendaftaran->calon_siswa_id = $calonSiswa->id;
            $pendaftaran->ppdb_id = $ppdbActive->id;
            $pendaftaran->kode = "PPDB-" . $akademik->nisn;
            $pendaftaran->status_pendaftaran = 1;
            $pendaftaran->status_pembayaran = 1;
            $pendaftaran->jurusan_id1 = 0;
            $pendaftaran->jurusan_id2 = 0;
            $pendaftaran->save();

            $orangTuaAyah = new OrangTua();
            $orangTuaAyah->calon_siswa_id = $calonSiswa->id;
            $orangTuaAyah->jenis = "ayah";
            $orangTuaAyah->nama_lengkap = "-";
            $orangTuaAyah->pekerjaan = "-";
            $orangTuaAyah->pendidikan_terakhir = "-";
            $orangTuaAyah->alamat_id = $alamat->id;
            $orangTuaAyah->tanggungan = 0;
            $orangTuaAyah->agama = "-";
            $orangTuaAyah->save();

            $orangTuaIbu = new OrangTua();
            $orangTuaIbu->calon_siswa_id = $calonSiswa->id;
            $orangTuaIbu->jenis = "ibu";
            $orangTuaIbu->nama_lengkap = "-";
            $orangTuaIbu->pekerjaan = "-";
            $orangTuaIbu->pendidikan_terakhir = "-";
            $orangTuaIbu->alamat_id = $alamat->id;
            $orangTuaIbu->tanggungan = 0;
            $orangTuaIbu->agama = "-";
            $orangTuaIbu->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
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
            $ayah = OrangTua::where('calon_siswa_id', $calonSiswa->id)->where('jenis', 'ayah')->first();
            $ibu = OrangTua::where('calon_siswa_id', $calonSiswa->id)->where('jenis', 'ibu')->first();
            $wali = OrangTua::join('alamat', 'orang_tua_wali.alamat_id', '=', 'alamat.id')
                ->where('calon_siswa_id', $calonSiswa->id)
                ->where('jenis', 'wali')
                ->first();
            
            $alamat = Alamat::where('id', $calonSiswa->alamat_id)->first();

            $data = [
                "pendaftaran" => $pendaftaran,
                "calonSiswa" => $calonSiswa,
                "akademik" => $akademik,
                "orangTuaWali" => [
                    "ayah" => $ayah,
                    "ibu" => $ibu,
                    "wali" => $wali,
                ],
                'alamat' => $alamat
            ];
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => "OK",
            'results' => $data
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $pendaftaran = Pendaftaran::findOrFail($id);
            $calonSiswa = CalonSiswa::where('id', $pendaftaran->calon_siswa_id)->first();
            $akademik = Akademik::where('id', $calonSiswa->akademik_id)->first();
            $orangTua = OrangTua::where('calon_siswa_id', $calonSiswa->id)->get();
            $alamat = Alamat::where('id', $calonSiswa->alamat_id)->first();
            $wali = OrangTua::where('calon_siswa_id', $calonSiswa->id)->where('jenis', 'wali')->first();
            
            if ($wali) {
                $alamatWali = Alamat::where('id', $wali->alamat_id)->first();
                $alamatWali->delete();
            }
            $pendaftaran->delete();
            $calonSiswa->delete();
            $akademik->delete();
            foreach ($orangTua as $key => $value) {
                $value->delete();
            }
            $alamat->delete();
            

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function updateProfile(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            "nik" => "numeric|required",
            "notlpwa" => "numeric|required",
            "nama_lengkap" => "string|required",
            "nama_panggilan" => "string|nullable",
            "jk" => "string|required",
            "taggal_lahir" => "date|required",
            "tempat_lahir" => "string|required",
            "agama" => "string|required",
            "anak_ke" => "numeric|required",
            "jumlah_saudara" => "numeric|required",
            "jumlah_saudara_tiri" => "numeric|nullable",
            "jumlah_saudara_sekolah" => "numeric|nullable",
            "jumlah_saudara_belum_sekolah" => "numeric|nullable",
            "golongan_darah" => "string|nullable",
            "provinsi" => "string|required",
            "kabupaten" => "string|required",
            "kecamatan" => "string|required",
            "desa" => "string|required",
            "jalan" => "string|required",
            "gang" => "string|nullable",
            "rt" => "numeric|required",
            "rw" => "numeric|required",
            "nomor_rumah" => "numeric|required",
            "kode_pos" => "numeric|required",
            "pilihan_jurusan" => "numeric|required",
            "pilihan_jurusan2" => "numeric|required",
            "ukuran_seragam" => "string|required",
            "tinggi_badan" => "numeric|nullable",
            "berat_badan" => "numeric|nullable",
            "penyakit_kronis" => "string|nullable",
            "prestasi" => "string|nullable",
            "keahlian" => "string|nullable",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak valid",
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            $pendaftaran = Pendaftaran::where('id', $id)->first();
            $calonSiswa = CalonSiswa::where('id', $pendaftaran->calon_siswa_id)->first();
            $akademik = Akademik::where('id', $calonSiswa->akademik_id)->first();
            $alamat = Alamat::where('id', $calonSiswa->alamat_id)->first();

            $calonSiswa->nik = $req->nik;
            $calonSiswa->telepon = $req->notlpwa;
            $calonSiswa->nama_lengkap = $req->nama_lengkap;
            $calonSiswa->nama_panggilan = $req->nama_panggilan;
            $calonSiswa->jenis_kelamin = $req->jk;
            $calonSiswa->tanggal_lahir = $req->taggal_lahir;
            $calonSiswa->tempat_lahir = $req->tempat_lahir;
            $calonSiswa->agama = $req->agama;
            $calonSiswa->anak_ke = $req->anak_ke;
            $calonSiswa->jml_saudara_kandung = $req->jumlah_saudara;
            $calonSiswa->jml_saudara_tiri = $req->jumlah_saudara_tiri;
            $calonSiswa->jml_saudara_sekolah = $req->jumlah_saudara_sekolah;
            $calonSiswa->jml_saudara_no_sekolah = $req->jumlah_saudara_belum_sekolah;
            $calonSiswa->berat_badan = $req->berat_badan;
            $calonSiswa->golongan_darah = $req->golongan_darah;
            $calonSiswa->ukuran_seragam = $req->ukuran_seragam;
            $calonSiswa->tinggi_badan = $req->tinggi_badan;
            $calonSiswa->penyakit_kronis = $req->penyakit_kronis;
            $calonSiswa->prestasi = $req->prestasi;
            $calonSiswa->keahlian = $req->keahlian;
            $calonSiswa->save();

            $alamat->provinsi = $req->provinsi;
            $alamat->kota = $req->kabupaten;
            $alamat->kecamatan = $req->kecamatan;
            $alamat->desa = $req->desa;
            $alamat->jalan = $req->jalan;
            $alamat->gang = $req->gang;
            $alamat->rt = $req->rt;
            $alamat->rw = $req->rw;
            $alamat->no_rumah = $req->nomor_rumah;
            $alamat-> kode_pos = $req->kode_pos;
            $alamat->save();

            $pendaftaran->jurusan_id1 = $req->pilihan_jurusan;
            $pendaftaran->jurusan_id2 = $req->pilihan_jurusan2;
            $pendaftaran->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => "ERROR",
                'message' => "Gagal mengubah data siswa, silahkan coba lagi",
                'debug' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function updateAkademik(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            "nisn" => "numeric|required",
            "asal_sekolah" => "string|required",
            "nomor_seri_sttb" => "string|required|min:10",
            "tahun_sttb" => "numeric|required|min:4",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak valid",
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            $akademik = Akademik::where('id', $id)->first();
            $akademik->nisn= $req->nisn;
            $akademik->asal_sekolah = $req->asal_sekolah;
            $akademik->nomor_seri_sttb = $req->nomor_seri_sttb;
            $akademik->tahun_sttb = $req->tahun_sttb;
            $akademik->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => "ERROR",
                'message' => "Gagal mengubah data siswa, silahkan coba lagi",
                'debug' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function updateOrangTua(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            "nama_ayah" => "string|required",
            "pekerjaan_ayah" => "string|required",
            "pendidikan_ayah" => "string|required",
            "nama_ibu" => "string|required",
            "pekerjaan_ibu" => "string|required",
            "pendidikan_ibu" => "string|required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak valid",
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            $calonSiswa = CalonSiswa::where('id', $id)->first();
            $ayah = OrangTua::where('calon_siswa_id', $calonSiswa->id)->where('jenis', 'ayah')->first();
            $ibu = OrangTua::where('calon_siswa_id', $calonSiswa->id)->where('jenis', 'ibu')->first();

            $ayah->nama_lengkap = $req->nama_ayah;
            $ayah->pekerjaan = $req->pekerjaan_ayah;
            $ayah->pendidikan_terakhir = $req->pendidikan_ayah;
            $ayah->save();

            $ibu->nama_lengkap = $req->nama_ibu;
            $ibu->pekerjaan = $req->pekerjaan_ibu;
            $ibu->pendidikan_terakhir = $req->pendidikan_ibu;
            $ibu->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => "ERROR",
                'message' => "Gagal mengubah data Orang Tua, silahkan coba lagi",
                'debug' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);

    }

    public function updateWali(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            "nama_wali" => "string|required",
            "pekerjaan_wali" => "string|required",
            "pendidikan_wali" => "string|required",
            "tanggungan_wali" => "numeric|required",
            "agama_wali" => "string|required",
            "provinsi_wali" => "string|required",
            "kabupaten_wali" => "string|required",
            "kecamatan_wali" => "string|required",
            "desa_wali" => "string|required",
            "jalan_wali" => "string|required",
            "gang_wali" => "string|nullable",
            "rt_wali" => "numeric|required",
            "rw_wali" => "numeric|required",
            "nomor_rumah_wali" => "numeric|required",
            "kode_pos_wali" => "numeric|required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "ERROR",
                'message' => "Data tidak valid",
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $wali = OrangTua::where('calon_siswa_id', $id)
                ->where('jenis', 'wali')
                ->first();

            if ($wali) {
                $alamat = Alamat::where('id', $wali->alamat_id)->first();
            } else {
                $alamat = new Alamat();
            }
            $alamat->provinsi = $req->provinsi_wali;
            $alamat->kota = $req->kabupaten_wali;
            $alamat->kecamatan = $req->kecamatan_wali;
            $alamat->desa = $req->desa_wali;
            $alamat->jalan = $req->jalan_wali;
            $alamat->gang = $req->gang_wali;
            $alamat->rt = $req->rt_wali;
            $alamat->rw = $req->rw_wali;
            $alamat->no_rumah = $req->nomor_rumah_wali;
            $alamat-> kode_pos = $req->kode_pos_wali;
            $alamat->save();
            
            if (!$wali) {
                $wali = new OrangTua();
                $wali->calon_siswa_id = $id;
                $wali->jenis = "wali";
            }

            $wali->nama_lengkap = $req->nama_wali;
            $wali->pekerjaan = $req->pekerjaan_wali;
            $wali->pendidikan_terakhir = $req->pendidikan_wali;
            $wali->alamat_id = $alamat->id;
            $wali->tanggungan = $req->tanggungan_wali;
            $wali->agama = $req->agama_wali;
            $wali->save(); 
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'status' => "ERROR",
                'message' => "Gagal mengubah data Wali, silahkan coba lagi",
                'debug' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

}
