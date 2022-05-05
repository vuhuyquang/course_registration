<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\GiangVien;

class GiangVienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('quantrivien.qlgiangvien.exports', [
            'giangviens' => GiangVien::all()
        ]);
    }
}
