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
use App\Models\HocPhi;
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
            'ma_sinh_vien.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'ma_sinh_vien.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p',
            'ma_sinh_vien.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
            'ho_ten.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'ho_ten.max' => 'D??? li???u nh???p v??o c?? t???i ??a 50 k?? t???',
            'nganh_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'nganh_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'khoa_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'khoa_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'lop_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'lop_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'ngay_sinh.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'ngay_sinh.date' => 'D??? li???u nh???p v??o ph???i l?? ki???u date',
            'ngay_sinh.before' => 'Ng??y sinh ph???i nh??? h??n ng??y hi???n t???i',
            'gioi_tinh.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'gioi_tinh.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
            'que_quan.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'que_quan.max' => 'D??? li???u nh???p v??o c?? t???i ??a 80 k?? t???',
            'email.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'email.max' => 'D??? li???u nh???p v??o c?? t???i ??a 50 k?? t???',
            'email.email' => 'D??? li???u nh???p v??o ph???i l?? ki???u mail',
            'email.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p'
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
                    return redirect()->back()->with('success', 'Th??m th??nh c??ng. ???? g???i mail c???p t??i kho???n');
                } else {
                    return redirect()->back()->with('success', 'Th??m th??nh c??ng. ???? c?? l???i khi g???i mail');
                }
            } else {
                return redirect()->back()->with('error', 'Th??m th???t b???i');
            }
        } else {
            return redirect()->back()->with('error', 'Th??m th???t b???i');
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
            'ma_sinh_vien' => 'required|max:20|unique:sinhviens,ma_sinh_vien,' . $id,
            'ho_ten' => 'required|max:50',
            'nganh_hoc_id' => 'required|numeric',
            'khoa_hoc_id' => 'required|numeric',
            'lop_hoc_id' => 'required|numeric',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required|max:20',
            'que_quan' => 'required|max:80',
            'email' => 'required|email|max:50|unique:taikhoans,email,' . $newid,
        ], [
            'ma_sinh_vien.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'ma_sinh_vien.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p',
            'ma_sinh_vien.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
            'ho_ten.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'ho_ten.max' => 'D??? li???u nh???p v??o c?? t???i ??a 50 k?? t???',
            'nganh_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'nganh_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'khoa_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'khoa_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'lop_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'lop_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'ngay_sinh.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'ngay_sinh.date' => 'D??? li???u nh???p v??o ph???i l?? ki???u date',
            'ngay_sinh.before' => 'Ng??y sinh ph???i nh??? h??n ng??y hi???n t???i',
            'gioi_tinh.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'gioi_tinh.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
            'que_quan.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'que_quan.max' => 'D??? li???u nh???p v??o c?? t???i ??a 80 k?? t???',
            'email.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'email.max' => 'D??? li???u nh???p v??o c?? t???i ??a 50 k?? t???',
            'email.email' => 'D??? li???u nh???p v??o ph???i l?? ki???u mail',
            'email.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p'
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
                return redirect()->back()->with('success', 'C???p nh???t th??nh c??ng');
            } else {
                return redirect()->back()->with('error', 'C???p nh???t th???t b???i');
            }
        } else {
            return redirect()->back()->with('error', 'C???p nh???t th???t b???i');
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
            return redirect()->back()->with('success', 'X??a th??nh c??ng');
        } else {
            return redirect()->back()->with('error', 'X??a th???t b???i');
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
            return redirect()->back()->with('success', '???? g???i mail ?????t l???i m???t kh???u');
        } else {
            return redirect()->back()->with('error', '?????t l???i m???t kh???u th???t b???i');
        }
    }

    public function profile($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        return view('quantrivien.qlsinhvien.hosocanhan', compact('sinhvien'));
    }

    public function lookup()
    {
        $skh = SinhVien::where('tai_khoan_id', Auth::user()->id)->first()->so_ky_hoc;
        $monhocs = MonHoc::where('duoc_phep', 1)->where('nganh_id', Auth::user()->sinhviens->nganh_hoc_id)->where('hoc_ky', '<=', $skh + 1)->orderBy('hoc_ky')->search()->paginate(15);
        $svdks = SVDK::join('hocphans', function ($join) {
            $join->on('svdks.hoc_phan_id', '=', 'hocphans.id')->where('sinh_vien_id', Auth::user()->sinhviens->id);
        })->paginate(15);
        $sl = DB::table('hockys')->where('trang_thai', 'M???')->count();
        if ($sl == 1) {
            if (empty($monhocs)) {
                return view('sinhvien.lophocmodk', compact('monhocs', 'svdks'));
            } else {
                return view('sinhvien.lophocmodk', compact('monhocs', 'svdks'))->with('error', 'Kh??ng t??m th???y m??n h???c n??y');
            }
        } else {
            return view('sinhvien.lophocmodk')->with('error', 'Ch??a m??? ????ng k?? h???c ph???n');
        }
    }

    public function lookupid($id)
    {
        $hockydangmo = HocKy::where('trang_thai', 'M???')->get()->toArray();
        foreach ($hockydangmo as $key => $hk) {
            $hkmo = $hk['ma_hoc_ky'];
        }
        $hocphans = HocPhan::where('mon_hoc_id', $id)->where('ma_hoc_ky', $hkmo)->get();
        return view('sinhvien.danhsachhocphan', compact('hocphans'));
    }

    public function register()
    {
        $svdks = SVDK::join('hocphans', function ($join) {
            $join->on('svdks.hoc_phan_id', '=', 'hocphans.id')->where('sinh_vien_id', Auth::user()->sinhviens->id);
        })->paginate(15);
        $hkhts = HocKy::where('hien_tai', 1)->orWhere('trang_thai', 'M???')->get()->toArray();
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
            'ma_lop.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
        ]);
        $skh = SinhVien::where('tai_khoan_id', Auth::user()->id)->first()->so_ky_hoc;

        $hockymos = DB::table('hockys')->where('trang_thai', 'M???')->get()->toArray();
        foreach ($hockymos as $key => $hockymo) {
            $hockymo = $hockymo->ma_hoc_ky;
        }
        $sl = DB::table('hockys')->where('trang_thai', 'M???')->count();
        if ($sl == 1) {
            // L???y ra hoc_phan_id, mon_hoc_id v?? t??ng sl ??k th??m 1
            $hocphans = HocPhan::where('ma_lop', $request->ma_lop)->get()->toArray();
            if (!empty($hocphans)) {
                foreach ($hocphans as $key => $hocphan) {
                    $hocphanid = $hocphan['id'];
                    $monhocid = $hocphan['mon_hoc_id'];
                    $sotinchi = $hocphan['so_tin_chi'];
                    $monhoc = MonHoc::findOrFail($hocphan['mon_hoc_id']);
                    if ($skh == 1 && $monhoc->hoc_ky <= $skh + 1) {
                        $monhocnganhid = $monhoc->nganh_id;
                        $hp = HocPhan::findOrFail($hocphanid);
                        $hp->da_dang_ky = $hocphan['da_dang_ky'] + 1;
                        $hp->giu_lai = 1;
                    } else {
                        if ($monhoc->hoc_ky <= $skh + 1) {
                            $monhocnganhid = $monhoc->nganh_id;
                            $hp = HocPhan::findOrFail($hocphanid);
                            $hp->da_dang_ky = $hocphan['da_dang_ky'] + 1;
                            $hp->giu_lai = 1;
                        } else {
                            return redirect()->back()->with('error', 'Kh??ng th??? ????ng k?? m??n h???c n??y v?? s??? k??? h???c ch??a ?????');
                        }
                    }
                }

                // L???y ra sinh_vien_id v?? ng??nh h???c c???a sv
                $sinhviens = SinhVien::where('tai_khoan_id', Auth::user()->id)->get();
                foreach ($sinhviens as $key => $sinhvien) {
                    $sinhvienid = $sinhvien->id;
                    $sinhviennganhid = $sinhvien->nganh_hoc_id;
                }

                $tongstc = SVDK::where('sinh_vien_id', $sinhvienid)->sum('so_tin_chi');

                if ($monhocnganhid == $sinhviennganhid) {
                    if ($tongstc + $sotinchi <= 25) {
                        // Ki???m tra h???c ph???n, m??n h???c nh???p v??o ???? ??c ??k ch??a
                        $monhocdadk = SVDK::where('mon_hoc_id', $monhocid)->where('sinh_vien_id', $sinhvienid)->get()->count();
                        $hocphandadk = SVDK::where('hoc_phan_id', $hocphanid)->where('sinh_vien_id', $sinhvienid)->get()->count();
                        if ($monhocdadk == 0 && $hocphandadk == 0) {
                            // t???o 1 ?????i t?????ng ????ng k??
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
                                    return redirect()->back()->with('success', '????ng k?? h???c ph???n th??nh c??ng');
                                } else {
                                    return redirect()->back()->with('error', '????ng k?? h???c ph???n th???t b???i');
                                }
                            } else {
                                return redirect()->back()->with('error', 'Kh??ng t??m th???y h???c ph???n n??y');
                            }
                        } else {
                            $diemsos = DB::table('diemsos')->where('sinh_vien_id', Auth::user()->sinhviens->id)->where('mon_hoc_id', $monhocid)->where('danh_gia', 'H???c l???i')->get()->toArray();
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
                                    return redirect()->back()->with('success', '????ng k?? h???c ph???n th??nh c??ng');
                                } else {
                                    return redirect()->back()->with('error', '????ng k?? h???c ph???n th???t b???i');
                                }
                            } else {
                                return redirect()->back()->with('error', 'M??n h???c / h???c ph???n n??y ???? ???????c ????ng k??');
                            }
                        }
                    } else {
                        return redirect()->back()->with('error', 'M???i h???c k??? ch??? ???????c ????ng k?? t???i ??a 25 t??n ch???');
                    }
                } else {
                    return redirect()->back()->with('error', 'Ng??nh h???c c???a b???n kh??ng th??? ????ng k?? m??n h???c n??y');
                }
            } else {
                return redirect()->back()->with('error', 'Kh??ng t??m th???y m?? l???p n??y');
            }
        } else {
            return redirect()->back()->with('error', 'Ch??a m??? ????ng k?? h???c ph???n');
        }
    }

    public function curriculum()
    {
        $nganhhocid = SinhVien::where('tai_khoan_id', Auth::user()->id)->first()->nganh_hoc_id;
        $monhocs = MonHoc::orderBy('hoc_ky')->where('nganh_id', $nganhhocid)->paginate(15);
        return view('sinhvien.chuongtrinhhoc', compact('monhocs'));
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
        $hocphan->giu_lai = 1;
        // $hocphan->deleted_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');

        $hockymos = DB::table('hockys')->where('trang_thai', 'M???')->get()->toArray();
        foreach ($hockymos as $key => $hockymo) {
            $hockymo = $hockymo->ma_hoc_ky;
        }
        $sl = DB::table('hockys')->where('trang_thai', 'M???')->count();
        if ($sl == 1) {
            if ($svdk->delete()) {
                $hocphan->save();
                return redirect()->back()->with('success', 'Huy ????ng k?? th??nh c??ng');
            } else {
                return redirect()->back()->with('error', 'Huy ????ng k?? th???t b???i');
            }
        } else {
            return redirect()->back()->with('error', '???? h???t th???i h???n h???y ????ng k??');
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
            $gpa = round($dtb / 10 * 4, 2);
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
            'file.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'file.max' => 'D??? li???u nh???p v??o c?? t???i ??a 10kb',
            'file.mimes' => 'D??? li???u nh???p v??o ph???i l?? file xlsx, xls',
        ]);

        if (Excel::import(new SinhVienImport, $request->file)) {
            return back();
        } else {
            return back();
        }
    }

    public function fee()
    {
        $mahocky = DB::table('hockys')->orWhere('hien_tai', 1)->first();
        if (!empty($mahocky)) {
            $mhk = $mahocky->ma_hoc_ky;
        } else {
            return redirect()->back()->with('error', 'Ch??? ???????c xem h???c ph?? khi ???? ????ng ????ng k?? h???c ph???n');
        }

        if (isset($_GET['message'])) {
            $hocphi = HocPhi::where('sinh_vien_id', Auth::user()->sinhviens->id)->get();
            foreach ($hocphi as $key => $hp) {
                $hp->da_dong = 1;
                $hp->save();
            }
        }

        $tonghocphi = HocPhi::groupBy('sinh_vien_id')
        ->selectRaw('sum(so_tin_chi) as sum, sinh_vien_id')
        ->where('sinh_vien_id', Auth::user()->sinhviens->id)
        ->whereNull('da_dong')
        ->pluck('sum', 'sinh_vien_id')->toArray();
        if ($tonghocphi == null) {
            return view('sinhvien.hocphi.index');
        } else {
            foreach ($tonghocphi as $key => $hocphi) {
                $hocphi = $hocphi * 390000;
            }
            return view('sinhvien.hocphi.index', compact('hocphi'));
        }  
    }
    /////////// THANH TO??N H???C PH?? /////////////
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function feeStore(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh to??n qua MoMo";
        $amount = $request->hoc_phi;
        $orderId = time() . "";
        $redirectUrl = "https://qldt.utt.edu.vn/student/fee";
        $ipnUrl = "https://qldt.utt.edu.vn/student/fee";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
    }
}
