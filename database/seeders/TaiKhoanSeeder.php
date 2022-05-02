<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taikhoans')->insert([
            'id' => 1,
            'email' => 'vuhuyquang2k@gmail.com',
            'password' => bcrypt('123456'),
            'lan_dau_tien' => 0,
            'quyen' => 3,
        ]);
        DB::table('taikhoans')->insert([
            'id' => 2,
            'email' => 'onechampalistarandannie@gmail.com',
            'password' => bcrypt('123456'),
            'lan_dau_tien' => 0,
            'quyen' => 1,
        ]);
        DB::table('taikhoans')->insert([
            'id' => 3,
            'email' => 'quangvh.technical@gmail.com',
            'password' => bcrypt('123456'),
            'lan_dau_tien' => 0,
            'quyen' => 1,
        ]);
        DB::table('taikhoans')->insert([
            'id' => 4,
            'email' => 'homie210@gmail.com',
            'password' => bcrypt('123456'),
            'lan_dau_tien' => 0,
            'quyen' => 2,
        ]);
    }
}
