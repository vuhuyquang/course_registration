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
            'ma_nganh' => 'TT',
            'ten_nganh' => 'Công nghệ thông tin',
            'khoa_id' => '1',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('nganhhocs')->insert([
            'id' => '2',
            'ma_nganh' => 'QT',
            'ten_nganh' => 'Quản trị kinh doanh',
            'khoa_id' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('nganhhocs')->insert([
            'id' => '3',
            'ma_nganh' => 'CT',
            'ten_nganh' => 'Công nghệ kỹ thuật công trình xây dựng',
            'khoa_id' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
