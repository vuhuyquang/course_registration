<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithheadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\KhoaHoc;
use App\Models\LopHoc;
use App\Models\NganhHoc;
use App\Models\SinhVien;
use App\Models\TaiKhoan;

class SinhVienImport implements ToCollection, WithHeadingRow
{

    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Kiểm tra khóa học, nếu chưa có tạo mới, nếu có lấy id
            $khoahoc_exists = KhoaHoc::where('ma_khoa_hoc', $row['ma_khoa_hoc'])->first();
            if (!empty($khoahoc_exists)) {
                $khoahocid = $khoahoc_exists->id;
            } else {
                $khoahoc = KhoaHoc::create([
                    'ma_khoa_hoc' => $row['ma_khoa_hoc'],
                ]);
                $khoahocid = KhoaHoc::where('ma_khoa_hoc', $row['ma_khoa_hoc'])->first()->id;
            }

            $lophoc_exists = LopHoc::where('ma_lop', $row['ma_lop'])->first();
            if (!empty($lophoc_exists)) {
                $lophocid = $lophoc_exists->id;
                // dd($lophocid);
            } else {
                $lophoc = LopHoc::create([
                    'ma_lop' => $row['ma_lop'],
                ]);
                $lophocid = LopHoc::where('ma_lop', $row['ma_lop'])->first()->id;
                // dd($lophocid);
            }

            $nganhhoc_exists = NganhHoc::where('ten_nganh', $row['ten_nganh'])->first();
            if (!empty($nganhhoc_exists)) {
                $nganhhocid = $nganhhoc_exists->id;
            } else {
                $nganhhoc = NganhHoc::create([
                    'ten_nganh' => $row['ten_nganh'],
                ]);
                $nganhhocid = NganhHoc::where('ten_nganh', $row['ten_nganh'])->first()->id;
            }

            $students = SinhVien::create([
                'ma_sinh_vien' => $row['ma_sinh_vien'],
                'ho_ten' => $row['ho_ten'],
                'khoa_hoc_id' => $khoahocid,
                'lop_hoc_id' => $lophocid,
                'nganh_hoc_id' => $nganhhocid,
                'ngay_sinh' => date('Y/m/d', strtotime($row['ngay_sinh'])),
                'gioi_tinh' => $row['gioi_tinh'],
                'que_quan' => $row['que_quan'],
                'so_dien_thoai' => $row['so_dien_thoai'],
                'tai_khoan_id' => $row['tai_khoan_id'],
            ]);

            $account = TaiKhoan::create([
                'id' => $row['tai_khoan_id'],
                'email' => $row['email'],
                'password' => bcrypt(date('d/m/Y', strtotime($row['ngay_sinh']))),
                'lan_dau_tien' => 1,
                'quyen' => 1,
            ]);
        }
    }
}
