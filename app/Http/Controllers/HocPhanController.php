<?php

namespace App\Http\Controllers;

use App\Models\HocPhan;
use App\Models\MonHoc;
use App\Models\GiangVien;
use App\Models\HocKy;
use App\Models\SVDK;
use Illuminate\Http\Request;
use App\Exports\SVDKExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class HocPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sl = DB::table('hockys')->where('trang_thai', 'Mở')->count();
        $sl2 = DB::table('hockys')->where('hien_tai', 1)->count();
        if ($sl == 1) {
            $hockymos = DB::table('hockys')->where('trang_thai', 'Mở')->get()->toArray();
            foreach ($hockymos as $key => $hockymo) {
                $hockymo = $hockymo->ma_hoc_ky;
            }
            $hocphans = HocPhan::where('ma_hoc_ky', $hockymo)->search()->paginate(15);   
        } elseif ($sl2 == 1) {
            $hockyhientais = DB::table('hockys')->where('hien_tai', 1)->get()->toArray();
            foreach ($hockyhientais as $key => $hockyhientai) {
                $hockyhientai = $hockyhientai->ma_hoc_ky;
            }
            $hocphans = HocPhan::where('ma_hoc_ky', $hockyhientai)->search()->paginate(15);
        } else {
            return view('quantrivien.qlhocphan.danhsach');
        }
        return view('quantrivien.qlhocphan.danhsach', compact('hocphans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $monhocs = MonHoc::all();
        $giangviens = GiangVien::all();
        $hockys = HocKy::all();
        return view('quantrivien.qlhocphan.them', compact('monhocs', 'giangviens', 'hockys'));
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
            'ma_lop' => 'required|unique:hocphans,ma_lop|max:20',
            'ma_hoc_phan' => 'required',
            'mon_hoc_id' => 'required',
            'so_tin_chi' => 'required|numeric',
            'thoi_gian' => 'required',
            'dia_diem' => 'required',
            'giang_vien_id' => 'required',
            'ma_hoc_ky' => 'required',
        ], [
            'ma_lop.required' => 'Trường dữ liệu không được để trống',
            'ma_lop.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_lop.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ma_hoc_phan.required' => 'Trường dữ liệu không được trùng lặp',
            'mon_hoc_id.required' => 'Trường dữ liệu không được trùng lặp',
            'so_tin_chi.required' => 'Trường dữ liệu không được trùng lặp',
            'thoi_gian.required' => 'Trường dữ liệu không được trùng lặp',
            'dia_diem.required' => 'Trường dữ liệu không được trùng lặp',
            'giang_vien_id.required' => 'Trường dữ liệu không được trùng lặp',
            'ma_hoc_ky.required' => 'Trường dữ liệu không được trùng lặp',
        ]);
        
        $monhoc = MonHoc::findOrFail($request->mon_hoc_id);
        $giangvien = GiangVien::findOrFail($request->giang_vien_id);
        if ($monhoc->nganh_id != $giangvien->nganh_hoc_id) {
            return redirect()->back()->with('error', 'Môn học và giảng viên không cùng ngành học');
        }
        
        $hocphan = new HocPhan;
        $hocphan->ma_lop = $request->ma_lop;
        $hocphan->ma_hoc_phan = $request->ma_hoc_phan;
        $hocphan->mon_hoc_id = $request->mon_hoc_id;
        $hocphan->so_tin_chi = $request->so_tin_chi;
        $hocphan->thoi_gian = $request->thoi_gian;
        $hocphan->dia_diem = $request->dia_diem;
        $hocphan->giang_vien_id = $request->giang_vien_id;
        $hocphan->ma_hoc_ky = $request->ma_hoc_ky;
        if ($hocphan->save()) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HocPhan  $hocPhan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $id;
        $svdks = SVDK::where('hoc_phan_id', $id)->get();
        return view('quantrivien.qlhocphan.danhsachlop', compact('svdks', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HocPhan  $hocPhan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $monhocs = MonHoc::all();
        $giangviens = GiangVien::all();
        $hockys = HocKy::all();
        $hocphan = HocPhan::findOrFail($id);
        return view('quantrivien.qlhocphan.sua', compact('monhocs', 'giangviens', 'hockys', 'hocphan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HocPhan  $hocPhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ma_lop' => 'required|max:20|unique:hocphans,ma_lop,'.$id,
            'ma_hoc_phan' => 'required',
            'mon_hoc_id' => 'required',
            'so_tin_chi' => 'required|numeric',
            'thoi_gian' => 'required',
            'dia_diem' => 'required',
            'giang_vien_id' => 'required',
            'ma_hoc_ky' => 'required',
        ], [
            'ma_lop.required' => 'Trường dữ liệu không được để trống',
            'ma_lop.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_lop.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ma_hoc_phan.required' => 'Trường dữ liệu không được trùng lặp',
            'mon_hoc_id.required' => 'Trường dữ liệu không được trùng lặp',
            'so_tin_chi.required' => 'Trường dữ liệu không được trùng lặp',
            'thoi_gian.required' => 'Trường dữ liệu không được trùng lặp',
            'dia_diem.required' => 'Trường dữ liệu không được trùng lặp',
            'giang_vien_id.required' => 'Trường dữ liệu không được để trống',
            'ma_hoc_ky.required' => 'Trường dữ liệu không được trùng lặp',
        ]);
        
        $hocphan = HocPhan::findOrFail($id);
        $hocphan->ma_lop = $request->ma_lop;
        $hocphan->ma_hoc_phan = $request->ma_hoc_phan;
        $hocphan->mon_hoc_id = $request->mon_hoc_id;
        $hocphan->so_tin_chi = $request->so_tin_chi;
        $hocphan->thoi_gian = $request->thoi_gian;
        $hocphan->dia_diem = $request->dia_diem;
        $hocphan->giang_vien_id = $request->giang_vien_id;
        $hocphan->ma_hoc_ky = $request->ma_hoc_ky;
        if ($hocphan->save()) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HocPhan  $hocPhan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hocphan = HocPhan::findOrFail($id);
        if ($hocphan->delete()) {
            $svdk = SVDK::where('hoc_phan_id', $id)->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new SVDKExport($request->id), 'ClassList.xlsx');
    }
}
