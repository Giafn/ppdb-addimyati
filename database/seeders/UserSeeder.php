<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->count() < 1) {
            DB::table('users')->insert([
                [
                    "name"          => "Admin",
                    "email"         => "admin@gmail.com",
                    "password"      => bcrypt('1'),
					"user_level_id" => null,
					"flag_active"   => 1,
					'created_at'    => date("Y-m-d H:i:s"),
                ],
            ]);
        }

        DB::table('user_levels')->insert([
            [
                "id"            => "5",
                "name"          => "Siswa",
                "level"         => "1",
                'created_at'    => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
