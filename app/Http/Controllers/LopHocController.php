<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use App\Models\NganhHoc;
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
        $lophocs = LopHoc::orderBy('khoa_hoc_id', 'DESC')->search()->paginate(10);
        return view('quantrivien.qllophoc.danhsach', compact('lophocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nganhhocs = NganhHoc::all();
        $khoahocs = KhoaHoc::all();
        return view('quantrivien.qllophoc.them', compact('nganhhocs', 'khoahocs'));
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
            'nganh_id' => 'required|integer',
            'khoa_hoc_id' => 'required|integer'
        ], [
            'ma_lop.required' => 'Trường dữ liệu không được để trống',
            'ma_lop.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_lop.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'nganh_id.required' => 'Trường dữ liệu không được để trống',
            'nganh_id.integer' => 'Dữ liệu nhập vào phải là dạng số',
            'khoa_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'khoa_hoc_id.integer' => 'Dữ liệu nhập vào phải là dạng số'
        ]);

        $lophoc = new LopHoc;
        $lophoc->ma_lop = $request->ma_lop;
        $lophoc->nganh_id = $request->nganh_id;
        $lophoc->khoa_hoc_id = $request->khoa_hoc_id;
        if ($lophoc->save()) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
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
        $nganhhocs = NganhHoc::all();
        $khoahocs = KhoaHoc::all();
        $lophoc = LopHoc::findOrFail($id);
        return view('quantrivien.qllophoc.sua', compact('lophoc', 'nganhhocs', 'khoahocs'));
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
            'nganh_id' => 'required|integer',
            'khoa_hoc_id' => 'required|integer'
        ], [
            'ma_lop.required' => 'Trường dữ liệu không được để trống',
            'ma_lop.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_lop.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'nganh_id.required' => 'Trường dữ liệu không được để trống',
            'nganh_id.integer' => 'Dữ liệu nhập vào phải là dạng số',
            'khoa_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'khoa_hoc_id.integer' => 'Dữ liệu nhập vào phải là dạng số'
        ]);

        $lophoc->ma_lop = $request->ma_lop;
        $lophoc->nganh_id = $request->nganh_id;
        $lophoc->khoa_hoc_id = $request->khoa_hoc_id;
        if ($lophoc->save()) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
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
        if ($lophoc->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }
}
