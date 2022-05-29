<?php

namespace App\Http\Controllers;

use App\Models\GiangVien;
use App\Models\NganhHoc;
use App\Models\TaiKhoan;
use App\Models\HocPhan;
use App\Models\DiemSo;
use App\Models\SVDK;
use App\Models\HocKy;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Auth;
use Illuminate\Support\Str;
use App\Jobs\SendEmailSendAccount;
use App\Jobs\SendMailResetPassword;
use App\Exports\GiangVienExport;
use App\Imports\GiangVienImport;
use Maatwebsite\Excel\Facades\Excel;

class GiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nganhhocs = NganhHoc::all();
        $giangviens = GiangVien::orderBy('id', 'ASC')->search()->paginate(15);
        $banghi = $request->banghi;
        return view('quantrivien.qlgiangvien.danhsach', compact('giangviens', 'nganhhocs', 'banghi'));
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
        $newid = $giangvien->taikhoans->id;
        $request->validate([
            'ma_giang_vien' => 'required|max:20|unique:giangviens,ma_giang_vien,'.$id,
            'ho_ten' => 'required|max:50',
            'trinh_do' => 'required|max:20',
            'nganh_hoc_id' => 'required|numeric',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:taikhoans,email,'.$newid,
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
        } else {
            $tenanh = 'avatar_default.png';
        }

        $giangvien = GiangVien::findOrFail($id);
        $taikhoan = TaiKhoan::findOrFail($giangvien->tai_khoan_id);
        $taikhoan->email = $request->email;
        if ($taikhoan->save()) {
            $giangvien->ma_giang_vien = $request->ma_giang_vien;
            $giangvien->ho_ten = $request->ho_ten;
            $giangvien->trinh_do = $request->trinh_do;
            $giangvien->nganh_hoc_id = $request->nganh_hoc_id;
            $giangvien->ngay_sinh = $request->ngay_sinh;
            $giangvien->gioi_tinh = $request->gioi_tinh;
            $giangvien->que_quan = $request->que_quan;
            $giangvien->so_dien_thoai = $request->so_dien_thoai;
            if ($giangvien->save()) {
                if ($request->has('avatar')) {
                    $hinhanh_resize->save(public_path('uploads/' . $tenanh));
                } 
                return redirect()->back()->with('success', 'Cập nhật thành công');
            } else {
                return redirect()->back()->with('error', 'Cập nhật thất bại');
            }
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    public function filters(Request $request)
    {
        $banghi = 15;
        $nganhhocs = NganhHoc::all();
        $giangviens = GiangVien::query()->nganhhoc($request)->search()->paginate($banghi);
        return view('quantrivien.qlgiangvien.danhsach', compact('giangviens', 'nganhhocs', 'banghi'));
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
        $taikhoan = TaiKhoan::findOrFail($giangvien->tai_khoan_id);
        $duongdan = public_path('uploads/' . $giangvien->avatar);
        if ($giangvien->delete() && $taikhoan->delete()) {
            if (File::exists($duongdan)) {
                unlink($duongdan);
            }
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
        $taikhoan = TaiKhoan::findOrFail($sinhvien->tai_khoan_id);
        $password = $random = Str::random(10);
        $taikhoan->password = bcrypt($password);

        if ($sinhvien->save()) {
            $resetPassword = new SendMailResetPassword($sinhvien->ho_ten, $taikhoan, $password);
            dispatch($resetPassword);
            return redirect()->back()->with('success', 'Đã gửi mail đặt lại mật khẩu');
        } else {
            return redirect()->back()->with('error', 'Đặt lại mật khẩu thất bại');
        }   
    }

    public function export()
    {
        return Excel::download(new GiangVienExport, 'Teachers.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ], [
            'file.required' => 'Trường dữ liệu không được để trống',
            'file.max' => 'Dữ liệu nhập vào có tối đa 10kb',
            'file.mimes' => 'Dữ liệu nhập vào phải là file xlsx, xls',
        ]);

        if (Excel::import(new GiangVienImport, $request->file)) {
            return back();
        } else {
            return back();
        }
    }

    public function classSubject()
    {
        $hkhientai = HocKy::where('hien_tai', 1)->get()->toArray();
        if (empty($hkhientai)) {
            return view('giangvien.danhsachhocphan');
        } else {
            foreach ($hkhientai as $key => $hkht) {
                $hkht = $hkht['ma_hoc_ky'];
            }
            $hocphans = HocPhan::where('giang_vien_id', Auth::user()->giangviens->id)->search()->paginate(15);
            return view('giangvien.danhsachhocphan', compact('hocphans', 'hkht'));   
        }
    }

    public function mark($id)
    {
        $svdks = SVDK::where('hoc_phan_id', $id)->get();
        return view('giangvien.chamdiem', compact('svdks'));
    }

    public function markStore(Request $request)
    {
        $request->validate([
            'chuyen_can' => 'required|numeric',
            'giua_ky' => 'required|numeric',
            'cuoi_ky' => 'required|numeric',
            'mon_hoc_id' => 'required|numeric',
            'sinh_vien_id' => 'required|numeric',
        ], [
            'chuyen_can.required' => 'Trường dữ liệu không được để trống',
            'chuyen_can.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'giua_ky.required' => 'Trường dữ liệu không được để trống',
            'giua_ky.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'cuoi_ky.required' => 'Trường dữ liệu không được để trống',
            'cuoi_ky.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'mon_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'mon_hoc_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'sinh_vien_id.required' => 'Trường dữ liệu không được để trống',
            'sinh_vien_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
        ]);
        $cc = (double) $request->chuyen_can;
        $gk = (double) $request->giua_ky;
        $ck = (double) $request->cuoi_ky;
        if ($cc >= 5 && $cc <= 10 && $gk >= 0 && $gk <= 10 && $ck >= 0 && $ck <= 10) {
            $diemso = DiemSo::where('sinh_vien_id', $request->sinh_vien_id)->where('mon_hoc_id', $request->mon_hoc_id)->get();
            
            if (empty($diemso->toArray())) {
                $diemso = new DiemSo;
                $diemso->mon_hoc_id = $request->mon_hoc_id;
                $diemso->sinh_vien_id = $request->sinh_vien_id;
                $diemso->giang_vien_id = Auth::user()->giangviens->id;
                $diemso->chuyen_can = $request->chuyen_can;
                $diemso->giua_ky = $request->giua_ky;
                $diemso->cuoi_ky = $request->cuoi_ky;
                $diemso->lan_hoc = 1;
                $diemso->lan_thi = 1;
                $diemtongket = ($request->chuyen_can * 0.1) + ($request->giua_ky * 0.2) + ($request->cuoi_ky * 0.7);
                $diemso->diem_tong_ket = $diemtongket;
                if ($diemtongket >= 8.5) {
                    $diemchu = 'A';
                    $danhgia = 'Đạt';
                } 
                elseif ($diemtongket >= 8.0) {
                    $diemchu = 'B+';
                    $danhgia = 'Đạt';
                } 
                elseif ($diemtongket >= 7.0) {
                    $diemchu = 'B';
                    $danhgia = 'Đạt';
                }
                elseif ($diemtongket >= 6.5) {
                    $diemchu = 'C+';
                    $danhgia = 'Đạt';
                }
                elseif ($diemtongket >= 5.5) {
                    $diemchu = 'C';
                    $danhgia = 'Đạt';
                }
                elseif ($diemtongket >= 5.0) {
                    $diemchu = 'D+';
                    $danhgia = 'Đạt';
                }
                elseif ($diemtongket >= 4.0) {
                    $diemchu = 'D';
                    $danhgia = 'Đạt';
                }
                else {
                    $diemchu = 'F';
                    $danhgia = 'Thi lại';
                }
                $diemso->diem_chu = $diemchu;
                $diemso->danh_gia = $danhgia;
                if ($diemso->save()) {
                    return redirect()->back()->with('success', 'Lưu thành công');
                } else {
                    return redirect()->back()->with('error', 'Lưu thất bại');
                }   
            } else {
                foreach ($diemso->toArray() as $key => $dstl) {
                    $id = $dstl['id'];
                    $danhgia = $dstl['danh_gia'];
                    $lanthi = $dstl['lan_thi'];
                    $lanhoc = $dstl['lan_hoc'];
                    $monhocid = $dstl['mon_hoc_id'];
                    $sinhvienid = $dstl['sinh_vien_id'];
                }
                if ($lanthi%2 == 1 &&  $danhgia = 'Thi lại') {
                    $diemso = DiemSo::findOrFail($id);
                    $diemso->lan_thi = $lanthi + 1;
                    $diemso->chuyen_can = $request->chuyen_can;
                    $diemso->giua_ky = $request->giua_ky;
                    $diemso->cuoi_ky = $request->cuoi_ky;
                    $diemtongket = ($request->chuyen_can * 0.1) + ($request->giua_ky * 0.2) + ($request->cuoi_ky * 0.7);
                    $diemso->diem_tong_ket = $diemtongket;
                    if ($diemtongket >= 8.5) {
                        $diemchu = 'A';
                        $danhgia = 'Đạt';
                    } 
                    elseif ($diemtongket >= 8.0) {
                        $diemchu = 'B+';
                        $danhgia = 'Đạt';
                    } 
                    elseif ($diemtongket >= 7.0) {
                        $diemchu = 'B';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 6.5) {
                        $diemchu = 'C+';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 5.5) {
                        $diemchu = 'C';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 5.0) {
                        $diemchu = 'D+';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 4.0) {
                        $diemchu = 'D';
                        $danhgia = 'Đạt';
                    }
                    else {
                        $diemchu = 'F';
                        $danhgia = 'Học lại';
                    }
                    $diemso->diem_chu = $diemchu;
                    $diemso->danh_gia = $danhgia;
                    if ($diemso->save()) {
                        return redirect()->back()->with('success', 'Lưu thành công');
                    } else {
                        return redirect()->back()->with('error', 'Lưu thất bại');
                    }
                } elseif ($danhgia == 'Học lại') {
                    $solandkmon = SVDK::where('sinh_vien_id', $sinhvienid)->where('mon_hoc_id', $monhocid)->get()->count();
                    if ($solandkmon - 1 != $lanhoc) {
                        return redirect()->back()->with('error', 'Đã nhập điểm cho sinh viên này rồi');
                    }
                    $diemso = DiemSo::findOrFail($id);
                    $diemso->giang_vien_id = Auth::user()->giangviens->id;
                    $diemso->chuyen_can = $request->chuyen_can;
                    $diemso->giua_ky = $request->giua_ky;
                    $diemso->cuoi_ky = $request->cuoi_ky;
                    $diemso->lan_thi = $lanthi + 1;
                    $diemso->lan_hoc = $lanhoc + 1;

                    $diemtongket = ($request->chuyen_can * 0.1) + ($request->giua_ky * 0.2) + ($request->cuoi_ky * 0.7);
                    $diemso->diem_tong_ket = $diemtongket;
                    if ($diemtongket >= 8.5) {
                        $diemchu = 'A';
                        $danhgia = 'Đạt';
                    } 
                    elseif ($diemtongket >= 8.0) {
                        $diemchu = 'B+';
                        $danhgia = 'Đạt';
                    } 
                    elseif ($diemtongket >= 7.0) {
                        $diemchu = 'B';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 6.5) {
                        $diemchu = 'C+';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 5.5) {
                        $diemchu = 'C';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 5.0) {
                        $diemchu = 'D+';
                        $danhgia = 'Đạt';
                    }
                    elseif ($diemtongket >= 4.0) {
                        $diemchu = 'D';
                        $danhgia = 'Đạt';
                    }
                    else {
                        $diemchu = 'F';
                        $danhgia = 'Thi lại';
                    }
                    $diemso->diem_chu = $diemchu;
                    $diemso->danh_gia = $danhgia;
                    if ($diemso->save()) {
                        return redirect()->back()->with('success', 'Lưu thành công');
                    } else {
                        return redirect()->back()->with('error', 'Lưu thất bại');
                    }   
                } else {
                    return redirect()->back()->with('error', 'Đã nhập điểm cho sinh viên này rồi');   
                }
            }
        } else {
            return redirect()->back()->with('error', 'Điểm nhập vào không hợp lệ');

        }
    }
}
