<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class HocKySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hockys')->insert([
            'id' => '1',
            'ma_hoc_ky' => '2021_2022_2',
            'mo_ta' => 'Học kỳ 2 năm học 2021 - 2022',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '2',
            'ma_hoc_ky' => '2022_2023_1',
            'mo_ta' => 'Học kỳ 1 năm học 2022 - 2023',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '3',
            'ma_hoc_ky' => '2022_2023_2',
            'mo_ta' => 'Học kỳ 2 năm học 2022 - 2023',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
