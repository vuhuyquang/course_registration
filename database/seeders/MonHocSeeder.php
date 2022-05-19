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
            'ma_mon_hoc' => 'DC2TT21',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Ngôn ngữ lập trình Java',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '3',
            'ma_mon_hoc' => 'DC2TT22',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kiểm thử phần mềm',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '4',
            'ma_mon_hoc' => 'DC2TT23',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Lập trình trên môi trường Web',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '5',
            'ma_mon_hoc' => 'DC2TT24',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Lập trình di động',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '6',
            'ma_mon_hoc' => 'DC2TT25',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn mạng máy tính',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '7',
            'ma_mon_hoc' => 'DC2TT26',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kiến trúc máy tính',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '8',
            'ma_mon_hoc' => 'DC2TT27',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn cơ sở dữ liệu',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '9',
            'ma_mon_hoc' => 'DC2TT28',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'An toàn và bảo mật hệ thống thông tin',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '10',
            'ma_mon_hoc' => 'DC2TT29',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Hệ quản trị cơ sở dữ liệu',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        DB::table('monhocs')->insert([
            'id' => '11',
            'ma_mon_hoc' => 'DC2KT20',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Marketing căn bản',
            'so_tin_chi' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '12',
            'ma_mon_hoc' => 'DC2KT21',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Pháp luật kinh tế',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '13',
            'ma_mon_hoc' => 'DC2KT22',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kinh tế vĩ mô',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '14',
            'ma_mon_hoc' => 'DC2KT23',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kế toán xây dựng cơ bản',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '15',
            'ma_mon_hoc' => 'DC2KT24',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Quản trị doanh nghiệp',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '16',
            'ma_mon_hoc' => 'DC2KT25',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Phân tích hoạt động kinh doanh',
            'so_tin_chi' => '3',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '17',
            'ma_mon_hoc' => 'DC2KT26',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kế toán thương mại',
            'so_tin_chi' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '18',
            'ma_mon_hoc' => 'DC2KT27',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Thống kê kinh doanh',
            'so_tin_chi' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '19',
            'ma_mon_hoc' => 'DC2KT28',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kế toán hành chính sự nghiệp',
            'so_tin_chi' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '20',
            'ma_mon_hoc' => 'DC2KT29',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Hành vi người tiêu dùng',
            'so_tin_chi' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '21',
            'ma_mon_hoc' => 'DC2KT30',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Marketing thương mại điện tử',
            'so_tin_chi' => '2',
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        
    }
}
