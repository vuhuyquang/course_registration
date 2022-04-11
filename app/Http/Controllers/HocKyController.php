<?php

namespace App\Http\Controllers;

use App\Models\HocKy;
use Illuminate\Http\Request;

class HocKyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hockys = HocKy::all();
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
        $hocky = HocKy::findOrFail($id);
        if ($hocky->trang_thai == 'Đóng đăng ký') {
            $hocky->trang_thai = 'Mở đăng ký';
        } elseif ($hocky->trang_thai == 'Mở đăng ký') {
            $hocky->trang_thai = 'Đóng đăng ký';
        }
        if ($hocky->save()) {
            return redirect()->back()->with('success', 'Xét trạng thái thành công');
        } else {
            return redirect()->back()->with('error', 'Xét trạng thái thất bại');
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
            'ma_hoc_ky' => 'required|max:20|unique:hockys,ma_hoc_ky,'.$id,
            'mo_ta' => 'required|max:50|unique:hockys,mo_ta,'.$id
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
