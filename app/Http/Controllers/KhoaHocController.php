<?php

namespace App\Http\Controllers;

use App\Models\KhoaHoc;
use App\Models\LopHoc;
use Illuminate\Http\Request;

class KhoaHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khoahocs = KhoaHoc::all();
        return view('quantrivien.qlkhoahoc.danhsach', compact('khoahocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quantrivien.qlkhoahoc.them');
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
            'ma_khoa_hoc' => 'required|unique:khoahocs,ma_khoa_hoc|max:20',
            'mo_ta' => 'max:50'
        ], [
            'ma_khoa_hoc.required' => 'Trường dữ liệu không được để trống',
            'ma_khoa_hoc.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_khoa_hoc.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'mo_ta.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
        ]);

        $khoahoc = new KhoaHoc;
        $khoahoc->ma_khoa_hoc = $request->ma_khoa_hoc;
        $khoahoc->mo_ta = $request->mo_ta;
        if ($khoahoc->save()) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function classlist($id)
    {
        $lophocs = LopHoc::where('khoa_hoc_id', '=', $id)->get();
        return view('quantrivien.qlkhoahoc.danhsachlop', compact('lophocs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        return view('quantrivien.qlkhoahoc.sua', compact('khoahoc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        $request->validate([
            'ma_khoa_hoc' => 'required|max:20|unique:khoahocs,ma_khoa_hoc,'.$id,
            'mo_ta' => 'max:50|unique:khoahocs,mo_ta,'.$id
        ], [
            'ma_khoa_hoc.required' => 'Trường dữ liệu không được để trống',
            'ma_khoa_hoc.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_khoa_hoc.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'mo_ta.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
        ]);

        $khoahoc->ma_khoa_hoc = $request->ma_khoa_hoc;
        $khoahoc->mo_ta = $request->mo_ta;
        if ($khoahoc->save()) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $khoahoc = KhoaHoc::findOrFail($id);
        if ($khoahoc->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }
}
