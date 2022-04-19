<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Auth;

class TaiKhoanController extends Controller
{
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
        if (Auth::user()->quyen == 1) {
            return redirect()->route('sinhvien.lookup');
        } elseif (Auth::user()->quyen == 2) {
            // return redirect()->route('sinhvien.lookup');
        } elseif (Auth::user()->quyen == 3) {
            return redirect()->route('sinh-vien.index');
        } else {
            return redirect()->route('getLogin');
        }  
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
