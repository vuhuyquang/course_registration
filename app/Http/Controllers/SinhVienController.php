<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\Khoa;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sinhviens = SinhVien::all();
        return view('quantrivien.qlsinhvien.danhsach', compact('sinhviens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoas = Khoa::all();
        return view('quantrivien.qlsinhvien.them', compact('khoas'));
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
            'ma_sinh_vien' => 'required|unique:sinhviens,ma_sinh_vien|max:20',
            'ho_ten' => 'required|max:50',
            'khoa_id' => 'required|max:20',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:sinhviens,email'
        ], [
            'ma_sinh_vien.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_sinh_vien.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_sinh_vien.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ho_ten.required' => 'Dữ liệu nhập vào không được để trống',
            'ho_ten.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'khoa_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'ngay_sinh.required' => 'Dữ liệu nhập vào không được để trống',
            'ngay_sinh.date' => 'Dữ liệu nhập vào phải là kiểu date',
            'gioi_tinh.required' => 'Dữ liệu nhập vào không được để trống',
            'gioi_tinh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'que_quan.required' => 'Dữ liệu nhập vào không được để trống',
            'que_quan.max' => 'Dữ liệu nhập vào có tối đa 80 ký tự',
            'email.required' => 'Dữ liệu nhập vào không được để trống',
            'email.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'email.email' => 'Dữ liệu nhập vào phải là kiểu mail',
            'email.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        $sinhvien = new SinhVien;
        $sinhvien->ma_sinh_vien = $request->ma_sinh_vien;
        $sinhvien->ho_ten = $request->ho_ten;
        $sinhvien->khoa_id = $request->khoa_id;
        $sinhvien->mat_khau = bcrypt(date('d/m/Y', strtotime($request->ngay_sinh)));
        $sinhvien->ngay_sinh = $request->ngay_sinh;
        $sinhvien->gioi_tinh = $request->gioi_tinh;
        $sinhvien->que_quan = $request->que_quan;
        $sinhvien->email = $request->email;
        $sinhvien->save();
        return redirect()->back()->with('thongbao', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function show(SinhVien $sinhVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function edit(SinhVien $sinhVien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SinhVien $sinhVien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function destroy(SinhVien $sinhVien)
    {
        //
    }
}
