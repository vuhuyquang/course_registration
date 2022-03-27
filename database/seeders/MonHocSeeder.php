<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monhocs')->insert([
            'id' => '1',
            'ma_mon_hoc' => 'DC2HT20',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn lập trình C',
            'so_tin_chi' => '3',
            'hoc_phi' => '1170000',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
