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
                'gelombang' => 1, // GEL 1
                'nama' => 'Administrasi Pendaftaran',
                'nominal' => 10000,
                'keterangan' => 'Biaya administrasi pendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 1, // GEL 1
                'nama' => 'Uang Pangkal',
                'nominal' => 1000000,
                'keterangan' => 'Biaya uang pangkal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 2, // GEL 2
                'nama' => 'Administrasi Pendaftaran',
                'nominal' => 10000,
                'keterangan' => 'Biaya administrasi pendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 2, // GEL 2
                'nama' => 'Uang Pangkal',
                'nominal' => 1000000,
                'keterangan' => 'Biaya uang pangkal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 3, // GEL 3
                'nama' => 'Administrasi Pendaftaran',
                'nominal' => 10000,
                'keterangan' => 'Biaya administrasi pendaftaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gelombang' => 3, // GEL 3
                'nama' => 'Uang Pangkal',
                'nominal' => 1000000,
                'keterangan' => 'Biaya uang pangkal',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        \DB::table('nominal_pendaftaran')->insert($nominalAdministrasi);
    }
}
