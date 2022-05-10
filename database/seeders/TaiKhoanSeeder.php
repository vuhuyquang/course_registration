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
            'lan_dau_tien' => 1,
            'quyen' => 3,
        ]);
    }
}
