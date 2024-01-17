<?php

namespace Database\Seeders;

use App\Http\Controllers\Cms\Master\NominalAdministrasiController;
use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\Akademik;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPendaftaranSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
        $ppdbAktif = PpdbSettingController::getPPDBInfo()['ppdbOpen'];
        if ($ppdbAktif) {
            $nominalPpdb = NominalAdministrasiController::hitungNominal($ppdbAktif->gelombang);
            $ppdbId = $ppdbAktif->id;
            
            $faker = \Faker\Factory::create();
            
            for ($i = 1; $i <= 47; $i++) {
                try {
                    DB::beginTransaction();
                    $name = $faker->name;
                    
                    $akademik = new Akademik();
                    $akademik->nisn = rand(1000000000, 9999999999);
                    $akademik->asal_sekolah = $faker->company;
                    $akademik->tahun_sttb = $faker->year;
                    $akademik->nomor_seri_sttb = rand(1000000000, 9999999999);
                    $akademik->save();
                    
                    $user = new User();
                    $user->name = $name;
                    $user->email = $faker->email;
                    $user->password = bcrypt($akademik->nisn);
                    $user->user_level_id = 5;
                    $user->save();
                    
                    $calonSiswa = new CalonSiswa();
                    $calonSiswa->user_id = $user->id;
                    $calonSiswa->akademik_id = $akademik->id;
                    $calonSiswa->nama_lengkap = $name;
                    $calonSiswa->jenis_kelamin = $faker->randomElement(['l', 'p']);
                    $calonSiswa->ttl = date('Y-m-d', strtotime($faker->date('Y-m-d')));
                    $calonSiswa->agama = $faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu']);
                    $calonSiswa->alamat_lengkap = $faker->address;
                    $calonSiswa->telepon = $faker->phoneNumber;
                    $rand6 = rand(100000, 999999);
                    $rand4 = rand(1000, 9999);
                    $calonSiswa->nik = $rand6 . $faker->date('dmY') . $rand4;
                    $calonSiswa->save();
                    
                    $pendaftaran = new Pendaftaran();
                    $pendaftaran->calon_siswa_id = $calonSiswa->id;
                    $pendaftaran->ppdb_id = $ppdbId;
                    $pendaftaran->nominal_pembayaran = $nominalPpdb;
                    $pendaftaran->status_pembayaran = $faker->randomElement([1, 2, 3]);
                    $pendaftaran->kode = "PPDB-" . $akademik->nisn;
                    $pendaftaran->status_pendaftaran = $faker->randomElement([1, 2]);
                    $pendaftaran->jurusan_id1 = 0;
                    $pendaftaran->jurusan_id2 = 0;
                    $pendaftaran->save();
                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e->getMessage());
                } finally {
                    DB::commit();
                }
            }
            
        } else {
            echo "PPDB belum dibuka, Bukalah PPDB terlebih dahulu";
        }
        
    }
}
