<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sinhviens')->insert([
            'id' => 1,
            'ma_sinh_vien' => '69DCTT20144',
            'ho_ten' => 'Nguyễn Tiến Thuận',
            'khoa_hoc_id' => 1,
            'lop_hoc_id' => 1,
            'nganh_hoc_id' => 1,
            'ngay_sinh' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'gioi_tinh' => 'Nam',
            'que_quan' => 'TP Hải Dương, Hải Dương',
            'so_dien_thoai ' => '0987654321',
            'avatar' => 'avatar_default.png',
            'tai_khoan_id' => 2,
        ]);
    }
}
