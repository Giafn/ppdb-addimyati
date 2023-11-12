<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_keahlian')->insert([
            [
                "nama"          => "TKJ",
                "deskripsi"     => "Teknik Komputer dan Jaringan",
                "created_at"    => date("Y-m-d H:i:s"),
            ],
            [
                "nama"          => "RPL",
                "deskripsi"     => "Rekayasa Perangkat Lunak",
                "created_at"    => date("Y-m-d H:i:s"),
            ],
            [
                "nama"          => "MM",
                "deskripsi"     => "Multimedia",
                "created_at"    => date("Y-m-d H:i:s"),
            ]
        ]);
    }
}
