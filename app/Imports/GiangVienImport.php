<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithheadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\NganhHoc;
use App\Models\GiangVien;
use App\Models\TaiKhoan;

class GiangVienImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            $nganhhoc_exists = NganhHoc::where('ten_nganh', $row['ten_nganh'])->first();
            if (!empty($nganhhoc_exists)) {
                $nganhhocid = $nganhhoc_exists->id;
            } else {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Ngành học này chưa tồn tại';
                return redirect()->back()->with('error', $message);
            }

            $giangvien_exists = GiangVien::where('ma_giang_vien', $row['ma_giang_vien'])->first();
            $taikhoan_exists = TaiKhoan::where('email', $row['email'])->first();
            if (!empty($giangvien_exists)) {
                $dong = $key + 1;
                $message = 'Lỗi dòng ' . $dong . '. Mã giảng viên đã tồn tại';
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
                    'quyen' => 2,
                ]);
                $id = $account->id;

                $teachers = GiangVien::create([
                    'ma_giang_vien' => $row['ma_giang_vien'],
                    'ho_ten' => $row['ho_ten'],
                    'trinh_do' => $row['trinh_do'],
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
            '*.ma_giang_vien' => 'bail|required|min:3|max:20',
            '*.ho_ten' => 'bail|required|max:20',
            '*.trinh_do' => 'bail|required|min:3|max:20',
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
