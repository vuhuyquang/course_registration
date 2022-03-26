<?php

namespace App\Http\Controllers;

use App\Models\MonHoc;
use App\Models\Khoa;
use App\Models\NganhHoc;
use Illuminate\Http\Request;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monhocs = MonHoc::all();
        return view('quantrivien.qlmonhoc.danhsach', compact('monhocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nganhhocs = NganhHoc::all();
        return view('quantrivien.qlmonhoc.them', compact('nganhhocs'));
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
            'ma_mon_hoc' => 'required|unique:monhocs,ma_mon_hoc|max:20',
            'ten_mon_hoc' => 'required|unique:monhocs,ten_mon_hoc|max:80',
            'so_tin_chi' => 'required|numeric',
            'nganh_id' => 'required|numeric'
        ], [
            'ma_mon_hoc.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_mon_hoc.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_mon_hoc.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ten_mon_hoc.required' => 'Dữ liệu nhập vào không được để trống',
            'ten_mon_hoc.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'ten_mon_hoc.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'so_tin_chi.required' => 'Dữ liệu nhập vào không được để trống',
            'so_tin_chi.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'nganh_id.required' => 'Dữ liệu nhập vào không được để trống',
            'nganh_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số'
        ]);

        MonHoc::insert([
            'ma_mon_hoc' => $request->ma_mon_hoc,
            'nganh_id' => $request->nganh_id,
            'ten_mon_hoc' => $request->ten_mon_hoc,
            'so_tin_chi' => $request->so_tin_chi,
            'hoc_phi' => $request->hoc_phi
        ]);
        return redirect()->back()->with('thongbao', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonHoc  $monHoc
     * @return \Illuminate\Http\Response
     */
    public function show(MonHoc $monHoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonHoc  $monHoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khoas = Khoa::all();
        $monhoc = MonHoc::find($id);
        return view('quantrivien.qlmonhoc.sua', compact('monhoc', 'khoas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonHoc  $monHoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ma_mon_hoc' => 'required|max:20|unique:monhocs,ma_mon_hoc,'.$id,
            'ten_mon_hoc' => 'required|max:80|unique:monhocs,ten_mon_hoc,'.$id,
            'so_tin_chi' => 'required|numeric',
            'khoa_id' => 'required|numeric'
        ], [
            'ma_mon_hoc.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_mon_hoc.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_mon_hoc.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ten_mon_hoc.required' => 'Dữ liệu nhập vào không được để trống',
            'ten_mon_hoc.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'ten_mon_hoc.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'so_tin_chi.required' => 'Dữ liệu nhập vào không được để trống',
            'so_tin_chi.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'khoa_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số'
        ]);

        $monhoc = MonHoc::findOrFail($id);
        $monhoc->ma_mon_hoc = $request->ma_mon_hoc;
        $monhoc->khoa_id = $request->khoa_id;
        $monhoc->ten_mon_hoc = $request->ten_mon_hoc;
        $monhoc->so_tin_chi = $request->so_tin_chi;
        $monhoc->hoc_phi = $request->hoc_phi;
        $monhoc->save();
        return redirect()->back()->with('thongbao', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonHoc  $monHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monhoc = MonHoc::findOrFail($id);
        $monhoc->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
}
