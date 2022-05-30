<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class KhoaHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('khoahocs')->insert([
            'id' => '1',
            'ma_khoa_hoc' => 'K69DHCQ',
            'mo_ta' => 'Khóa 69 hệ đại học',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('khoahocs')->insert([
            'id' => '2',
            'ma_khoa_hoc' => 'K70DHCQ',
            'mo_ta' => 'Khóa 70 hệ đại học',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('khoahocs')->insert([
            'id' => '3',
            'ma_khoa_hoc' => 'K71DHCQ',
            'mo_ta' => 'Khóa 71 hệ đại học',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('khoahocs')->insert([
            'id' => '4',
            'ma_khoa_hoc' => 'K72DHCQ',
            'mo_ta' => 'Khóa 72 hệ đại học',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('khoahocs')->insert([
            'id' => '5',
            'ma_khoa_hoc' => 'K73DHCQ',
            'mo_ta' => 'Khóa 73 hệ đại học',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
