<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use App\Models\GiangVien;
use App\Models\SinhVien;
use App\Models\QuanTriVien;
use App\Models\LopHoc;
use App\Models\NganhHoc;
use App\Models\TinTuc;
use App\Models\HocPhan;
use App\Models\HocKy;
use App\Models\MonHoc;
use App\Models\SVDK;
use App\Models\HocPhi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Auth;
use Hash;

class TaiKhoanController extends Controller
{
    public function openTerm()
    {
        // Tạo học kỳ mới và mở luôn
        $thang = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->month;
        $nam = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->year;
        if ($thang >= 8) {
            $namSau = $nam + 1;
            $mahocky = $nam . '_' . $namSau . '_1';
            $mota = 'Học kỳ 1 năm học ' . $nam . ' - ' . $namSau;
        } else {
            $namTruoc = $nam - 1;
            $mahocky = $namTruoc . '_' . $nam . '_2';
            $mota = 'Học kỳ 2 năm học ' . $namTruoc . ' - ' . $nam;
        }
        $hocky = new HocKy;
        $hocky->ma_hoc_ky = $mahocky;
        $hocky->mo_ta = $mota;
        $hocky->trang_thai = 'Mở';
        $hocky->hien_tai = 0;
        $hocky->da_mo = 1;
        $hocky->save();

        // Tăng số kỳ học của sv lên 1
        $sinhviens = SinhVien::all();
        foreach ($sinhviens as $i => $sinhvien) {
            $sinhvien->so_ky_hoc = $sinhvien->so_ky_hoc + 1;
            $sinhvien->save();
        }

        // Tạo 3 học phần từ mỗi môn học
        $monhocmodks = MonHoc::where('duoc_phep', 1)->get();
        foreach ($monhocmodks as $key => $monhocmodk) {
            for ($i = 1; $i <= 3; $i++) {
                $hocphan = new HocPhan;
                $hocphan->ma_lop = Str::upper(substr(md5($monhocmodk->ma_mon_hoc . Str::upper(Str::random(8)) . time()), 0, 10));
                $hocphan->ma_hoc_phan = $monhocmodk->ma_mon_hoc;
                $hocphan->mon_hoc_id = $monhocmodk->id;
                $hocphan->so_tin_chi = $monhocmodk->so_tin_chi;
                $hocphan->ma_hoc_ky = $hocky->ma_hoc_ky;
                $hocphan->save();
            }
        }
    }

    public function closeTerm()
    {
        $hocky = HocKy::where('trang_thai', 'Mở')->first();
        $mhk = $hocky->ma_hoc_ky;

        // Xóa học kỳ nếu sĩ số <=1 hoặc >60
        $hocphans = HocPhan::where('ma_hoc_ky', $mhk)->where('da_dang_ky', '<=', 1)->orWhere('da_dang_ky', '>', 60)->get();
        foreach ($hocphans as $key => $hocphan) {
            if ($hocphan->giu_lai == 1) {
                $hocphan->delete();
            } else {
                $hocphan->forceDelete();
            }
            $svhdk = SVDK::where('hoc_phan_id', $hocphan->id)->delete();
        }

        // Cập nhật trạng thái học kỳ
        $hocky->trang_thai = 'Đóng';
        $hocky->hien_tai = 1;
        $hocky->save();

        // Cập nhật trạng thái môn học
        $monhocs = MonHoc::where('duoc_phep', 'false')->get();
        foreach ($monhocs as $key => $monhoc) {
            $monhoc->duoc_phep = 'true';
            $monhoc->save();
        }

        // Tạo dữ liệu học phí cho sinh viên
        $hocphis = SVDK::groupBy('sinh_vien_id')
            ->selectRaw('sum(so_tin_chi) as sum, sinh_vien_id')
            ->where('ma_hoc_ky', $mhk)
            ->pluck('sum', 'sinh_vien_id')->toArray();

        foreach ($hocphis as $key => $hocphi) {
            $hp = (int) $hocphi;
            $hocphi = new HocPhi;
            $hocphi->sinh_vien_id = $key;
            $hocphi->so_tin_chi = $hp;
            $hocphi->ma_hoc_ky = $mhk;
            $hocphi->save();
        }
    }

    //
    public function home()
    {
        $getTT = Http::get('http://qldt.utt.edu.vn/news');
        $tintucs = json_decode($getTT, true);
        return view('index', compact('tintucs'));
    }

    public function news()
    {
        // $tintucs = TinTuc::orderBy('ngay_dang', 'DESC')->paginate(5);
        $tintucs = TinTuc::orderBy('ngay_dang', 'DESC')->get();
        return response()->json($tintucs);
    }

    public function getLogin()
    {
        return view('dangnhap');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:60',
            'password' => 'required|min:6|max:32'
        ], [
            'email.required' => 'Trường dữ liệu không được để trống',
            'email.email' => 'Dữ liệu nhập vào phải là định dạng email',
            'email.max' => 'Dữ liệu nhập vào có tối đa 60 ký tự',
            'password.password' => 'Trường dữ liệu không được để trống',
            'password.min' => 'Dữ liệu nhập vào có tối thiểu 6 ký tự',
            'password.max' => 'Dữ liệu nhập vào có tối đa 32 ký tự',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('redirect');
        } else {
            return redirect()->back()->with('thongbao', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function redirect()
    {
        if (Auth::user()->lan_dau_tien == 1) {
            $taikhoan = TaiKhoan::findOrFail(Auth::user()->id);
            $taikhoan->lan_dau_tien = 0;
            if ($taikhoan->save()) {
                return redirect()->route('getChangePassword')->with('warning', 'Sau khi reset mật khẩu, hãy đổi lại mật khẩu để đảm bảo an toàn');
            } else {
                return redirect()->route('getLogin');
            }
        } else {
            if (Auth::user()->quyen == 1) {
                return redirect()->route('sinhvien.lookup');
            } elseif (Auth::user()->quyen == 2) {
                return redirect()->route('giangvien.classSubjects');
            } elseif (Auth::user()->quyen == 3) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('getLogin');
            }
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }

    public function profile()
    {
        if (Auth::user()->quyen == 1) {
            $sinhviens = SinhVien::where('tai_khoan_id', Auth::user()->id)->get();
            foreach ($sinhviens as $key => $sinhvien) {
                $sinhvien = $sinhvien;
            }
            $lophocs = LopHoc::all();
            $nganhhocs = NganhHoc::all();
            return view('hosocanhan', compact('sinhvien', 'lophocs', 'nganhhocs'));
        } elseif (Auth::user()->quyen == 2) {
            $giangviens = GiangVien::where('tai_khoan_id', Auth::user()->id)->get();
            foreach ($giangviens as $key => $giangvien) {
                $giangvien = $giangvien;
            }
            $nganhhocs = NganhHoc::all();
            return view('hosocanhan', compact('nganhhocs', 'giangvien'));
        } elseif (Auth::user()->quyen == 3) {
            $quantriviens = QuanTriVien::where('tai_khoan_id', Auth::user()->id)->get();
            foreach ($quantriviens as $key => $quantrivien) {
                $quantrivien = $quantrivien;
                return view('hosocanhan', compact('quantrivien'));
            }
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

    public function postProfile(Request $request)
    {
        $request->validate([
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required',
            'que_quan' => 'required|max:80',
            'so_dien_thoai' => 'required|max:10',
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ], [
            'ngay_sinh.required' => 'Trường dữ liệu không được để trống',
            'ngay_sinh.date' => 'Dữ liệu nhập vào phải là định dạng ngày tháng năm',
            'ngay_sinh.before' => 'Ngày nhập vào phải nhỏ hơn ngày hôm nay',
            'gioi_tinh.required' => 'Trường dữ liệu không được để trống',
            'que_quan.required' => 'Trường dữ liệu không được để trống',
            'que_quan.max' => 'Dữ liệu nhập vào cố tối đa 80 ký tự',
            'nganh_hoc_id.required' => 'Trường dữ liệu không được để trống',
            'nganh_hoc_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số',
            'so_dien_thoai.required' => 'Trường dữ liệu không được để trống',
            'so_dien_thoai.max' => 'Dữ liệu nhập vào cố tối đa 10 ký tự',
            'avatar.mimes' => 'File nhập vào phải có đuôi là jpeg, jpg, png, gif',
            'avatar.max' => 'File nhập vào có tối đa 10000kb',
        ]);
        // resize ảnh
        if ($request->has('avatar')) {
            $data = $this->resizeimage($request);
            $tenanh = $data['tenanh'];
            $hinhanh_resize = $data['hinhanh_resize'];
        } else {
            $tenanh = 'avatar_default.png';
        }
        // Lấy tên model
        if (Auth::user()->quyen == 1) {
            $users = SinhVien::where('tai_khoan_id', Auth::user()->id)->get();
            foreach ($users as $key => $user) {
                $user = $user;
            }
        } elseif (Auth::user()->quyen == 2) {
            $users = GiangVien::where('tai_khoan_id', Auth::user()->id)->get();
            foreach ($users as $key => $user) {
                $user = $user;
            }
        } elseif (Auth::user()->quyen == 3) {
            $users = QuanTriVien::where('tai_khoan_id', Auth::user()->id)->get();
            foreach ($users as $key => $user) {
                $user = $user;
            }
        }

        $user->ngay_sinh = $request->ngay_sinh;
        $user->gioi_tinh = $request->gioi_tinh;
        $user->que_quan = $request->que_quan;
        $user->so_dien_thoai = $request->so_dien_thoai;
        $user->avatar = $tenanh;
        if ($user->save()) {
            if ($request->has('avatar')) {
                $hinhanh_resize->save(public_path('uploads/' . $tenanh));
            }
            return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật hồ sơ thất bại');
        }
    }

    public function getChangePassword()
    {
        return view('doimatkhau');
    }

    public function postChangePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required|min:6|max:32',
            'newPassword' => 'required|min:6|max:32|different:oldPassword',
            'reNewPassword' => 'required|min:6|max:32|same:newPassword',
        ], [
            'oldPassword.required' => 'Trường dữ liệu không được để trống',
            'oldPassword.min' => 'Dữ liệu nhập vào có tối thiểu 6 ký tự',
            'oldPassword.max' => 'Dữ liệu nhập vào có đa thiểu 32 ký tự',
            'newPassword.required' => 'Trường dữ liệu không được để trống',
            'newPassword.min' => 'Dữ liệu nhập vào có tối thiểu 6 ký tự',
            'newPassword.max' => 'Dữ liệu nhập vào có đa thiểu 32 ký tự',
            'newPassword.different' => 'Mật khẩu hiện tại không được trùng với mật khẩu mới',
            'reNewPassword.required' => 'Trường dữ liệu không được để trống',
            'reNewPassword.min' => 'Dữ liệu nhập vào có tối thiểu 6 ký tự',
            'reNewPassword.max' => 'Dữ liệu nhập vào có đa thiểu 32 ký tự',
            'reNewPassword.same' => 'Xác nhận mật khẩu mới phải trùng với mật khẩu mới',
        ]);

        $taikhoan = TaiKhoan::findOrFail(Auth::user()->id);
        if (Hash::check($request->oldPassword, $taikhoan->password)) {
            $taikhoan->password = Hash::make($request->newPassword);
            if ($taikhoan->save()) {
                return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
            } else {
                return redirect()->back()->with('error', 'Đổi mật khẩu thất bại');
            }
        } else {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác');
        }
    }
}
