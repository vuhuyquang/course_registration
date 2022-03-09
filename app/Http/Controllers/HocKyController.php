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
            'mo_ta' => 'required|unique:hockys,mo_ta|max:50'
        ], [
            'ma_hoc_ky.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_hoc_ky.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_hoc_ky.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'mo_ta.required' => 'Dữ liệu nhập vào không được để trống',
            'mo_ta.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'mo_ta.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        $hocky = new HocKy;
        $hocky->ma_hoc_ky = $request->ma_hoc_ky;
        $hocky->mo_ta = $request->mo_ta;
        $hocky->save();
        return redirect()->back()->with('thongbao', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HocKy  $hocKy
     * @return \Illuminate\Http\Response
     */
    public function setstatus()
    {
        $hockys = HocKy::all();
        return view('quantrivien.qlhocky.xettrangthai', compact('hockys'));
    }

    public function storesetstatus(Request $request)
    {
        $hocky = HocKy::findOrFail($request->id);
        $hocky->trang_thai = $request->trang_thai;
        $hocky->save();
        return redirect()->back()->with('thongbao', 'Xét trạng thái thành công');
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
        $hocky->save();
        return redirect()->back()->with('thongbao', 'Cập nhật thành công');
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
        $hocky->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
}
