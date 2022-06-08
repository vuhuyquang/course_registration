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
            'ma_hoc_ky' => '2021_2022_1',
            'mo_ta' => 'Học kỳ 1 năm học 2021 - 2022',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '2',
            'ma_hoc_ky' => '2021_2022_2',
            'mo_ta' => 'Học kỳ 2 năm học 2021 - 2022',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '3',
            'ma_hoc_ky' => '2022_2023_1',
            'mo_ta' => 'Học kỳ 1 năm học 2022 - 2023',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '4',
            'ma_hoc_ky' => '2022_2023_2',
            'mo_ta' => 'Học kỳ 2 năm học 2022 - 2023',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '5',
            'ma_hoc_ky' => '2023_2024_1',
            'mo_ta' => 'Học kỳ 1 năm học 2023 - 2024',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '6',
            'ma_hoc_ky' => '2023_2024_2',
            'mo_ta' => 'Học kỳ 2 năm học 2023 - 2024',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('hockys')->insert([
            'id' => '7',
            'ma_hoc_ky' => '2024_2025_1',
            'mo_ta' => 'Học kỳ 1 năm học 2024 - 2025',
            'trang_thai' => 'Đóng',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
