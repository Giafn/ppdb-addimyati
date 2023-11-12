<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PPDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ppdb')->insert([
            [
                'gelombang' => '1',
                'tahun_ajaran' => '2022/2023',
                'start_date' => '2021-01-01',
                'end_date' => '2025-01-31',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
