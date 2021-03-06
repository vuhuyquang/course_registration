<?php

namespace App\Http\Controllers;

use App\Models\HocPhan;
use App\Models\HocKy;
use App\Models\MonHoc;
use App\Models\SVDK;
use App\Models\SinhVien;
use App\Models\HocPhi;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class HocKyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hockys = HocKy::orderBy('id', 'ASC')->search()->paginate(10);
        return view('quantrivien.qlhocky.danhsach', compact('hockys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quantrivien.qlhocky.them');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_hoc_ky' => 'required|unique:hockys,ma_hoc_ky|max:20',
            'mo_ta' => 'unique:hockys,mo_ta|max:50'
        ], [
            'ma_hoc_ky.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_hoc_ky.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_hoc_ky.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'mo_ta.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'mo_ta.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        $hocky = new HocKy;
        $hocky->ma_hoc_ky = $request->ma_hoc_ky;
        $hocky->mo_ta = $request->mo_ta;
        if ($hocky->save()) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HocKy  $hocKy
     * @return \Illuminate\Http\Response
     */
    public function setStatus($id)
    {
        $sl = DB::table('hockys')->where('trang_thai', 'Mở')->count();

        $hocky = HocKy::findOrFail($id);

        if ($hocky->trang_thai == 'Đóng' && $sl == 0) {
            //
            if ($hocky->da_mo == 1) {
                return redirect()->back()->with('error', 'Không thể mở học kỳ trong quá khứ');
            }
            $sinhviens = SinhVien::all();
            foreach ($sinhviens as $i => $sinhvien) {
                $sinhvien->so_ky_hoc = $sinhvien->so_ky_hoc + 1;
                $sinhvien->save();
            }

            $hkhts = DB::table('hockys')->where('hien_tai', 1)->get()->toArray();
            foreach ($hkhts as $key => $hkht) {
                $mahkht = $hkht->ma_hoc_ky;
            }

            if (!empty($mahkht) && $mahkht == $hocky->ma_hoc_ky) {
                return redirect()->back()->with('error', 'Không thể mở đăng ký chính học kỳ hiện tại');
            }

            // $hocphan = HocPhan::all()->withTrashed()->forceDelete();
            // Tạo 3 học phần từ mỗi môn học
            $monhocmodks = MonHoc::where('duoc_phep', 1)->get();
            foreach ($monhocmodks as $key => $monhocmodk) {
                for ($i = 1; $i <= 3; $i++) {
                    $hocphan = new HocPhan;
                    $hocphan->ma_lop = Str::upper(substr(md5($monhocmodk->ma_mon_hoc . Str::upper(Str::random(8)) . time()), 0, 10));
                    $hocphan->ma_hoc_phan = $monhocmodk->ma_mon_hoc;
                    $hocphan->mon_hoc_id = $monhocmodk->id;
                    $hocphan->so_tin_chi = $monhocmodk->so_tin_chi;
                    $hocphan->ma_hoc_ky = $hocky->ma_hoc_ky;
                    $hocphan->save();
                }
            }
            //
            $hocky->trang_thai = 'Mở';
            $hocky->hien_tai = 0;
            $hocky->da_mo = 1;

            if ($hocky->save()) {
                $hockys = HocKy::where('hien_tai', 1)->get();
                foreach ($hockys as $key => $hocky) {
                    $hocky->hien_tai = 0;
                    $hocky->save();
                }
                return redirect()->back()->with('success', 'Mở đăng ký học kỳ thành công');
            } else {
                return redirect()->back()->with('error', 'Mở đăng ký học kỳ thất bại');
            }
        } elseif ($hocky->trang_thai == 'Mở') {
            $mhk = $hocky->ma_hoc_ky;

            // Xóa học kỳ nếu sĩ số <=1 hoặc >60
            $hocphans = HocPhan::where('ma_hoc_ky', $mhk)->where('da_dang_ky', '<=', 1)->orWhere('da_dang_ky', '>', 60)->get();
            foreach ($hocphans as $key => $hocphan) {
                if ($hocphan->giu_lai == 1) {
                    $hocphan->delete();
                } else {
                    $hocphan->forceDelete();
                }
                $svhdk = SVDK::where('hoc_phan_id', $hocphan->id)->delete();
            }

            // Cập nhật trạng thái học kỳ
            $hocky->trang_thai = 'Đóng';
            $hocky->hien_tai = 1;
            $monhocs = MonHoc::where('duoc_phep', 'false')->get();
            foreach ($monhocs as $key => $monhoc) {
                $monhoc->duoc_phep = 'true';
                $monhoc->save();
            }

            // Tạo dữ liệu học phí cho sinh viên
            $hocphis = SVDK::groupBy('sinh_vien_id')
                ->selectRaw('sum(so_tin_chi) as sum, sinh_vien_id')
                ->where('ma_hoc_ky', $mhk)
                ->pluck('sum', 'sinh_vien_id')->toArray();

            foreach ($hocphis as $key => $hocphi) {
                $hp = (int) $hocphi;
                $hocphi = new HocPhi;
                $hocphi->sinh_vien_id = $key;
                $hocphi->so_tin_chi = $hp;
                $hocphi->ma_hoc_ky = $mhk;
                $hocphi->save();
            }
            //
            if ($hocky->save()) {
                return redirect()->back()->with('success', 'Đóng đăng ký học kỳ thành công');
            } else {
                return redirect()->back()->with('error', 'Đóng đăng ký học kỳ thất bại');
            }
        } else {
            return redirect()->back()->with('error', 'Chỉ được mở 1 học kỳ duy nhất');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HocKy  $hocKy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hocky = HocKy::findOrFail($id);
        return view('quantrivien.qlhocky.sua', compact('hocky'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HocKy  $hocKy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hocky = HocKy::findOrFail($id);
        $request->validate([
            'ma_hoc_ky' => 'required|max:20|unique:hockys,ma_hoc_ky,' . $id,
            'mo_ta' => 'required|max:50|unique:hockys,mo_ta,' . $id
        ], [
            'ma_hoc_ky.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_hoc_ky.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_hoc_ky.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'mo_ta.required' => 'Dữ liệu nhập vào không được để trống',
            'mo_ta.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'mo_ta.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        $hocky->ma_hoc_ky = $request->ma_hoc_ky;
        $hocky->mo_ta = $request->mo_ta;
        if ($hocky->save()) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HocKy  $hocKy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hocky = HocKy::findOrFail($id);
        if ($hocky->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }
}
