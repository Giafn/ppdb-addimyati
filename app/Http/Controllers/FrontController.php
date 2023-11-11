<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cms\master\PpdbSettingController;
use App\Models\Akademik;
use App\Models\CalonSiswa;
use App\Models\ProgramKeahlian;
use App\Models\User;
use Illuminate\Http\Request;
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
        $validator = Validator::make($request->all(),[
            "nama_lengkap" => "required",
            "nik" => "required | numeric | digits:16",
            "tanggal_lahir" => "required | date",
            "jenis_kelamin" => "required",
            "kecamatan" => "required",
            "kota" => "required",
            "provinsi" => "required",
            "kode_pos" => "required",
            "desa" => "required",
            "rt" => "required",
            "rw" => "required",
            "alamat" => "required",
            "agama" => "required",
            "no_hp" => "required",
            "email" => "required | email | unique:users,email",
            "nisn" => "required",
            "asal_sekolah" => "required",
            "alamat_sekolah" => "required",
            "jurusan" => "required",
            "jurusan2" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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

        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = bcrypt($request->nisn);
        $user->flag_active = 0;
        $user->user_level_id = 5;

        try {
            $akademik->save();
            $calonSiswa->akademik_id = $akademik->id;
            $user->save();
            $calonSiswa->user_id = $user->id;
            $calonSiswa->save();
            return view('front.pendaftaran-berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
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
}
