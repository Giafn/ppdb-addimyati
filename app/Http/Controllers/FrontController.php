<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cms\master\NominalAdministrasiController;
use App\Http\Controllers\Cms\master\PpdbSettingController;
use App\Models\Akademik;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\ProgramKeahlian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

        $dataAlamat = [
            "alamat" => $request->alamat,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "desa" => $request->desa,
            "kecamatan" => $request->kecamatan,
            "kota" => $request->kota,
            "provinsi" => $request->provinsi,
            "kode_pos" => $request->kode_pos,
        ];
               
        try {
            DB::beginTransaction();
            $ppdbAktif = PpdbSettingController::getPPDBInfo()['ppdbOpen'];
            $idppdb = $ppdbAktif->id;

            $pendaftaran = new Pendaftaran();
            $pendaftaran->ppdb_id = $idppdb;
            $pendaftaran->kode = "PPDB-" . $request->nisn;
            $pendaftaran->status_pendaftaran = 1;
            $pendaftaran->status_pembayaran = 1;
            $pendaftaran->nominal_pembayaran = NominalAdministrasiController::hitungNominal($ppdbAktif->gelombang);
            $pendaftaran->jurusan_id1 = $request->jurusan;
            $pendaftaran->jurusan_id2 = $request->jurusan2;

            $akademik = new Akademik();
            $akademik->nisn = $request->nisn;
            $akademik->asal_sekolah = $request->asal_sekolah;
            $akademik->alamat_sekolah = $request->alamat_sekolah;

            $calonSiswa = new CalonSiswa();
            $calonSiswa->nama_lengkap = $request->nama_lengkap;
            $calonSiswa->nik = $request->nik;
            $calonSiswa->ttl = $request->tanggal_lahir;
            $calonSiswa->jenis_kelamin = $request->jenis_kelamin;
            $calonSiswa->alamat_lengkap = $this->createAlamat($dataAlamat);
            $calonSiswa->agama = $request->agama;
            $calonSiswa->telepon = $request->no_hp;
 
            $akademik->save();
            $calonSiswa->akademik_id = $akademik->id;
            $calonSiswa->user_id = 0;
            $calonSiswa->save();
            $pendaftaran->calon_siswa_id = $calonSiswa->id;
            $pendaftaran->save();
            DB::commit();
            return view('front.pendaftaran-berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('front.pendaftaran-gagal');
        }

    }

    private function createAlamat($dataAlamat = [])
    {
        $alamatLengkap = "";
        foreach ($dataAlamat as $key => $value) {
            $key = $key == "kode_pos" ? "kode pos" : $key;
            $value = $key == "rt" || $key == "rw" ? str_pad((int) $value, 2, "0", STR_PAD_LEFT) : $value;
            if ($key == "alamat" || $key == "kota" || $key == "provinsi") {
                $alamatLengkap = $key != "alamat" ? $alamatLengkap . ", ": $alamatLengkap;
                $alamatLengkap .= ucwords(strtolower($value));
            } else {
                $alamatLengkap .= ", ". ucwords(strtolower($key)) . " " . ucwords(strtolower($value));
            }
        }
        return $alamatLengkap;
    }

    private function validateDaftar($request)
    {
        $data = null;
        $validator = Validator::make($request->all(),[
            'nama_lengkap' => 'required|string',
            'nik' => 'required|nik',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|min:3',
            'jenis_kelamin' => 'required|string|in:l,p',
            'kecamatan' => 'required|string|min:3',
            'kota' => 'required|string|min:3',
            'provinsi' => 'required|string|min:3',
            'desa' => 'required|string|min:3',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'jalan' => 'required|string|min:3',
            'gang' => 'nullable|string',
            'no_rumah' => 'required|string',
            'kode_pos' => 'required|string',
            'agama' => 'required|string',
            'no_hp' => 'required|string',
            'saudara' => 'required|numeric',
            'saudara_tiri' => 'nullable|numeric',
            'sudah_sekolah' => 'nullable|numeric',
            'belum_sekolah' => 'nullable|numeric',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'pendidikan_ayah' => 'required|string',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'agama_ayah' => 'required|string',
            'agama_ibu' => 'required|string',
            'tanggungan_keluarga' => 'required|numeric',
            'nisn' => 'required|string',
            'asal_sekolah' => 'required|string',
            'no_sttb' => 'required|string',
            'tahun_sttb' => 'required|string',
            'program_studi' => 'required|string',
            'program_studi_pilihan_2' => 'nullable|string',
            'tinggi_badan' => 'nullable|string',
            'berat_badan' => 'nullable|string',
            'golongan_darah' => 'nullable|string',
            'rhesus' => 'nullable|string|in:-,+',
            'penyakit_kronis' => 'nullable|string',
            'cita_cita' => 'nullable|string',
            'hobi' => 'nullable|string',
            'prestasi' => 'nullable|string',
            'keahlian' => 'nullable|string',
            'ukuran_seragam' => 'required|string',
            'referensi' => 'nullable|string'
        ]);

        $validator1 = Validator::make($request->all(),[
            'nama_lengkap' => 'required|string',
            'nik' => 'required|nik',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|min:3',
            'jenis_kelamin' => 'required|string|in:l,p',
            'kecamatan' => 'required|string|min:3',
            'kota' => 'required|string|min:3',
            'provinsi' => 'required|string|min:3',
            'desa' => 'required|string|min:3',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'jalan' => 'required|string|min:3',
            'gang' => 'nullable|string',
            'no_rumah' => 'required|string',
            'kode_pos' => 'required|string',
            'agama' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        if ($validator1->fails()) {
            return [
                "page" => "1",
                "validator" => $validator
            ];
        }

        $validator2 = Validator::make($request->all(),[
            'saudara' => 'required|numeric',
            'saudara_tiri' => 'nullable|numeric',
            'sudah_sekolah' => 'nullable|numeric',
            'belum_sekolah' => 'nullable|numeric',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'pendidikan_ayah' => 'required|string',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'agama_ayah' => 'required|string',
            'agama_ibu' => 'required|string',
            'tanggungan_keluarga' => 'required|numeric',
        ]);

        if ($request->walicek) {
            $validator2->addRules([
                'nama_wali' => 'required|string',
                'pendidikan_wali' => 'required|string',
                'pekerjaan_wali' => 'required|string',
                'agama_wali' => 'required|string',
                'kecamatan_wali' => 'required|string',
                'kota_wali' => 'required|string',
                'provinsi_wali' => 'required|string',
                'desa_wali' => 'required|string',
                'rt_wali' => 'required|string',
                'rw_wali' => 'required|string',
                'jalan_wali' => 'required|string',
                'gang_wali' => 'nullable|string',
                'no_rumah_wali' => 'required|string',
                'kode_pos_wali' => 'required|string',
            ]);

            $validator->addRules([
                'nama_wali' => 'required|string',
                'pendidikan_wali' => 'required|string',
                'pekerjaan_wali' => 'required|string',
                'agama_wali' => 'required|string',
                'kecamatan_wali' => 'required|string',
                'kota_wali' => 'required|string',
                'provinsi_wali' => 'required|string',
                'desa_wali' => 'required|string',
                'rt_wali' => 'required|string',
                'rw_wali' => 'required|string',
                'jalan_wali' => 'required|string',
                'gang_wali' => 'nullable|string',
                'no_rumah_wali' => 'required|string',
                'kode_pos_wali' => 'required|string',
            ]);
        }

        if ($validator2->fails()) {
            return [
                "page" => "2",
                "validator" => $validator
            ];
        }

        $validator3 = Validator::make($request->all(),[
            'nisn' => 'required|string',
            'asal_sekolah' => 'required|string',
            'no_sttb' => 'required|string',
            'tahun_sttb' => 'required|string',
            'program_studi' => 'required|string',
            'program_studi_pilihan_2' => 'required|string',
        ]);

        if ($validator3->fails()) {
            return [
                "page" => "3",
                "validator" => $validator
            ];
        }

        $validator4 = Validator::make($request->all(),[
            'tinggi_badan' => 'required|string',
            'berat_badan' => 'required|string',
            'golongan_darah' => 'required|string',
            'rhesus' => 'required|string',
            'penyakit_kronis' => 'required|string',
            'cita_cita' => 'required|string',
            'hobi' => 'required|string',
            'prestasi' => 'required|string',
            'keahlian' => 'required|string',
            'ukuran_seragam' => 'required|string',
            'referensi' => 'required|string'
        ]);

        if ($validator4->fails()) {
            return [
                "page" => "4",
                "validator" => $validator
            ];
        }

        return $data;
    }
}
