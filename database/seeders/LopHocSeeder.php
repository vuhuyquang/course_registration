<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lophocs')->insert([
            'id' => '1',
            'ma_lop' => '69DCTT23',
            'nganh_id' => '1',
            'khoa_hoc_id' => '1',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('lophocs')->insert([
            'id' => '2',
            'ma_lop' => '69DCKT25',
            'nganh_id' => '2',
            'khoa_hoc_id' => '1',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('lophocs')->insert([
            'id' => '3',
            'ma_lop' => '71DCCT22',
            'nganh_id' => '3',
            'khoa_hoc_id' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
