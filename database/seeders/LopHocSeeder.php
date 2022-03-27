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
    }
}
