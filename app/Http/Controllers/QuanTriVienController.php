<?php

namespace App\Http\Controllers;

use App\Models\QuanTriVien;
use Illuminate\Http\Request;
use App\Models\HocKy;
use App\Models\HocPhan;
use App\Models\MonHoc;
use App\Models\NganhHoc;
use App\Models\GiangVien;
use App\Models\SinhVien;
use App\Models\KhoaHoc;
use App\Models\LopHoc;
use App\Models\SVDK;
use App\Models\DiemSo;
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

        $allhk = HocKy::orderBy('id', 'DESC')->get()->toArray();
        foreach ($allhk as $key => $itemhk) {
            if ($itemhk['ma_hoc_ky'] == $mhk) {
                $idFlag = $key+1;
            }
        }
        $hkifo = $allhk[$idFlag]['ma_hoc_ky'];

        $subjects = DB::table('svdks')->where('ma_hoc_ky', $mhk)->distinct('mon_hoc_id')->count('mon_hoc_id');
        $students = DB::table('svdks')->where('ma_hoc_ky', $mhk)->distinct('sinh_vien_id')->count('sinh_vien_id');
        $modules = DB::table('svdks')->where('ma_hoc_ky', $mhk)->distinct('hoc_phan_id')->count('hoc_phan_id');
        $teachers = DB::table('hocphans')->where('ma_hoc_ky', $mhk)->distinct('giang_vien_id')->count('giang_vien_id');
        //
        $hocphans = HocPhan::groupBy('mon_hoc_id')
        ->selectRaw('sum(da_dang_ky) as sum, mon_hoc_id')
        ->where('ma_hoc_ky', $mhk)
        ->where('da_dang_ky', '!=', 0)
        ->pluck('sum','mon_hoc_id');
        $arr = (array) null;
        $dem2 = 0;
        foreach ($hocphans as $key => $hocphan) {
            $monhoc = MonHoc::find($key);
            $tenmonhoc = $monhoc->ten_mon_hoc;
            $mamonhoc = $monhoc->ma_mon_hoc;
            $dem2++;
            if ($dem2 >= 11) {
                continue;
            }
            // $arr[$monhoc->ten_mon_hoc] = $hocphan;
            // $arr['ma_mon_hoc'] = $mamonhoc;
            $arr[] = array('ten_mon_hoc' => $monhoc->ten_mon_hoc, 'ma_mon_hoc' => $mamonhoc, 'da_dang_ky' => $hocphan );
            unset($hocphans);
        }
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->first();
        if (!empty($mahocky)) {
            $mhk = $hkifo;
        }
        $diemsos = DB::table('diemsos')->where('ma_hoc_ky', $mhk)->get();
        $sxdiem = collect($diemsos);
        $sxdiemtheodiemchu = $sxdiem->groupBy('diem_chu')->map(function($values) {
            return $values->count();
        })->sort()->reverse();
        $sxdiems = $sxdiemtheodiemchu->toArray();
        return view('quantrivien.dashboard.dashboard', compact('subjects', 'students', 'modules', 'teachers', 'arrhk', 'arr', 'sxdiems'));
    }

    public function subjectsList()
    {
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
            $monhocs = DB::table('svdks')->select('mon_hoc_id')->where('ma_hoc_ky', $mhk)->groupBy('mon_hoc_id')->get()->toArray();
            if (empty($monhocs)) {
                return redirect()->route('dashboard');
            }
            $arr = (array) null;
            foreach ($monhocs as $key => $monhoc) {
                $mh = MonHoc::find($monhoc->mon_hoc_id)->toArray();
                $arr[] = $mh;
            }
            $nganhhocs = NganhHoc::all();
            return view('quantrivien.dashboard.dsmonhoc', compact('arr', 'nganhhocs'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function moduleList()
    {
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
            $hocphans = DB::table('svdks')->select('hoc_phan_id')->where('ma_hoc_ky', $mhk)->groupBy('hoc_phan_id')->get()->toArray();
            if (empty($hocphans)) {
                return redirect()->route('dashboard');
            }
            $arr = (array) null;
            foreach ($hocphans as $key => $hocphan) {
                $hp = HocPhan::find($hocphan->hoc_phan_id)->toArray();
                $arr[] = $hp;
            }
            $monhocs = MonHoc::all();
            $giangviens = GiangVien::all();
            if (!empty($giangviens)) {
                return view('quantrivien.dashboard.dshocphan', compact('arr', 'monhocs', 'giangviens'));
            } else {
                return view('quantrivien.dashboard.dshocphan', compact('arr', 'monhocs'));
            }
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function studentList()
    {
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
            $svdks = DB::table('svdks')->select('sinh_vien_id')->where('ma_hoc_ky', $mhk)->groupBy('sinh_vien_id')->get()->toArray();
            if (empty($svdks)) {
                return redirect()->route('dashboard');
            }
            $arr = (array) null;
            foreach ($svdks as $key => $svdk) {
                $sv = SinhVien::find($svdk->sinh_vien_id)->toArray();
                $arr[] = $sv;
            }
            $khoahocs = KhoaHoc::all();
            $lophocs = LopHoc::all();
            $nganhhocs = NganhHoc::all();
            return view('quantrivien.dashboard.dssinhvien', compact('arr', 'khoahocs', 'lophocs', 'nganhhocs'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function studentListID($id)
    {
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
        $svdks = SVDK::where('sinh_vien_id', $id)->where('ma_hoc_ky', $mhk)->get();
        return view('quantrivien.dashboard.dssvid', compact('svdks'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function teacherList()
    {
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
            $giangviens = HocPhan::where('ma_hoc_ky', $mhk)->where('da_dang_ky', '>', 0)->distinct('giang_vien_id')->get()->toArray();
            $arr = (array) null;
            foreach ($giangviens as $key => $giangvien) {
                if ($giangvien['giang_vien_id'] != null) {
                    $gv = GiangVien::find($giangvien['giang_vien_id'])->toArray();
                    $arr[] = $gv;
                }
            }
            $nganhhocs = NganhHoc::all();
            return view('quantrivien.dashboard.dsgiangvien', compact('arr', 'nganhhocs'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function teacherListID($id)
    {
        $mahocky = DB::table('hockys')->where('trang_thai', 'Mở')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
        $hocphans = HocPhan::where('giang_vien_id', $id)->where('ma_hoc_ky', $mhk)->get();
        return view('quantrivien.dashboard.dsgvid', compact('hocphans'));
        } else {
            return redirect()->route('dashboard');
        }
    }
}
