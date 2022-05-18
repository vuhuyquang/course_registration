<?php

namespace App\Http\Controllers;

use App\Models\QuanTriVien;
use Illuminate\Http\Request;
use App\Models\HocKy;
use App\Models\HocPhan;
use App\Models\MonHoc;
use DB;

class QuanTriVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $dem = 0;
        $arrhk = (array) null;
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
            for ($i = $mahocky->id; $i > 0 ; $i--) {
                $dem++;
                if ($dem >=7) {
                    continue;
                }
                $hocky = HocKy::find($i);
                $arrhk[] = array('mahocky' => $hocky['ma_hoc_ky'], 'sl' => DB::table('svdks')->where('ma_hoc_ky', $hocky['ma_hoc_ky'])->count());
            }
        } else {
            $mhk = null;
        }
        $subjects = DB::table('svdks')->where('ma_hoc_ky', $mhk)->distinct('mon_hoc_id')->count('mon_hoc_id');
        $students = DB::table('svdks')->where('ma_hoc_ky', $mhk)->distinct('sinh_vien_id')->count('sinh_vien_id');
        $modules = DB::table('svdks')->where('ma_hoc_ky', $mhk)->distinct('hoc_phan_id')->count('hoc_phan_id');
        $teachers = DB::table('hocphans')->where('ma_hoc_ky', $mhk)->distinct('giang_vien_id')->count('giang_vien_id');
        //
        $hocphans = HocPhan::groupBy('mon_hoc_id')
        ->selectRaw('sum(da_dang_ky) as sum, mon_hoc_id')
        ->where('ma_hoc_ky', $mhk)
        ->pluck('sum','mon_hoc_id');
        $arr = (array) null;
        $dem2 = 0;
        foreach ($hocphans as $key => $hocphan) {
            $monhoc = MonHoc::find($key);
            $tenmonhoc = $monhoc->ten_mon_hoc;
            $dem2++;
            if ($dem2 >= 6) {
                continue;
            }
            $arr[$monhoc->ten_mon_hoc] = $hocphan;
            unset($hocphans);
        }
        $hocphans = HocPhan::orderBy('da_dang_ky', 'ASC')->where('ma_hoc_ky', $mhk)->paginate(5);
        return view('quantrivien.dashboard', compact('subjects', 'students', 'modules', 'teachers', 'arrhk', 'arr', 'hocphans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuanTriVien  $quanTriVien
     * @return \Illuminate\Http\Response
     */
    public function show(QuanTriVien $quanTriVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuanTriVien  $quanTriVien
     * @return \Illuminate\Http\Response
     */
    public function edit(QuanTriVien $quanTriVien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuanTriVien  $quanTriVien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuanTriVien $quanTriVien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuanTriVien  $quanTriVien
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuanTriVien $quanTriVien)
    {
        //
    }
}
