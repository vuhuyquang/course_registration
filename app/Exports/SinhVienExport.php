<?php

namespace App\Exports;

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
}
