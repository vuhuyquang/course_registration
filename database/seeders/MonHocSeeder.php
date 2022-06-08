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
            'ma_mon_hoc' => 'DC2TT20',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Ngôn ngữ lập trình C',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '2',
            'ma_mon_hoc' => 'DC2TT21',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Ngôn ngữ lập trình Java',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '3',
            'ma_mon_hoc' => 'DC2TT22',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kiểm thử phần mềm',
            'so_tin_chi' => '3',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '4',
            'ma_mon_hoc' => 'DC2TT23',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Lập trình trên môi trường Web',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '5',
            'ma_mon_hoc' => 'DC2TT24',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Lập trình di động',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '6',
            'ma_mon_hoc' => 'DC2TT25',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn mạng máy tính',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '7',
            'ma_mon_hoc' => 'DC2TT26',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kiến trúc máy tính',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '8',
            'ma_mon_hoc' => 'DC2TT27',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn cơ sở dữ liệu',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '9',
            'ma_mon_hoc' => 'DC2TT28',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'An toàn và bảo mật hệ thống thông tin',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '10',
            'ma_mon_hoc' => 'DC2TT29',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Hệ quản trị cơ sở dữ liệu',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '11',
            'ma_mon_hoc' => 'DC2TT30',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Cấu trúc dữ liệu và giải thuật',
            'so_tin_chi' => '4',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '12',
            'ma_mon_hoc' => 'DC2TT31',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Công nghệ phần mềm',
            'so_tin_chi' => '3',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '13',
            'ma_mon_hoc' => 'DC2TT32',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Điện toán đám mây',
            'so_tin_chi' => '2',
            'hoc_ky' => 7,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '14',
            'ma_mon_hoc' => 'DC2TT33',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Phần mềm mã nguồn mở',
            'so_tin_chi' => '2',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '15',
            'ma_mon_hoc' => 'DC2TT34',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Giao thông thông minh (ITS)',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '16',
            'ma_mon_hoc' => 'DC2TT35',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Làm việc nhóm và kỹ năng giao tiếp',
            'so_tin_chi' => '2',
            'hoc_ky' => 1,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '17',
            'ma_mon_hoc' => 'DC2TT36',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Toán 1',
            'so_tin_chi' => '2',
            'hoc_ky' => 1,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '18',
            'ma_mon_hoc' => 'DC2TT37',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Toán 2',
            'so_tin_chi' => '2',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '19',
            'ma_mon_hoc' => 'DC2TT38',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Vật lý đại cương 1',
            'so_tin_chi' => '2',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '20',
            'ma_mon_hoc' => 'DC2TT39',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kỹ thuật xây dựng và trình bày báo cáo',
            'so_tin_chi' => '2',
            'hoc_ky' => 1,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '21',
            'ma_mon_hoc' => 'DC2TT40',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Tin học cơ sở',
            'so_tin_chi' => '3',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '22',
            'ma_mon_hoc' => 'DC2TT41',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Tư tưởng Hồ Chí Minh',
            'so_tin_chi' => '2',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '23',
            'ma_mon_hoc' => 'DC2TT42',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Phân tích thiết kế hệ thống thông tin',
            'so_tin_chi' => '4',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '24',
            'ma_mon_hoc' => 'DC2TT43',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Vật lý đại cương 2',
            'so_tin_chi' => '3',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '25',
            'ma_mon_hoc' => 'DC2TT44',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Đường lối của ĐCSVN',
            'so_tin_chi' => '2',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '57',
            'ma_mon_hoc' => 'DC2TT45',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Giáo dục quốc phòng',
            'so_tin_chi' => '3',
            'hoc_ky' => 1,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '58',
            'ma_mon_hoc' => 'DC2TT46',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Điền kinh',
            'so_tin_chi' => '2',
            'hoc_ky' => 1,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '59',
            'ma_mon_hoc' => 'DC2TT47',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Big Data',
            'so_tin_chi' => '3',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '60',
            'ma_mon_hoc' => 'DC2TT48',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Lập trình hướng đối tượng C++',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '61',
            'ma_mon_hoc' => 'DC2TT49',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Hệ thống hoặch định nguồn lực doanh nghiệp (ERP)',
            'so_tin_chi' => '3',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '62',
            'ma_mon_hoc' => 'DC2TT50',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Kiến trúc và thiết kế phần mềm',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '63',
            'ma_mon_hoc' => 'DC2TT51',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn trí tuệ nhân tạo',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '64',
            'ma_mon_hoc' => 'DC2TT52',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Nhập môn xử lý ảnh',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '65',
            'ma_mon_hoc' => 'DC2TT53',
            'nganh_id' => '1',
            'ten_mon_hoc' => 'Xây dựng các hệ thống nhúng',
            'so_tin_chi' => '3',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        //
        DB::table('monhocs')->insert([
            'id' => '26',
            'ma_mon_hoc' => 'DC2KT20',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Marketing căn bản',
            'so_tin_chi' => '2',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '27',
            'ma_mon_hoc' => 'DC2KT21',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Pháp luật kinh tế',
            'so_tin_chi' => '3',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '28',
            'ma_mon_hoc' => 'DC2KT22',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kinh tế vĩ mô',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '29',
            'ma_mon_hoc' => 'DC2KT23',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kế toán xây dựng cơ bản',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '30',
            'ma_mon_hoc' => 'DC2KT24',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Quản trị doanh nghiệp',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '31',
            'ma_mon_hoc' => 'DC2KT25',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Phân tích hoạt động kinh doanh',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '32',
            'ma_mon_hoc' => 'DC2KT26',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kế toán thương mại',
            'so_tin_chi' => '2',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '33',
            'ma_mon_hoc' => 'DC2KT27',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Thống kê kinh doanh',
            'so_tin_chi' => '2',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '34',
            'ma_mon_hoc' => 'DC2KT28',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Kế toán hành chính sự nghiệp',
            'so_tin_chi' => '2',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '35',
            'ma_mon_hoc' => 'DC2KT29',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Hành vi người tiêu dùng',
            'so_tin_chi' => '2',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '36',
            'ma_mon_hoc' => 'DC2KT30',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Marketing thương mại điện tử',
            'so_tin_chi' => '2',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '37',
            'ma_mon_hoc' => 'DC2KT31',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Nguyên lý thống kê',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '38',
            'ma_mon_hoc' => 'DC2KT32',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Nguyên lý kế toán',
            'so_tin_chi' => '3',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '39',
            'ma_mon_hoc' => 'DC2KT33',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Quản trị học',
            'so_tin_chi' => '2',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '40',
            'ma_mon_hoc' => 'DC2KT34',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Toán cao cấp',
            'so_tin_chi' => '2',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '41',
            'ma_mon_hoc' => 'DC2KT35',
            'nganh_id' => '2',
            'ten_mon_hoc' => 'Pháp luật Việt Nam đại cương',
            'so_tin_chi' => '2',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        //
        DB::table('monhocs')->insert([
            'id' => '42',
            'ma_mon_hoc' => 'DC2CT20',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Hình hoạ - Vẽ kỹ thuật',
            'so_tin_chi' => '4',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '43',
            'ma_mon_hoc' => 'DC2CT21',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Nền và móng',
            'so_tin_chi' => '3',
            'hoc_ky' => 2,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '44',
            'ma_mon_hoc' => 'DC2CT22',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Sức bền vật liệu 1',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '45',
            'ma_mon_hoc' => 'DC2CT23',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Kết cấu nhà thép',
            'so_tin_chi' => '3',
            'hoc_ky' => 3,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '46',
            'ma_mon_hoc' => 'DC2CT24',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Kiến trúc dân dụng và công nghiệp',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '47',
            'ma_mon_hoc' => 'DC2CT25',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Tổ chức thi công công trình xây dựng',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '48',
            'ma_mon_hoc' => 'DC2CT26',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Máy xây dựng',
            'so_tin_chi' => '2',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '49',
            'ma_mon_hoc' => 'DC2CT27',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Cơ học cơ sở',
            'so_tin_chi' => '3',
            'hoc_ky' => 4,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '50',
            'ma_mon_hoc' => 'DC2CT28',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Thực hành trắc địa',
            'so_tin_chi' => '2',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '51',
            'ma_mon_hoc' => 'DC2CT29',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Thí nghiệm và kiểm định chất lượng công trình',
            'so_tin_chi' => '2',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '52',
            'ma_mon_hoc' => 'DC2CT30',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Vật liệu xây dựng',
            'so_tin_chi' => '4',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '53',
            'ma_mon_hoc' => 'DC2CT31',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Cơ học đất',
            'so_tin_chi' => '3',
            'hoc_ky' => 5,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '54',
            'ma_mon_hoc' => 'DC2CT32',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'An toàn lao động',
            'so_tin_chi' => '2',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '55',
            'ma_mon_hoc' => 'DC2CT33',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Kinh tế xây dựng (CT)',
            'so_tin_chi' => '2',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        DB::table('monhocs')->insert([
            'id' => '56',
            'ma_mon_hoc' => 'DC2CT34',
            'nganh_id' => '3',
            'ten_mon_hoc' => 'Lý thuyết xác suất - thống kê',
            'so_tin_chi' => '2',
            'hoc_ky' => 6,
            'created_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        
    }
}
