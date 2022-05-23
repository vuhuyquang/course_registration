<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\HocPhan;
use DB;

class HocPhanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $sl = DB::table('hockys')->where('trang_thai', 'Mở')->count();
        $sl2 = DB::table('hockys')->where('hien_tai', 1)->count();
        if ($sl == 1) {
            $hockymos = DB::table('hockys')->where('trang_thai', 'Mở')->get()->toArray();
            foreach ($hockymos as $key => $hockymo) {
                $hockymo = $hockymo->ma_hoc_ky;
            }
            $hocphans = HocPhan::where('ma_hoc_ky', $hockymo)->get();   
        } elseif ($sl2 == 1) {
            $hockyhientais = DB::table('hockys')->where('hien_tai', 1)->get()->toArray();
            foreach ($hockyhientais as $key => $hockyhientai) {
                $hockyhientai = $hockyhientai->ma_hoc_ky;
            }
            $hocphans = HocPhan::where('ma_hoc_ky', $hockyhientai)->get();
        } else {
            return view('quantrivien.qlhocphan.danhsach');
        }
        return view('quantrivien.qlhocphan.exporthocphan', [
            'hocphans' => $hocphans
        ]);
    }
}
