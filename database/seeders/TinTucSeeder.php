<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TinTucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tintucs')->insert([
            'id' => 1,
            'tieu_de' => 'Hội nghị gặp gỡ đối thoại giữa sinh viên với Lãnh đạo Nhà trường năm học 2021-2022',
            'noi_dung_ngan' => 'Sáng 31/5, Trường Đại học Công nghệ GTVT đã tổ chức Hội nghị gặp gỡ đối thoại giữa sinh viên với Lãnh đạo Nhà trường năm học 2021-2022.',
            'hinh_anh' => 'https://utt.edu.vn/uploads/images/news/thumbnails/d407d410799961bf0c52619a34b1b86b.jpg',
            'duong_dan' => 'https://utt.edu.vn/utt/tin-tuc-su-kien/hoi-nghi-gap-go-doi-thoai-giua-sinh-vien-voi-lanh-dao-nha-truong-nam-hoc-2021-2022-a14174.html',
            'ngay_dang' => \Carbon\Carbon::createFromDate(2022,05,31)->toDateTimeString(),         
        ]);
        DB::table('tintucs')->insert([
            'id' => 2,
            'tieu_de' => 'Tiễn sinh viên UTT đi thực tập hưởng lương tại doanh nghiệp Nhật Bản',
            'noi_dung_ngan' => 'Trong các ngày 17/5 và 30/5 vừa qua, Trường Đại học Công nghệ GTVT đã tiễn 20 sinh viên năm cuối sang thực tập hưởng lương 1 năm tại Nhật Bản',
            'hinh_anh' => 'https://utt.edu.vn/uploads/images/news/thumbnails/8304e289b7090450c647e4983eb3c3ef.jpg',
            'duong_dan' => 'https://utt.edu.vn/utt/tin-tuc-su-kien/tien-sinh-vien-utt-di-thuc-tap-huong-luong-tai-doanh-nghiep-nhat-ban-a14171.html',
            'ngay_dang' => \Carbon\Carbon::createFromDate(2022,05,31)->toDateTimeString(),
        ]);
        DB::table('tintucs')->insert([
            'id' => 3,
            'tieu_de' => 'Gặp mặt và giao lưu với các nhà báo, phóng viên nhân dịp kỷ niệm Ngày Báo chí cách mạng Việt Nam 21/6',
            'noi_dung_ngan' => 'Ngày 28/5, tại cơ sở đào tạo Hà Nội đã diễn ra chương trình Gặp mặt và giao lưu giữa Trường ĐH Công nghệ GTVT với các nhà báo, phóng viên báo chí, truyền thông nhân dịp kỷ niệm 97 năm Ngày Báo chí cách mạng Việt Nam 21/6.',
            'hinh_anh' => 'https://utt.edu.vn/uploads/images/news/thumbnails/44ca6002497219b3c2515b9df789b30d.jpg',
            'duong_dan' => 'https://utt.edu.vn/utt/tin-tuc-su-kien/gap-mat-va-giao-luu-voi-cac-nha-bao-phong-vien-nhan-dip-ky-niem-ngay-bao-chi-cach-mang-viet-nam-216-a14170.html',
            'ngay_dang' => \Carbon\Carbon::createFromDate(2022,05,29)->toDateTimeString(),
        ]);
    }
}
