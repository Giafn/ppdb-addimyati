<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NikParse\Nik;
use App\Jobs\SendNotifEmailJob;
use App\Models\Akademik;
use App\Models\Alamat;
use App\Models\AlurPendaftaran;
use App\Models\CalonSiswa;
use App\Models\Faq;
use App\Models\OrangTua;
use App\Models\Pendaftaran;
use App\Models\ProgramKeahlian;
use App\Models\SubsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function informasi()
    {
        $ppdb = PpdbSettingController::getPPDBInfo();
        $ppdbNext = $ppdb['ppdbNext'] ? date('d F Y', strtotime($ppdb['ppdbNext'])) : null;
        $ppdbAktif = $ppdb['ppdbOpen'] ? $ppdb['ppdbOpen']->toArray() : null;
        
        if ($ppdbAktif) {
            $ppdbAktif['start_date'] = date('d F Y', strtotime($ppdbAktif['start_date']));
            $ppdbAktif['end_date'] = date('d F Y', strtotime($ppdbAktif['end_date']));
        }
        
        return view('front.info', compact('ppdbAktif', 'ppdbNext'));
    }

    public function pendaftaran()
    {
        $ppdb = PpdbSettingController::getPPDBInfo();
        $dataPpdb = $ppdb['ppdbOpen'] ? $ppdb['ppdbOpen']->toArray() : null;
        
        if ($dataPpdb) {
            $dataPpdb['start_date'] = date('d F Y', strtotime($dataPpdb['start_date']));
            $dataPpdb['end_date'] = date('d F Y', strtotime($dataPpdb['end_date']));
        } else {
            return redirect()->route('ppdb');
        }
        $jurusan = ProgramKeahlian::all();
        return view('front.pendaftaran', compact('jurusan', 'dataPpdb'));
    }

    public function storePendaftaran(Request $request)
    { 
        $validator = $this->validateDaftar($request);
        if ($validator != null) {
            return redirect()->back()->withErrors($validator['validator'])->withInput()->with('page', $validator['page']);
        }
               
        try {
            DB::beginTransaction();
            $ppdbAktif = PpdbSettingController::getPPDBInfo()['ppdbOpen'];
            $idppdb = $ppdbAktif->id;

            $alamatSiswa = new Alamat();
            $alamatSiswa->kecamatan = $request->kecamatan;
            $alamatSiswa->kota = $request->kota;
            $alamatSiswa->provinsi = $request->provinsi;
            $alamatSiswa->desa = $request->desa;
            $alamatSiswa->rt = $request->rt;
            $alamatSiswa->rw = $request->rw;
            $alamatSiswa->jalan = $request->jalan;
            $alamatSiswa->gang = $request->gang;
            $alamatSiswa->no_rumah = $request->no_rumah;
            $alamatSiswa->kode_pos = $request->kode_pos;
            $alamatSiswa->save();

            $pendaftaran = new Pendaftaran();
            $pendaftaran->ppdb_id = $idppdb;
            $pendaftaran->kode = "PPDB-" . $request->nisn;
            $pendaftaran->status_pendaftaran = 1;
            $pendaftaran->status_pembayaran = 0;
            $pendaftaran->jurusan_id1 = $request->program_studi;
            $pendaftaran->jurusan_id2 = $request->program_studi_pilihan_2;
            $pendaftaran->referensi = $request->referensi;

            $akademik = new Akademik();
            $akademik->nisn = $request->nisn;
            $akademik->asal_sekolah = $request->asal_sekolah;
            $akademik->nomor_seri_sttb = $request->no_sttb;
            $akademik->tahun_sttb = $request->tahun_sttb;
            $akademik->save();

            $calonSiswa = new CalonSiswa();
            $calonSiswa->akademik_id = $akademik->id;
            $calonSiswa->nik = $request->nik;
            $calonSiswa->telepon = $request->no_hp;
            $calonSiswa->nama_lengkap = $request->nama_lengkap;
            $calonSiswa->nama_panggilan = $request->nama_panggilan;
            $calonSiswa->jenis_kelamin = $request->jenis_kelamin;
            $calonSiswa->tanggal_lahir = $request->tanggal_lahir;
            $calonSiswa->tempat_lahir = $request->tempat_lahir;
            $calonSiswa->alamat_id = $alamatSiswa->id;
            $calonSiswa->agama = $request->agama;
            $calonSiswa->anak_ke = $request->anak_ke;
            $calonSiswa->ukuran_seragam = $request->ukuran_seragam;
            $calonSiswa->tinggi_badan = $request->tinggi_badan;
            $calonSiswa->berat_badan = $request->berat_badan;
            $calonSiswa->golongan_darah = $request->golongan_darah . $request->rhesus;
            $calonSiswa->penyakit_kronis = $request->penyakit_kronis;
            $calonSiswa->cita_cita = $request->cita_cita;
            $calonSiswa->hobi = $request->hobi;
            $calonSiswa->prestasi = $request->prestasi;
            $calonSiswa->keahlian = $request->keahlian;
            $calonSiswa->jml_saudara_kandung = $request->saudara;
            $calonSiswa->jml_saudara_tiri = $request->saudara_tiri;
            $calonSiswa->jml_saudara_sekolah = $request->sudah_sekolah;
            $calonSiswa->jml_saudara_no_sekolah = $request->belum_sekolah;
            $calonSiswa->program_keahlian_id = $request->program_studi;
            $calonSiswa->save();

            $ibu = new OrangTua();
            $ibu->jenis = "ibu";
            $ibu->nama_lengkap = $request->nama_ibu;
            $ibu->pendidikan_terakhir = $request->pendidikan_ibu;
            $ibu->pekerjaan = $request->pekerjaan_ibu;
            $ibu->agama = $request->agama_ibu;
            $ibu->tanggungan = $request->tanggungan_keluarga;
            $ibu->calon_siswa_id = $calonSiswa->id;
            $ibu->alamat_id = $alamatSiswa->id;
            $ibu->save();

            $ayah = new OrangTua();
            $ayah->jenis = "ayah";
            $ayah->nama_lengkap = $request->nama_ayah;
            $ayah->pendidikan_terakhir = $request->pendidikan_ayah;
            $ayah->pekerjaan = $request->pekerjaan_ayah;
            $ayah->agama = $request->agama_ayah;
            $ayah->tanggungan = $request->tanggungan_keluarga;
            $ayah->calon_siswa_id = $calonSiswa->id;
            $ayah->alamat_id = $alamatSiswa->id;
            $ayah->save();

            $pendaftaran->calon_siswa_id = $calonSiswa->id;
            $pendaftaran->save();

            if ($request->walicek == "on") {
                $alamatWali = new Alamat();
                $alamatWali->kecamatan = $request->kecamatan_wali;
                $alamatWali->kota = $request->kota_wali;
                $alamatWali->provinsi = $request->provinsi_wali;
                $alamatWali->desa = $request->desa_wali;
                $alamatWali->rt = $request->rt_wali;
                $alamatWali->rw = $request->rw_wali;
                $alamatWali->jalan = $request->jalan_wali;
                $alamatWali->gang = $request->gang_wali;
                $alamatWali->no_rumah = $request->no_rumah_wali;
                $alamatWali->kode_pos = $request->kode_pos_wali;
                $alamatWali->save();

                $wali = new OrangTua();
                $wali->jenis = "wali";
                $wali->nama_lengkap = $request->nama_wali;
                $wali->pendidikan_terakhir = $request->pendidikan_wali;
                $wali->pekerjaan = $request->pekerjaan_wali;
                $wali->agama = $request->agama_wali;
                $wali->tanggungan = $request->tanggungan_keluarga;
                $wali->calon_siswa_id = $calonSiswa->id;
                $wali->alamat_id = $alamatWali->id;
                $wali->save();
            }

            DB::commit();
            return view('front.pendaftaran-berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return view('front.pendaftaran-gagal');
        }

    }

    public function flowDaftar()
    {
        $ppdb = PpdbSettingController::getPPDBInfo();
        $ppdbAktif = $ppdb['ppdbOpen'] ? $ppdb['ppdbOpen']->toArray() : null;

        $dataAlur = AlurPendaftaran::all();
        $faq = Faq::all();
        return view('front.flow-ppdb', compact('dataAlur', 'faq', 'ppdbAktif'));
    }

    public function indexCekData()
    {
        return view('front.cek-data');
    }

    public function cekData(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nik' => 'required|min:16|numeric',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|min:10|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 200);
        }

        // $cekNik = new Nik($req->nik);
        // if (!$cekNik->isValid()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'NIK tidak valid'
        //     ], 422);
        // }

        $data = Pendaftaran::join('calon_siswa', 'pendaftaran.calon_siswa_id', '=', 'calon_siswa.id')
            ->join('akademik', 'calon_siswa.akademik_id', '=', 'akademik.id')
            ->join('program_keahlian', 'pendaftaran.jurusan_id1', '=', 'program_keahlian.id')
            ->where('calon_siswa.nik', $req->nik)
            ->where('akademik.nisn', $req->nisn)
            ->where('calon_siswa.tanggal_lahir', $req->tanggal_lahir)
            ->select('pendaftaran.kode','program_keahlian.nama As jurusan', 'pendaftaran.referensi', 'pendaftaran.created_at As tanggal_daftar', 'calon_siswa.nama_lengkap', 'akademik.asal_sekolah', 'calon_siswa.jenis_kelamin', 'calon_siswa.tempat_lahir', 'calon_siswa.tanggal_lahir', 'calon_siswa.agama', 'pendaftaran.status_pendaftaran', 'pendaftaran.status_pembayaran')
            ->first();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 200);
        }

        $data->tanggal_lahir_formated = date('d F Y', strtotime($data->tanggal_lahir));

        unset($data->tanggal_lahir);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function subEmail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first('email')
            ], 422);
        }

        if (SubsEmail::where('email', $request->email)->first()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email sudah terdaftar'
            ], 422);
        }

        try {
            DB::beginTransaction();
            $subEmail = new SubsEmail();
            $subEmail->email = $request->email;
            $subEmail->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil subscribe email'
        ]);
    }

    private function validateDaftar($request)
    {
        $data = null;
        $validator = Validator::make($request->all(),[
            'nama_lengkap' => 'required|alpha_space',
            'nik' => 'required|unique:calon_siswa,nik|min:16|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|alpha_space|min:3',
            'jenis_kelamin' => 'required|alpha_space|in:l,p',
            'kecamatan' => 'required|alpha_space|min:3',
            'kota' => 'required|alpha_space|min:3',
            'provinsi' => 'required|alpha_space|min:3',
            'desa' => 'required|alpha_space|min:3',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'jalan' => 'required|alpha_space|min:3',
            'gang' => 'nullable|alpha_space',
            'no_rumah' => 'required|numeric',
            'kode_pos' => 'required|numeric',
            'agama' => 'required|alpha_space',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'anak_ke' => 'required|numeric',
            'saudara' => 'required|numeric',
            'saudara_tiri' => 'nullable|numeric',
            'sudah_sekolah' => 'nullable|numeric',
            'belum_sekolah' => 'nullable|numeric',
            'nama_ayah' => 'required|alpha_space',
            'nama_ibu' => 'required|alpha_space',
            'pendidikan_ayah' => 'required|alpha_space',
            'pendidikan_ibu' => 'required|alpha_space',
            'pekerjaan_ayah' => 'required|alpha_space',
            'pekerjaan_ibu' => 'required|alpha_space',
            'agama_ayah' => 'required|alpha_space',
            'agama_ibu' => 'required|alpha_space',
            'tanggungan_keluarga' => 'required|numeric',
            'nisn' => 'required|numeric|unique:akademik,nisn|min:10',
            'asal_sekolah' => 'required|alpha_space',
            'no_sttb' => 'required|string|unique:akademik,nomor_seri_sttb|min:15|max:25',
            'tahun_sttb' => 'required|numeric|min:1000|max:9999',
            'program_studi' => 'required|numeric',
            'program_studi_pilihan_2' => 'nullable|numeric|different:program_studi',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'golongan_darah' => 'nullable|string|max:1',
            'rhesus' => 'nullable|string|in:-,+',
            'penyakit_kronis' => 'nullable|alpha_space',
            'cita_cita' => 'nullable|alpha_space',
            'hobi' => 'nullable|alpha_space',
            'prestasi' => 'nullable|alpha_space',
            'keahlian' => 'nullable|alpha_space',
            'ukuran_seragam' => 'required|alpha_space',
            'referensi' => 'nullable|alpha_space'
        ]);

        if ($request->walicek) {
            $validator->addRules([
                'nama_wali' => 'required|alpha_space',
                'pendidikan_wali' => 'required|alpha_space',
                'pekerjaan_wali' => 'required|alpha_space',
                'agama_wali' => 'required|alpha_space',
                'kecamatan_wali' => 'required|alpha_space',
                'kota_wali' => 'required|alpha_space',
                'provinsi_wali' => 'required|alpha_space',
                'desa_wali' => 'required|alpha_space',
                'rt_wali' => 'required|numeric',
                'rw_wali' => 'required|numeric',
                'jalan_wali' => 'required|alpha_space',
                'gang_wali' => 'nullable|alpha_space',
                'no_rumah_wali' => 'required|numeric',
                'kode_pos_wali' => 'required|numeric',
            ]);
        }

        if ($validator->fails()) {
            $page1 = [
                'nama_lengkap', 'nik', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'kecamatan', 'kota', 'provinsi', 'desa', 'rt', 'rw', 'jalan', 'gang', 'no_rumah', 'kode_pos', 'agama', 'no_hp'
            ];
            foreach ($page1 as $value) {
                if ($validator->errors()->has($value)) {
                    return [
                        "page" => "1",
                        "validator" => $validator
                    ];
                    break;
                }
            }

            $page2 = ['anak_ke','saudara', 'saudara_tiri', 'sudah_sekolah', 'belum_sekolah', 'nama_ayah', 'nama_ibu', 'pendidikan_ayah', 'pendidikan_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'agama_ayah', 'agama_ibu', 'tanggungan_keluarga', 'nama_wali', 'pendidikan_wali', 'pekerjaan_wali', 'agama_wali', 'kecamatan_wali', 'kota_wali', 'provinsi_wali', 'desa_wali', 'rt_wali', 'rw_wali', 'jalan_wali', 'gang_wali', 'no_rumah_wali', 'kode_pos_wali'];
            foreach ($page2 as $value) {
                if ($validator->errors()->has($value)) {
                    return [
                        "page" => "2",
                        "validator" => $validator
                    ];
                    break;
                }
            }

            $page3 = ['nisn', 'asal_sekolah', 'no_sttb', 'tahun_sttb', 'program_studi', 'program_studi_pilihan_2'];
            foreach ($page3 as $value) {
                if ($validator->errors()->has($value)) {
                    return [
                        "page" => "3",
                        "validator" => $validator
                    ];
                    break;
                }
            }

            $page4 = ['tinggi_badan', 'berat_badan', 'golongan_darah', 'rhesus', 'penyakit_kronis', 'cita_cita', 'hobi', 'prestasi', 'keahlian', 'ukuran_seragam', 'referensi'];
            foreach ($page4 as $value) {
                if ($validator->errors()->has($value)) {
                    return [
                        "page" => "4",
                        "validator" => $validator
                    ];
                    break;
                }
            }
        }

        $cekNik = new Nik($request->nik);
        if (!$cekNik->isValid()) {
            return [
                "page" => "1",
                "validator" => Validator::make([],[])
                    ->after(function ($validator) {
                        $validator->errors()->add('nik', 'NIK tidak valid.');
                    })
            ];
        }

        return $data;
    }
}
