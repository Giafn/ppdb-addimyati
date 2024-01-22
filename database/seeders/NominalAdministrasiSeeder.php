<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NominalAdministrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nominalAdministrasi = [
            [
                'gelombang' => 1,
                'nama' => 'Pendaftaran',
                'nominal' => 100000,
                'keterangan' => 'Biaya administrasi pendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 1,
                'nama' => 'Biaya Pengembangan',
                'nominal' => 500000,
                'keterangan' => 'Biaya pengembangan sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 1,
                'nama' => 'Seragam',
                'nominal' => 1500000,
                'keterangan' => 'Biaya seragam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 1,
                'nama' => 'SPP',
                'nominal' => 100000,
                'keterangan' => 'Biaya SPP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 1,
                'nama' => 'ID Card',
                'nominal' => 100000,
                'keterangan' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 1,
                'nama' => 'Fasilitas Air Minum',
                'nominal' => 50000,
                'keterangan' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        \DB::table('nominal_pendaftaran')->insert($nominalAdministrasi);
    }
}
