<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class NganhHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nganhhocs')->insert([
            'id' => '1',
            'ma_nganh' => 'HTTT',
            'ten_nganh' => 'Hệ thống thông tin',
            'khoa_id' => '1',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('nganhhocs')->insert([
            'id' => '2',
            'ma_nganh' => 'KT',
            'ten_nganh' => 'Kế toán',
            'khoa_id' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
