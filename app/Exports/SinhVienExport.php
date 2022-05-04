<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\SinhVien;

class SinhVienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('quantrivien.qlsinhvien.exports', [
            'sinhviens' => SinhVien::all()
        ]);
    }

    // public function collection()
    // {
    //     return SinhVien::all();
    // }

    // public function headings(): array
    // {
    //     return [
    //         'STT',
    //         'Mã sinh viên',
    //         'Ảnh',
    //         'Họ tên',
    //         'Khóa học',
    //         'Lớp học',
    //         'Ngành học',
    //         'Email',
    //         'Ngày sinh',
    //         'Giới tính',
    //         'Quê quán',
    //         'Số điện thoại'
    //     ];
    // }

    // public function map($sinhvien): array
    // {
    //     return [
    //         $sinhvien->id,
    //         $sinhvien->name,
    //         $sinhvien->id,
    //         $sinhvien->name,
    //         $sinhvien->id,
    //         $sinhvien->name,
    //         $sinhvien->id,
    //         $sinhvien->name,
    //         $sinhvien->id,
    //         $sinhvien->name,
    //         $sinhvien->id,
    //         $sinhvien->name,
    //     ];
    // }
}
