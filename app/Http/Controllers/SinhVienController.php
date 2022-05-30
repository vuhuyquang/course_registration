<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\NganhHoc;
use App\Models\KhoaHoc;
use App\Models\HocPhan;
use App\Models\HocKy;
use App\Models\SVDK;
use App\Models\DiemSo;
use App\Models\LopHoc;
use App\Models\MonHoc;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\SendEmailSendAccount;
use App\Jobs\SendMailResetPassword;
use Image;
use File;
use Auth;
use DB;
use App\Exports\SinhVienExport;
use App\Imports\SinhVienImport;
use Maatwebsite\Excel\Facades\Excel;

class SinhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sinhviens = SinhVien::orderBy('id', 'ASC')->search()->paginate(15);
        $khoahocs = KhoaHoc::all();
        $lophocs = LopHoc::all();
        $nganhhocs = NganhHoc::all();
        return view('quantrivien.qlsinhvien.danhsach', compact('sinhviens', 'khoahocs', 'lophocs', 'nganhhocs'));
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

    public function filters(Request $request)
    {
        $banghi = 15;
        $khoahocs = KhoaHoc::all();
        $lophocs = LopHoc::all();
        $nganhhocs = NganhHoc::all();
        $sinhviens = SinhVien::query()->nienkhoa($request)->lophoc($request)->nganhhoc($request)->search()->paginate($banghi);
        return view('quantrivien.qlsinhvien.danhsach', compact('sinhviens', 'khoahocs', 'lophocs', 'nganhhocs'));
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
            'email' => 'required|email|max:50|unique:taikhoans,email'
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
        } else {
            $tenanh = 'avatar_default.png';
        }

        $taikhoan = new TaiKhoan;
        $taikhoan->email = $request->email;
        $password = Str::random(10);
        $taikhoan->password = bcrypt($password);
        $taikhoan->lan_dau_tien = 0;
        $taikhoan->quyen = 1;
        if ($taikhoan->save()) {
            $sinhvien = new SinhVien;
            $sinhvien->ma_sinh_vien = $request->ma_sinh_vien;
            $sinhvien->ho_ten = $request->ho_ten;
            $sinhvien->nganh_hoc_id = $request->nganh_hoc_id;
            $sinhvien->khoa_hoc_id = $request->khoa_hoc_id;
            $sinhvien->lop_hoc_id = $request->lop_hoc_id;
            $sinhvien->ngay_sinh = $request->ngay_sinh;
            $sinhvien->gioi_tinh = $request->gioi_tinh;
            $sinhvien->que_quan = $request->que_quan;
            $sinhvien->avatar = $tenanh;
            $sinhvien->so_dien_thoai = $request->so_dien_thoai;
            $sinhvien->tai_khoan_id = $taikhoan->id;
            if ($sinhvien->save()) {
                if ($request->has('avatar')) {
                    $hinhanh_resize->save(public_path('uploads/' . $tenanh));
                } 
                if (dispatch(new SendEmailSendAccount($sinhvien->ho_ten, $taikhoan, $password))) {
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
        $sinhvien = SinhVien::findOrFail($id);
        $newid = $sinhvien->taikhoans->id;
        $request->validate([
            'ma_sinh_vien' => 'required|max:20|unique:sinhviens,ma_sinh_vien,'.$id,
            'ho_ten' => 'required|max:50',
            'nganh_hoc_id' => 'required|numeric',
            'khoa_hoc_id' => 'required|numeric',
            'lop_hoc_id' => 'required|numeric',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:taikhoans,email,'.$newid,
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
        } else {
            $tenanh = 'avatar_default.png';
        }

        $sinhvien = SinhVien::findOrFail($id);
        $taikhoan = TaiKhoan::findOrFail($sinhvien->tai_khoan_id);
        $taikhoan->email = $request->email;
        if ($taikhoan->save()) {
            $sinhvien->ma_sinh_vien = $request->ma_sinh_vien;
            $sinhvien->ho_ten = $request->ho_ten;
            $sinhvien->nganh_hoc_id = $request->nganh_hoc_id;
            $sinhvien->khoa_hoc_id = $request->khoa_hoc_id;
            $sinhvien->lop_hoc_id = $request->lop_hoc_id;
            $sinhvien->ngay_sinh = $request->ngay_sinh;
            $sinhvien->gioi_tinh = $request->gioi_tinh;
            $sinhvien->que_quan = $request->que_quan;
            $sinhvien->avatar = $tenanh;
            $sinhvien->so_dien_thoai = $request->so_dien_thoai;
            if ($sinhvien->save()) {
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
        $taikhoan = TaiKhoan::findOrFail($sinhvien->tai_khoan_id);
        if ($sinhvien->delete() && $taikhoan->delete()) {
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
        $taikhoan = TaiKhoan::findOrFail($sinhvien->tai_khoan_id);
        $password = $random = Str::random(10);
        $taikhoan->password = bcrypt($password);
        $taikhoan->lan_dau_tien = 1;
        if ($taikhoan->save()) {
            dispatch(new SendMailResetPassword($sinhvien->ho_ten, $taikhoan, $password));
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

    public function lookup()
    {
        $monhocs = MonHoc::where('duoc_phep', 1)->where('nganh_id', Auth::user()->sinhviens->nganh_hoc_id)->search()->paginate(15);
        $svdks = SVDK::join('hocphans', function ($join) {
            $join->on('svdks.hoc_phan_id', '=', 'hocphans.id')->where('sinh_vien_id', Auth::user()->sinhviens->id);
        })->paginate(15);
        $sl = DB::table('hockys')->where('trang_thai', 'Mở')->count();
        if ($sl == 1) {
            if (empty($monhocs)) {
                return view('sinhvien.lophocmodk', compact('monhocs', 'svdks'));
            } else {
                return view('sinhvien.lophocmodk', compact('monhocs', 'svdks'))->with('error', 'Không tìm thấy môn học này');
            }
        } else {
            return view('sinhvien.lophocmodk')->with('error', 'Chưa mở đăng ký học phần');
        }
    }

    public function lookupid($id)
    {
        $hockydangmo = HocKy::where('trang_thai', 'Mở')->get()->toArray();
        foreach ($hockydangmo as $key => $hk) {
            $hkmo = $hk['ma_hoc_ky'];
        }
        $hocphans = HocPhan::where('mon_hoc_id', $id)->where('ma_hoc_ky', $hkmo)->get();
        return view('sinhvien.danhsachhocphan', compact('hocphans'));
    }

    public function register()
    {
        $svdks = SVDK::join('hocphans', function ($join){
            $join->on('svdks.hoc_phan_id', '=', 'hocphans.id')->where('sinh_vien_id', Auth::user()->sinhviens->id);
        })->paginate(15);
        $hkhts = HocKy::where('hien_tai', 1)->orWhere('trang_thai', 'Mở')->get()->toArray();
        foreach ($hkhts as $key => $hkht) {
            $hkht = $hkht['ma_hoc_ky'];
        }
        if (!empty($svdks) && !empty($hkht)) {
            return view('sinhvien.dangkymonhoc', compact('svdks', 'hkht'));
        } else {
            return view('sinhvien.dangkymonhoc');
        }
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'ma_lop' => 'required',
        ], [
            'ma_lop.required' => 'Trường dữ liệu không được để trống',
        ]);
        
        $hockymos = DB::table('hockys')->where('trang_thai', 'Mở')->get()->toArray();
        foreach ($hockymos as $key => $hockymo) {
            $hockymo = $hockymo->ma_hoc_ky;
        }
        $sl = DB::table('hockys')->where('trang_thai', 'Mở')->count();
        if ($sl == 1) {
            // Lấy ra hoc_phan_id, mon_hoc_id và tăng sl đk thêm 1
            $hocphans = HocPhan::where('ma_lop', $request->ma_lop)->get()->toArray();
            if (!empty($hocphans)) {
                foreach ($hocphans as $key => $hocphan) {
                    $hocphanid = $hocphan['id'];
                    $monhocid = $hocphan['mon_hoc_id'];
                    $sotinchi = $hocphan['so_tin_chi'];
                    $monhoc = MonHoc::findOrFail($hocphan['mon_hoc_id']);
                    $monhocnganhid = $monhoc->nganh_id;
                    $hp = HocPhan::findOrFail($hocphanid);
                    $hp->da_dang_ky = $hocphan['da_dang_ky'] + 1;
                }

                // Lấy ra sinh_vien_id và ngành học của sv
                $sinhviens = SinhVien::where('tai_khoan_id', Auth::user()->id)->get();
                foreach ($sinhviens as $key => $sinhvien) {
                    $sinhvienid = $sinhvien->id;
                    $sinhviennganhid = $sinhvien->nganh_hoc_id;
                }

                $tongstc = SVDK::where('sinh_vien_id', $sinhvienid)->sum('so_tin_chi');

                if ($monhocnganhid == $sinhviennganhid) {
                    if ($tongstc + $sotinchi <= 25) {
                        // Kiểm tra học phần, môn học nhập vào đã đc đk chưa
                        $monhocdadk = SVDK::where('mon_hoc_id', $monhocid)->where('sinh_vien_id', $sinhvienid)->get()->count();
                        $hocphandadk = SVDK::where('hoc_phan_id', $hocphanid)->where('sinh_vien_id', $sinhvienid)->get()->count();
                        if ($monhocdadk == 0 && $hocphandadk == 0) {
                            // tạo 1 đối tượng đăng ký
                            if ($hocphan) {
                                $svdk = new SVDK;
                                $svdk->hoc_phan_id = $hocphanid;
                                $svdk->sinh_vien_id = $sinhvienid;
                                $svdk->mon_hoc_id = $monhocid;
                                $svdk->so_tin_chi = $sotinchi;
                                $svdk->nganh_id = $sinhviennganhid;
                                $svdk->ma_hoc_ky = $hockymo;
                                if ($svdk->save()) {
                                    $hp->save();
                                    return redirect()->back()->with('success', 'Đăng ký học phần thành công');
                                } else {
                                    return redirect()->back()->with('error', 'Đăng ký học phần thất bại');
                                }
                            } else {
                                return redirect()->back()->with('error', 'Không tìm thấy học phần này');
                            }
                        } else {
                            $diemsos = DB::table('diemsos')->where('sinh_vien_id', Auth::user()->sinhviens->id)->where('mon_hoc_id', $monhocid)->where('danh_gia', 'Học lại')->get()->toArray();
                            if (!empty($diemsos)) {
                                $svdk = new SVDK;
                                $svdk->hoc_phan_id = $hocphanid;
                                $svdk->sinh_vien_id = $sinhvienid;
                                $svdk->mon_hoc_id = $monhocid;
                                $svdk->so_tin_chi = $sotinchi;
                                $svdk->nganh_id = $sinhviennganhid;
                                $svdk->ma_hoc_ky = $hockymo;
                                if ($svdk->save()) {
                                    $hp->save();
                                    return redirect()->back()->with('success', 'Đăng ký học phần thành công');
                                } else {
                                    return redirect()->back()->with('error', 'Đăng ký học phần thất bại');
                                }
                            } else {
                                return redirect()->back()->with('error', 'Môn học / học phần này đã được đăng ký');
                            }
                        }
                    } else {
                        return redirect()->back()->with('error', 'Mỗi học kỳ chỉ được đăng ký tối đa 25 tín chỉ');
                    }
                } else {
                    return redirect()->back()->with('error', 'Ngành học của bạn không thể đăng ký môn học này');
                }
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy mã lớp này');
            }
        } else {
            return redirect()->back()->with('error', 'Chưa mở đăng ký học phần');
        }
    }

    public function export()
    {
        return Excel::download(new SinhVienExport, 'Students.xlsx');
    }

    public function cancelRegister($id)
    {
        $svdk = SVDK::where('sinh_vien_id', Auth::user()->sinhviens->id)->where('hoc_phan_id', $id);
        $hocphan = HocPhan::findOrFail($id);
        $hocphan->da_dang_ky = $hocphan->da_dang_ky - 1;

        $hockymos = DB::table('hockys')->where('trang_thai', 'Mở')->get()->toArray();
        foreach ($hockymos as $key => $hockymo) {
            $hockymo = $hockymo->ma_hoc_ky;
        }
        $sl = DB::table('hockys')->where('trang_thai', 'Mở')->count();
        if ($sl == 1) {
            if ($svdk->delete()) {
                $hocphan->save();
                return redirect()->back()->with('success', 'Huy đăng ký thành công');
            } else {
                return redirect()->back()->with('error', 'Huy đăng ký thất bại');
            }
        } else {
            return redirect()->back()->with('error', 'Đã hết thời hạn hủy đăng ký');
        }
    }

    public function scores()
    {
        $sl = DiemSo::where('sinh_vien_id', Auth::user()->sinhviens->id)->count();
        $idsv = Auth::user()->sinhviens->id;
        $diemtongket = DiemSo::groupBy('sinh_vien_id')
        ->selectRaw('sum(diem_tong_ket) as sum, sinh_vien_id')
        ->where('sinh_vien_id', $idsv)
        ->pluck('sum', 'sinh_vien_id')->toArray();
        if (!empty($diemtongket)) {
            $dtb = round(($diemtongket[Auth::user()->sinhviens->id]) / $sl, 2);
            $gpa = round($dtb/10 * 4, 2);
        } else {
            $dtb = null;
            $gpa = null;
        }
        $diemsos = DiemSo::where('sinh_vien_id', Auth::user()->sinhviens->id)->get();
        return view('sinhvien.diemso', compact('diemsos', 'dtb', 'gpa'));
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

        if (Excel::import(new SinhVienImport, $request->file)) {
            return back();
        } else {
            return back();
        }
    }

    public function fee()
    {
        return view('quantrivien.hocphi.index');
    }

    public function feeStore(Request $request)
    {
        dd($request);
    }
}
