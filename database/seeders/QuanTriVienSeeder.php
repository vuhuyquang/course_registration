<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class QuanTriVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quantriviens')->insert([
            'id' => 1,
            'ma_quan_tri_vien' => 'ADMIN0001',
            'ho_ten' => 'Vũ Huy Quang',
            'trinh_do' => 'Kỹ sư',
            'don_vi' => 'Công nghệ thông tin',
            'ngay_sinh' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'gioi_tinh' => 'Nam',
            'que_quan' => 'TP Hải Dương, Hải Dương',
            'so_dien_thoai ' => '0344396798',
            'avatar' => 'avatar_default.png',
            'tai_khoan_id' => 1,
        ]);
    }
}
