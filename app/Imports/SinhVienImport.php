<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithheadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\KhoaHoc;
use App\Models\LopHoc;
use App\Models\NganhHoc;
use App\Models\SinhVien;
use App\Models\TaiKhoan;

class SinhVienImport implements ToCollection, WithHeadingRow, WithValidation
{

    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            // Kiểm tra khóa học, nếu chưa có tạo mới, nếu có lấy id
            $khoahoc_exists = KhoaHoc::where('ma_khoa_hoc', $row['ma_khoa_hoc'])->first();
            if (!empty($khoahoc_exists)) {
                $khoahocid = $khoahoc_exists->id;
            } else {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Khóa học này chưa tồn tại';
                return redirect()->back()->with('error', $message);
            }

            $lophoc_exists = LopHoc::where('ma_lop', $row['ma_lop'])->first();
            if (!empty($lophoc_exists)) {
                $lophocid = $lophoc_exists->id;
            } else {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Lớp học này chưa tồn tại';
                return redirect()->back()->with('error', $message);
            }

            $nganhhoc_exists = NganhHoc::where('ten_nganh', $row['ten_nganh'])->first();
            if (!empty($nganhhoc_exists)) {
                $nganhhocid = $nganhhoc_exists->id;
            } else {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Ngành học này chưa tồn tại';
                return redirect()->back()->with('error', $message);
            }

            $sinhvien_exists = SinhVien::where('ma_sinh_vien', $row['ma_sinh_vien'])->first();
            $taikhoan_exists = TaiKhoan::where('email', $row['email'])->first();
            if (!empty($sinhvien_exists)) {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Mã sinh viên đã tồn tại';
                return redirect()->back()->with('error', $message);
            } elseif (!empty($taikhoan_exists)) {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Email đã tồn tại';
                return redirect()->back()->with('error', $message);
            } else {
                $account = TaiKhoan::create([
                    'email' => $row['email'],
                    'password' => bcrypt(date('d/m/Y', strtotime($this->transformDate($row['ngay_sinh'])))),
                    'lan_dau_tien' => 1,
                    'quyen' => 1,
                ]);
                $id = $account->id;

                $students = SinhVien::create([
                    'ma_sinh_vien' => $row['ma_sinh_vien'],
                    'ho_ten' => $row['ho_ten'],
                    'khoa_hoc_id' => $khoahocid,
                    'lop_hoc_id' => $lophocid,
                    'nganh_hoc_id' => $nganhhocid,
                    'ngay_sinh' => $this->transformDate($row['ngay_sinh']),
                    'gioi_tinh' => $row['gioi_tinh'],
                    'que_quan' => $row['que_quan'],
                    'so_dien_thoai' => $row['so_dien_thoai'],
                    'tai_khoan_id' => $id,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Nhập dữ liệu thành công');
    }

    public function rules(): array
    {
        return [
            '*.ma_sinh_vien' => 'bail|required|min:3|max:20',
            '*.ho_ten' => 'bail|required|max:20',
            '*.ma_khoa_hoc' => 'bail|required|min:3|max:20',
            '*.ma_lop' => 'bail|required|min:3|max:20',
            '*.ten_nganh' => 'bail|required|min:3|max:70',
            '*.ngay_sinh' => 'bail|required',
            '*.gioi_tinh' => 'bail|required',
            '*.que_quan' => 'bail|required',
            '*.so_dien_thoai' => 'required|regex:/(0[1-9]{2})[0-9]{7}/|max:10',
            '*.email' => 'bail|required|email|max:70',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'phone.regex' => 'Số điện thoại không đúng định dạng',
        ];
    }

    public function transformDate($value, $format = 'd/m/Y')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
