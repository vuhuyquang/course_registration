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
            'ten_mon_hoc' => 'Ngôn ngữ lập trình C',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '2',
            'ma_mon_hoc' => 'DC2HT21',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Ngôn ngữ lập trình Java',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '3',
            'ma_mon_hoc' => 'DC2HT22',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kiểm thử phần mềm',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
