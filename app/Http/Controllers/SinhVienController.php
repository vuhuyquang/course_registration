<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\NganhHoc;
use App\Models\KhoaHoc;
use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\SendEmailSendAccount;
use App\Jobs\SendMailResetPassword;
use Image;
use File;

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
        $nganhhocs = NganhHoc::all();
        $khoahocs = KhoaHoc::all();
        $lophocs = LopHoc::all();
        return view('quantrivien.qlsinhvien.them', compact('nganhhocs', 'khoahocs', 'lophocs'));
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
            'nganh_hoc_id' => 'required|numeric',
            'khoa_hoc_id' => 'required|numeric',
            'lop_hoc_id' => 'required|numeric',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:sinhviens,email'
        ], [
            'ma_sinh_vien.required' => 'Trường dữ liệu không được để trống',
            'ma_sinh_vien.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_sinh_vien.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ho_ten.required' => 'Trường dữ liệu không được để trống',
            'ho_ten.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'nganh_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'nganh_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'khoa_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'khoa_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'lop_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'lop_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'ngay_sinh.required' => 'Trường dữ liệu không được để trống',
            'ngay_sinh.date' => 'Dữ liệu nhập vào phải là kiểu date',
            'ngay_sinh.before' => 'Ngày sinh phải nhỏ hơn ngày hiện tại',
            'gioi_tinh.required' => 'Trường dữ liệu không được để trống',
            'gioi_tinh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'que_quan.required' => 'Trường dữ liệu không được để trống',
            'que_quan.max' => 'Dữ liệu nhập vào có tối đa 80 ký tự',
            'email.required' => 'Trường dữ liệu không được để trống',
            'email.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'email.email' => 'Dữ liệu nhập vào phải là kiểu mail',
            'email.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        if ($request->has('avatar')) {
            $data = $this->resizeimage($request);
            $tenanh = $data['tenanh'];
            $hinhanh_resize = $data['hinhanh_resize'];
        } 
        $sinhvien = new SinhVien;
        $sinhvien->ma_sinh_vien = $request->ma_sinh_vien;
        $sinhvien->ho_ten = $request->ho_ten;
        $sinhvien->nganh_hoc_id = $request->nganh_hoc_id;
        $sinhvien->khoa_hoc_id = $request->khoa_hoc_id;
        $sinhvien->lop_hoc_id = $request->lop_hoc_id;
        $password = $random = Str::random(10);
        $sinhvien->password = bcrypt($password);
        $sinhvien->ngay_sinh = $request->ngay_sinh;
        $sinhvien->gioi_tinh = $request->gioi_tinh;
        $sinhvien->que_quan = $request->que_quan;
        $sinhvien->email = $request->email;
        $sinhvien->avatar = $tenanh;
        $sinhvien->so_dien_thoai = $request->so_dien_thoai;
        if ($sinhvien->save()) {
            $sendAccount = new SendEmailSendAccount($sinhvien, $password);
            dispatch($sendAccount);
            $hinhanh_resize->save(public_path('uploads/' . $tenanh));
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }   
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
    public function edit($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        $nganhhocs = NganhHoc::all();
        $khoahocs = KhoaHoc::all();
        $lophocs = LopHoc::all();
        return view('quantrivien.qlsinhvien.sua', compact('nganhhocs', 'khoahocs', 'lophocs', 'sinhvien'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ma_sinh_vien' => 'required|max:20|unique:sinhviens,ma_sinh_vien,'.$id,
            'ho_ten' => 'required|max:50',
            'nganh_hoc_id' => 'required|numeric',
            'khoa_hoc_id' => 'required|numeric',
            'lop_hoc_id' => 'required|numeric',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:sinhviens,email,'.$id
        ], [
            'ma_sinh_vien.required' => 'Trường dữ liệu không được để trống',
            'ma_sinh_vien.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_sinh_vien.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ho_ten.required' => 'Trường dữ liệu không được để trống',
            'ho_ten.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'nganh_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'nganh_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'khoa_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'khoa_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'lop_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'lop_hoc_id.numeric' => 'Dữ liệu nhập vào phải phải là kiểu số',
            'ngay_sinh.required' => 'Trường dữ liệu không được để trống',
            'ngay_sinh.date' => 'Dữ liệu nhập vào phải là kiểu date',
            'ngay_sinh.before' => 'Ngày sinh phải nhỏ hơn ngày hiện tại',
            'gioi_tinh.required' => 'Trường dữ liệu không được để trống',
            'gioi_tinh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'que_quan.required' => 'Trường dữ liệu không được để trống',
            'que_quan.max' => 'Dữ liệu nhập vào có tối đa 80 ký tự',
            'email.required' => 'Trường dữ liệu không được để trống',
            'email.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'email.email' => 'Dữ liệu nhập vào phải là kiểu mail',
            'email.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        if ($request->has('avatar')) {
            $data = $this->resizeimage($request);
            $tenanh = $data['tenanh'];
            $hinhanh_resize = $data['hinhanh_resize'];
        }

        $sinhvien = SinhVien::findOrFail($id);
        $sinhvien->ma_sinh_vien = $request->ma_sinh_vien;
        $sinhvien->ho_ten = $request->ho_ten;
        $sinhvien->nganh_hoc_id = $request->nganh_hoc_id;
        $sinhvien->khoa_hoc_id = $request->khoa_hoc_id;
        $sinhvien->lop_hoc_id = $request->lop_hoc_id;
        $sinhvien->ngay_sinh = $request->ngay_sinh;
        $sinhvien->gioi_tinh = $request->gioi_tinh;
        $sinhvien->que_quan = $request->que_quan;
        $sinhvien->email = $request->email;
        $sinhvien->avatar = $tenanh;
        $sinhvien->so_dien_thoai = $request->so_dien_thoai;
        if ($sinhvien->save()) {
            $hinhanh_resize->save(public_path('uploads/' . $tenanh));
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        $duongdan = public_path('uploads/' . $sinhvien->avatar);
        if ($sinhvien->delete()) {
            if (File::exists($duongdan)) {
                unlink($duongdan);
            }
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }   
    }

    public function resetPassword($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
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

    public function profile($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        return view('quantrivien.qlsinhvien.hosocanhan', compact('sinhvien'));
    }
}
