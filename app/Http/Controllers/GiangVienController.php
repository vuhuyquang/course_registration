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
    public function index()
    {
        $nganhhocs = NganhHoc::all();
        $giangviens = GiangVien::orderBy('id', 'ASC')->search()->paginate(15);
        return view('quantrivien.qlgiangvien.danhsach', compact('giangviens', 'nganhhocs'));
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
            'ma_giang_vien.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'ma_giang_vien.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p',
            'ma_giang_vien.max' => 'D??? li???u nh???p v??o ph???i nh??? h??n 20 k?? t???',
            'ho_ten.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'ho_ten.max' => 'D??? li???u nh???p v??o ph???i nh??? h??n 50 k?? t???',
            'trinh_do.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'trinh_do.max' => 'D??? li???u nh???p v??o ph???i nh??? h??n 20 k?? t???',
            'nganh_hoc_id.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'nganh_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'ngay_sinh.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'ngay_sinh.date' => 'D??? li???u nh???p v??o ph???i l?? ki???u date',
            'gioi_tinh.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'gioi_tinh.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
            'que_quan.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'que_quan.max' => 'D??? li???u nh???p v??o c?? t???i ??a 80 k?? t???',
            'email.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'email.max' => 'D??? li???u nh???p v??o c?? t???i ??a 50 k?? t???',
            'email.email' => 'D??? li???u nh???p v??o ph???i l?? ki???u mail',
            'email.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p',
            'so_dien_thoai.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'so_dien_thoai.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
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
            'ma_giang_vien.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'ma_giang_vien.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p',
            'ma_giang_vien.max' => 'D??? li???u nh???p v??o ph???i nh??? h??n 20 k?? t???',
            'ho_ten.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'ho_ten.max' => 'D??? li???u nh???p v??o ph???i nh??? h??n 50 k?? t???',
            'trinh_do.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'trinh_do.max' => 'D??? li???u nh???p v??o ph???i nh??? h??n 20 k?? t???',
            'nganh_hoc_id.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'nganh_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i ph???i l?? ki???u s???',
            'ngay_sinh.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'ngay_sinh.date' => 'D??? li???u nh???p v??o ph???i l?? ki???u date',
            'gioi_tinh.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'gioi_tinh.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
            'que_quan.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'que_quan.max' => 'D??? li???u nh???p v??o c?? t???i ??a 80 k?? t???',
            'email.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'email.max' => 'D??? li???u nh???p v??o c?? t???i ??a 50 k?? t???',
            'email.email' => 'D??? li???u nh???p v??o ph???i l?? ki???u mail',
            'email.unique' => 'D??? li???u nh???p v??o kh??ng ???????c tr??ng l???p',
            'so_dien_thoai.required' => 'D??? li???u nh???p v??o kh??ng ???????c ????? tr???ng',
            'so_dien_thoai.max' => 'D??? li???u nh???p v??o c?? t???i ??a 20 k?? t???',
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
                return redirect()->back()->with('success', 'C???p nh???t th??nh c??ng');
            } else {
                return redirect()->back()->with('error', 'C???p nh???t th???t b???i');
            }
        } else {
            return redirect()->back()->with('error', 'C???p nh???t th???t b???i');
        }
    }

    public function filters(Request $request)
    {
        $banghi = 15;
        $nganhhocs = NganhHoc::all();
        $giangviens = GiangVien::query()->trinhdo($request)->nganhhoc($request)->search()->paginate($banghi);
        return view('quantrivien.qlgiangvien.danhsach', compact('giangviens', 'nganhhocs'));
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
            return redirect()->back()->with('success', 'X??a th??nh c??ng');
        } else {
            return redirect()->back()->with('error', 'X??a th???t b???i');
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
            return redirect()->back()->with('success', '???? g???i mail ?????t l???i m???t kh???u');
        } else {
            return redirect()->back()->with('error', '?????t l???i m???t kh???u th???t b???i');
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
            'file.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'file.max' => 'D??? li???u nh???p v??o c?? t???i ??a 10kb',
            'file.mimes' => 'D??? li???u nh???p v??o ph???i l?? file xlsx, xls',
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
        $mahocky = DB::table('hockys')->orWhere('hien_tai', 1)->first();
        $mhk = $mahocky->ma_hoc_ky;
        $request->validate([
            'chuyen_can' => 'required|numeric',
            'giua_ky' => 'required|numeric',
            'cuoi_ky' => 'required|numeric',
            'mon_hoc_id' => 'required|numeric',
            'sinh_vien_id' => 'required|numeric',
        ], [
            'chuyen_can.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'chuyen_can.numeric' => 'D??? li???u nh???p v??o ph???i l?? ki???u s???',
            'giua_ky.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'giua_ky.numeric' => 'D??? li???u nh???p v??o ph???i l?? ki???u s???',
            'cuoi_ky.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'cuoi_ky.numeric' => 'D??? li???u nh???p v??o ph???i l?? ki???u s???',
            'mon_hoc_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'mon_hoc_id.numeric' => 'D??? li???u nh???p v??o ph???i l?? ki???u s???',
            'sinh_vien_id.required' => 'Tr?????ng d??? li???u kh??ng ???????c ????? tr???ng',
            'sinh_vien_id.numeric' => 'D??? li???u nh???p v??o ph???i l?? ki???u s???',
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
                $diemso->ma_hoc_ky = $mhk;
                if ($diemtongket >= 8.5) {
                    $diemchu = 'A';
                    $danhgia = '?????t';
                } 
                elseif ($diemtongket >= 8.0) {
                    $diemchu = 'B+';
                    $danhgia = '?????t';
                } 
                elseif ($diemtongket >= 7.0) {
                    $diemchu = 'B';
                    $danhgia = '?????t';
                }
                elseif ($diemtongket >= 6.5) {
                    $diemchu = 'C+';
                    $danhgia = '?????t';
                }
                elseif ($diemtongket >= 5.5) {
                    $diemchu = 'C';
                    $danhgia = '?????t';
                }
                elseif ($diemtongket >= 5.0) {
                    $diemchu = 'D+';
                    $danhgia = '?????t';
                }
                elseif ($diemtongket >= 4.0) {
                    $diemchu = 'D';
                    $danhgia = '?????t';
                }
                else {
                    $diemchu = 'F';
                    $danhgia = 'Thi l???i';
                }
                $diemso->diem_chu = $diemchu;
                $diemso->danh_gia = $danhgia;
                if ($diemso->save()) {
                    return redirect()->back()->with('success', 'L??u th??nh c??ng');
                } else {
                    return redirect()->back()->with('error', 'L??u th???t b???i');
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
                if ($lanthi%2 == 1 &&  $danhgia = 'Thi l???i') {
                    $diemso = DiemSo::findOrFail($id);
                    $diemso->lan_thi = $lanthi + 1;
                    $diemso->chuyen_can = $request->chuyen_can;
                    $diemso->giua_ky = $request->giua_ky;
                    $diemso->cuoi_ky = $request->cuoi_ky;
                    $diemtongket = ($request->chuyen_can * 0.1) + ($request->giua_ky * 0.2) + ($request->cuoi_ky * 0.7);
                    $diemso->diem_tong_ket = $diemtongket;
                    $diemso->ma_hoc_ky = $mhk;
                    if ($diemtongket >= 8.5) {
                        $diemchu = 'A';
                        $danhgia = '?????t';
                    } 
                    elseif ($diemtongket >= 8.0) {
                        $diemchu = 'B+';
                        $danhgia = '?????t';
                    } 
                    elseif ($diemtongket >= 7.0) {
                        $diemchu = 'B';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 6.5) {
                        $diemchu = 'C+';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 5.5) {
                        $diemchu = 'C';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 5.0) {
                        $diemchu = 'D+';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 4.0) {
                        $diemchu = 'D';
                        $danhgia = '?????t';
                    }
                    else {
                        $diemchu = 'F';
                        $danhgia = 'H???c l???i';
                    }
                    $diemso->diem_chu = $diemchu;
                    $diemso->danh_gia = $danhgia;
                    if ($diemso->save()) {
                        return redirect()->back()->with('success', 'L??u th??nh c??ng');
                    } else {
                        return redirect()->back()->with('error', 'L??u th???t b???i');
                    }
                } elseif ($danhgia == 'H???c l???i') {
                    $solandkmon = SVDK::where('sinh_vien_id', $sinhvienid)->where('mon_hoc_id', $monhocid)->get()->count();
                    if ($solandkmon - 1 != $lanhoc) {
                        return redirect()->back()->with('error', '???? nh???p ??i???m cho sinh vi??n n??y r???i');
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
                    $diemso->ma_hoc_ky = $mhk;
                    if ($diemtongket >= 8.5) {
                        $diemchu = 'A';
                        $danhgia = '?????t';
                    } 
                    elseif ($diemtongket >= 8.0) {
                        $diemchu = 'B+';
                        $danhgia = '?????t';
                    } 
                    elseif ($diemtongket >= 7.0) {
                        $diemchu = 'B';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 6.5) {
                        $diemchu = 'C+';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 5.5) {
                        $diemchu = 'C';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 5.0) {
                        $diemchu = 'D+';
                        $danhgia = '?????t';
                    }
                    elseif ($diemtongket >= 4.0) {
                        $diemchu = 'D';
                        $danhgia = '?????t';
                    }
                    else {
                        $diemchu = 'F';
                        $danhgia = 'Thi l???i';
                    }
                    $diemso->diem_chu = $diemchu;
                    $diemso->danh_gia = $danhgia;
                    if ($diemso->save()) {
                        return redirect()->back()->with('success', 'L??u th??nh c??ng');
                    } else {
                        return redirect()->back()->with('error', 'L??u th???t b???i');
                    }   
                } else {
                    return redirect()->back()->with('error', '???? nh???p ??i???m cho sinh vi??n n??y r???i');   
                }
            }
        } else {
            return redirect()->back()->with('error', '??i???m nh???p v??o kh??ng h???p l???');

        }
    }
}
