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
    }
}
