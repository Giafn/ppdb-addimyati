<?php

namespace Database\Seeders;

use App\Http\Controllers\Cms\master\PpdbSettingController;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 999; $i++) {
            try {
                DB::beginTransaction();
                $ppdbAktif = PpdbSettingController::getPPDBInfo()['ppdbOpen'];
                $idppdb = $ppdbAktif->id;

                // Generate Alamat
                $alamatSiswa = new \App\Models\Alamat();
                $alamatSiswa->kecamatan = $faker->city . ' Utara';
                $alamatSiswa->kota = $faker->city;
                $alamatSiswa->provinsi = $faker->state;
                $alamatSiswa->desa = $faker->streetName;
                $alamatSiswa->rt = $faker->numberBetween(1, 10);
                $alamatSiswa->rw = $faker->numberBetween(1, 10);
                $alamatSiswa->jalan = $faker->streetName;
                $alamatSiswa->gang = $faker->optional()->streetName;
                $alamatSiswa->no_rumah = $faker->buildingNumber;
                $alamatSiswa->kode_pos = $faker->randomNumber(5);
                $alamatSiswa->save();

                // Generate Pendaftaran
                $pendaftaran = new \App\Models\Pendaftaran();
                $pendaftaran->ppdb_id = $idppdb;
                $pendaftaran->kode = 'PPDB-' . $faker->numberBetween(1000000000, 9999999999);
                $pendaftaran->status_pendaftaran = $faker->randomElement([1, 2]); // 1: Diterima, 2: Ditolak
                $pendaftaran->status_pembayaran = $faker->randomElement([0, 1, 2]);
                $pendaftaran->jurusan_id1 = $faker->numberBetween(1, 5); // ID Jurusan
                $pendaftaran->jurusan_id2 = $faker->numberBetween(1, 5); // ID Jurusan
                $pendaftaran->referensi = $faker->optional()->word;

                // Generate Akademik
                $akademik = new \App\Models\Akademik();
                $akademik->nisn = $faker->numberBetween(1000000000000000, 9999999999999999);
                $akademik->asal_sekolah = $faker->company;
                $akademik->nomor_seri_sttb = $faker->numberBetween(1000000000000000, 9999999999999999);
                $akademik->tahun_sttb = $faker->year;
                $akademik->save();

                // Generate CalonSiswa
                $calonSiswa = new \App\Models\CalonSiswa();
                $calonSiswa->akademik_id = $akademik->id;
                $calonSiswa->nik = $faker->numberBetween(1000000000000000, 9999999999999999);
                $calonSiswa->telepon =  str_replace(' ', '', $faker->phoneNumber);
                $calonSiswa->nama_lengkap = $faker->name;
                $calonSiswa->nama_panggilan = $faker->name;
                $calonSiswa->jenis_kelamin = $faker->randomElement(['l', 'p']);
                $calonSiswa->tanggal_lahir = $faker->dateTimeBetween('-18 years', '-15 years')->format('Y-m-d');
                $calonSiswa->tempat_lahir = $faker->city;
                $calonSiswa->alamat_id = $alamatSiswa->id;
                $calonSiswa->agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']);
                $calonSiswa->anak_ke = $faker->numberBetween(1, 5);
                $calonSiswa->ukuran_seragam = $faker->randomElement(['s', 'm', 'l', 'xl', 'xxl']);
                $calonSiswa->tinggi_badan = $faker->numberBetween(150, 200);
                $calonSiswa->berat_badan = $faker->numberBetween(40, 100);
                $calonSiswa->golongan_darah = $faker->randomElement(['a+', 'a-', 'b+', 'b-', 'ab+', 'ab-', 'o']);
                $calonSiswa->penyakit_kronis = $faker->optional()->word;
                $calonSiswa->cita_cita = $faker->jobTitle;
                $calonSiswa->hobi = $faker->jobTitle;
                $calonSiswa->prestasi = $faker->optional()->word;
                $calonSiswa->keahlian = $faker->optional()->word;
                $calonSiswa->jml_saudara_kandung = $faker->numberBetween(1, 5);
                $calonSiswa->jml_saudara_tiri = $faker->numberBetween(1, 5);
                $calonSiswa->jml_saudara_sekolah = $faker->numberBetween(1, 5);
                $calonSiswa->jml_saudara_no_sekolah = $faker->numberBetween(1, 5);
                $calonSiswa->program_keahlian_id = $faker->numberBetween(1, 3);
                $calonSiswa->save();

                $orangTua = new \App\Models\OrangTua();
                $orangTua->jenis = "Ayah";
                $orangTua->nama_lengkap = $faker->name;
                $orangTua->pendidikan_terakhir = $faker->randomElement(['sd', 'smp', 'sma', 's1', 's2', 's3']);
                $orangTua->pekerjaan = $faker->randomElement(['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Peternak', 'Buruh', 'Wirausahawan', 'Lain-lain']);
                $orangTua->agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']);
                $orangTua->tanggungan = $faker->numberBetween(1, 5);
                $orangTua->calon_siswa_id = $calonSiswa->id;
                $orangTua->alamat_id = $alamatSiswa->id;
                $orangTua->save();

                $orangTua = new \App\Models\OrangTua();
                $orangTua->jenis = "Ibu";
                $orangTua->nama_lengkap = $faker->name;
                $orangTua->pendidikan_terakhir = $faker->randomElement(['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3']);
                $orangTua->pekerjaan = $faker->randomElement(['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Peternak', 'Buruh', 'Wirausahawan', 'Lain-lain']);
                $orangTua->agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']);
                $orangTua->tanggungan = $faker->numberBetween(1, 5);
                $orangTua->calon_siswa_id = $calonSiswa->id;
                $orangTua->alamat_id = $alamatSiswa->id;
                $orangTua->save();

                // Link Pendaftaran dan CalonSiswa
                $pendaftaran->calon_siswa_id = $calonSiswa->id;
                $pendaftaran->save();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
            }
        }

    }
}
