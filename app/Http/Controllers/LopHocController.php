<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use App\Models\Khoa;
use App\Models\KhoaHoc;
use Illuminate\Http\Request;

class LopHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lophocs = LopHoc::all();
        return view('quantrivien.qllophoc.danhsach', compact('lophocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoas = Khoa::all();
        $khoahocs = KhoaHoc::all();
        return view('quantrivien.qllophoc.them', compact('khoas', 'khoahocs'));
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
            'ma_lop' => 'required|unique:lophocs,ma_lop|max:20',
            'khoa_id' => 'required|integer',
            'khoa_hoc_id' => 'required|integer'
        ], [
            'ma_lop.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_lop.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_lop.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'khoa_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_id.integer' => 'Dữ liệu nhập vào phải là dạng số',
            'khoa_hoc_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_hoc_id.integer' => 'Dữ liệu nhập vào phải là dạng số'
        ]);

        $lophoc = new LopHoc;
        $lophoc->ma_lop = $request->ma_lop;
        $lophoc->khoa_id = $request->khoa_id;
        $lophoc->khoa_hoc_id = $request->khoa_hoc_id;
        $lophoc->save();
        return redirect()->back()->with('thongbao', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LopHoc  $lopHoc
     * @return \Illuminate\Http\Response
     */
    public function show(LopHoc $lopHoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LopHoc  $lopHoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khoas = Khoa::all();
        $khoahocs = KhoaHoc::all();
        $lophoc = LopHoc::findOrFail($id);
        return view('quantrivien.qllophoc.sua', compact('lophoc', 'khoas', 'khoahocs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LopHoc  $lopHoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lophoc = LopHoc::findOrFail($id);
        $request->validate([
            'ma_lop' => 'required|max:20|unique:lophocs,ma_lop,'.$id,
            'khoa_id' => 'required|integer',
            'khoa_hoc_id' => 'required|integer'
        ], [
            'ma_lop.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_lop.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_lop.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'khoa_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_id.integer' => 'Dữ liệu nhập vào phải là dạng số',
            'khoa_hoc_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_hoc_id.integer' => 'Dữ liệu nhập vào phải là dạng số'
        ]);

        $lophoc->ma_lop = $request->ma_lop;
        $lophoc->khoa_id = $request->khoa_id;
        $lophoc->khoa_hoc_id = $request->khoa_hoc_id;
        $lophoc->save();
        return redirect()->back()->with('thongbao', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LopHoc  $lopHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lophoc = LopHoc::findOrFail($id);
        $lophoc->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
}
