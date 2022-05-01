<?php

namespace App\Http\Controllers;

use App\Models\GiangVien;
use App\Models\NganhHoc;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Illuminate\Support\Str;
use App\Jobs\SendEmailSendAccount;
use App\Jobs\SendMailResetPassword;

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
        $nganhhocs = NganhHoc::all();
        return view('quantrivien.qlgiangvien.them', compact('nganhhocs'));
    }

    public function resizeimage($request)
    {
        $hinhanh = $request->avatar;
        $duoianh = $request->avatar->extension();
        $tenanh = time() . '.' . $duoianh;

        $hinhanh_resize = Image::make($hinhanh->getRealPath());
        $hinhanh_resize->resize(300, 300);
        // $hinhanh_resize->save(public_path('uploads/' . $tenanh));
        return array('tenanh' => $tenanh, 'hinhanh_resize' => $hinhanh_resize);
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
            'nganh_hoc_id' => 'required|numeric',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:taikhoans,email',
            'so_dien_thoai' => 'max:40'
        ], [
            'ma_giang_vien.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_giang_vien.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_giang_vien.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ho_ten.required' => 'Dữ liệu nhập vào không được để trống',
            'ho_ten.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'trinh_do.required' => 'Dữ liệu nhập vào không được để trống',
            'trinh_do.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'nganh_hoc_id.required' => 'Dữ liệu nhập vào không được để trống',
            'nganh_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
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

        if ($request->has('avatar')) {
            $data = $this->resizeimage($request);
            $tenanh = $data['tenanh'];
            $hinhanh_resize = $data['hinhanh_resize'];
        }

        $taikhoan = new TaiKhoan;
        $taikhoan->email = $request->email;
        $password = Str::random(10);
        $taikhoan->password = bcrypt($password);
        $taikhoan->quyen = 2;
        if ($taikhoan->save()) {
            $giangvien = new GiangVien;
            $giangvien->ma_giang_vien = $request->ma_giang_vien;
            $giangvien->ho_ten = $request->ho_ten;
            $giangvien->trinh_do = $request->trinh_do;
            $giangvien->nganh_hoc_id = $request->nganh_hoc_id;
            $giangvien->ngay_sinh = $request->ngay_sinh;
            $giangvien->gioi_tinh = $request->gioi_tinh;
            $giangvien->que_quan = $request->que_quan;
            $giangvien->so_dien_thoai = $request->so_dien_thoai;
            $giangvien->avatar = $tenanh;
            $giangvien->tai_khoan_id = $taikhoan->id;

            if ($giangvien->save()) {
                if (dispatch(new SendEmailSendAccount($giangvien->ho_ten, $taikhoan, $password))) {
                    return redirect()->back()->with('success', 'Thêm thành công. Đã gửi mail cấp tài khoản');
                } else {
                    return redirect()->back()->with('success', 'Thêm thành công. Đã có lỗi khi gửi mail');
                }
            } else {
                return redirect()->back()->with('error', 'Thêm thất bại');
            }
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
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
        $nganhhocs = NganhHoc::all();
        $giangvien = GiangVien::findOrFail($id);
        return view('quantrivien.qlgiangvien.sua', compact('giangvien', 'nganhhocs'));
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
            'nganh_hoc_id' => 'required|numeric',
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
            'nganh_hoc_id.required' => 'Dữ liệu nhập vào không được để trống',
            'nganh_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
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

        if ($request->has('avatar')) {
            $data = $this->resizeimage($request);
            $tenanh = $data['tenanh'];
            $hinhanh_resize = $data['hinhanh_resize'];
        }

        $giangvien = GiangVien::findOrFail($id);
        $giangvien->ma_giang_vien = $request->ma_giang_vien;
        $giangvien->ho_ten = $request->ho_ten;
        $giangvien->trinh_do = $request->trinh_do;
        $giangvien->nganh_hoc_id = $request->nganh_hoc_id;
        $giangvien->ngay_sinh = $request->ngay_sinh;
        $giangvien->gioi_tinh = $request->gioi_tinh;
        $giangvien->que_quan = $request->que_quan;
        $giangvien->email = $request->email;
        $giangvien->so_dien_thoai = $request->so_dien_thoai;
        if ($giangvien->save()) {
            $hinhanh_resize->save(public_path('uploads/' . $tenanh));
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
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
        if ($giangvien->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }   
    }

    public function profile($id)
    {
        $giangvien = GiangVien::findOrFail($id);
        return view('quantrivien.qlgiangvien.hosocanhan', compact('giangvien'));
    }

    public function resetPassword($id)
    {
        $sinhvien = GiangVien::findOrFail($id);
        $password = $random = Str::random(10);
        $sinhvien->password = bcrypt($password);

        if ($sinhvien->save()) {
            $resetPassword = new SendMailResetPassword($sinhvien, $password);
            dispatch($resetPassword);
            return redirect()->back()->with('success', 'Đã gửi mail đặt lại mật khẩu');
        } else {
            return redirect()->back()->with('error', 'Đặt lại mật khẩu thất bại');
        }   
    }
}
