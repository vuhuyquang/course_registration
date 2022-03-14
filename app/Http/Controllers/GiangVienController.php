<?php

namespace App\Http\Controllers;

use App\Models\GiangVien;
use App\Models\Khoa;
use Illuminate\Http\Request;
use DB;

class GiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giangviens = GiangVien::all();
        return view('quantrivien.qlgiangvien.danhsach', compact('giangviens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoas = Khoa::all();
        return view('quantrivien.qlgiangvien.them', compact('khoas'));
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
            'ma_giang_vien' => 'required|unique:giangviens,ma_giang_vien|max:20',
            'ho_ten' => 'required|max:50',
            'trinh_do' => 'required|max:20',
            'khoa_id' => 'required|numeric',
            'mat_khau' => 'required|min:8|max:255',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:giangviens,email',
            'so_dien_thoai' => 'max:40'
        ], [
            'ma_giang_vien.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_giang_vien.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_giang_vien.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ho_ten.required' => 'Dữ liệu nhập vào không được để trống',
            'ho_ten.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'trinh_do.required' => 'Dữ liệu nhập vào không được để trống',
            'trinh_do.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'khoa_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'mat_khau.required' => 'Dữ liệu nhập vào không được để trống',
            'mat_khau.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'mat_khau.min' => 'Dữ liệu nhập vào có tối thiểu 8 ký tự',
            'ngay_sinh.required' => 'Dữ liệu nhập vào không được để trống',
            'ngay_sinh.date' => 'Dữ liệu nhập vào phải là kiểu date',
            'gioi_tinh.required' => 'Dữ liệu nhập vào không được để trống',
            'gioi_tinh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'que_quan.required' => 'Dữ liệu nhập vào không được để trống',
            'que_quan.max' => 'Dữ liệu nhập vào có tối đa 80 ký tự',
            'email.required' => 'Dữ liệu nhập vào không được để trống',
            'email.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'email.email' => 'Dữ liệu nhập vào phải là kiểu mail',
            'email.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'so_dien_thoai.required' => 'Dữ liệu nhập vào không được để trống',
            'so_dien_thoai.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
        ]);

        GiangVien::insert([
            'ma_giang_vien' => $request->ma_giang_vien,
            'ho_ten' => $request->ho_ten,
            'trinh_do' => $request->trinh_do,
            'khoa_id' => $request->khoa_id,
            'mat_khau' => bcrypt($request->mat_khau),
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'que_quan' => $request->que_quan,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai
        ]);
        return redirect()->back()->with('thongbao', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khoas = Khoa::all();
        $giangvien = GiangVien::findOrFail($id);
        return view('quantrivien.qlgiangvien.sua', compact('giangvien', 'khoas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $giangvien = GiangVien::findOrFail($id);
        $request->validate([
            'ma_giang_vien' => 'required|max:20|unique:giangviens,ma_giang_vien,'.$id,
            'ho_ten' => 'required|max:50',
            'trinh_do' => 'required|max:20',
            'khoa_id' => 'required|numeric',
            'mat_khau' => 'required|min:8|max:255',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:giangviens,email,'.$id,
            'so_dien_thoai' => 'max:40'
        ], [
            'ma_giang_vien.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_giang_vien.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_giang_vien.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ho_ten.required' => 'Dữ liệu nhập vào không được để trống',
            'ho_ten.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'trinh_do.required' => 'Dữ liệu nhập vào không được để trống',
            'trinh_do.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'khoa_id.required' => 'Dữ liệu nhập vào không được để trống',
            'khoa_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'mat_khau.required' => 'Dữ liệu nhập vào không được để trống',
            'mat_khau.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'mat_khau.min' => 'Dữ liệu nhập vào có tối thiểu 8 ký tự',
            'ngay_sinh.required' => 'Dữ liệu nhập vào không được để trống',
            'ngay_sinh.date' => 'Dữ liệu nhập vào phải là kiểu date',
            'gioi_tinh.required' => 'Dữ liệu nhập vào không được để trống',
            'gioi_tinh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'que_quan.required' => 'Dữ liệu nhập vào không được để trống',
            'que_quan.max' => 'Dữ liệu nhập vào có tối đa 80 ký tự',
            'email.required' => 'Dữ liệu nhập vào không được để trống',
            'email.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'email.email' => 'Dữ liệu nhập vào phải là kiểu mail',
            'email.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'so_dien_thoai.required' => 'Dữ liệu nhập vào không được để trống',
            'so_dien_thoai.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
        ]);

        DB::table('giangviens')->where('id', $id)->update([
            'ma_giang_vien' => $request->ma_giang_vien,
            'ho_ten' => $request->ho_ten,
            'trinh_do' => $request->trinh_do,
            'khoa_id' => $request->khoa_id,
            'mat_khau' => bcrypt($request->mat_khau),
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'que_quan' => $request->que_quan,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai
        ]);

        return redirect()->back()->with('thongbao', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giangvien = GiangVien::findOrFail($id);
        $giangvien->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
}
