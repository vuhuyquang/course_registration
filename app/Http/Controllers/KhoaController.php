<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;

class KhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khoas = Khoa::all();
        return view('quantrivien.qlkhoa.danhsach', compact('khoas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quantrivien.qlkhoa.them');
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
            'ma_khoa' => 'required|unique:khoas,ma_khoa|max:20',
            'ten_khoa' => 'required|unique:khoas,ten_khoa|max:50'
        ], [
            'ma_khoa.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_khoa.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_khoa.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ten_khoa.required' => 'Dữ liệu nhập vào không được để trống',
            'ten_khoa.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự',
            'ten_khoa.unique' => 'Dữ liệu nhập vào không được trùng lặp'
        ]);

        $khoa = new Khoa;
        $khoa->ma_khoa = $request->ma_khoa;
        $khoa->ten_khoa = $request->ten_khoa;
        $khoa->save();
        return redirect()->back()->with('thongbao', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Khoa  $khoa
     * @return \Illuminate\Http\Response
     */
    public function show(Khoa $khoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Khoa  $khoa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $khoa = Khoa::findOrFail($id);
        return view('quantrivien.qlkhoa.sua', compact('khoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Khoa  $khoa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $khoa = Khoa::findOrFail($id);
        $request->validate([
            'ma_khoa' => 'required|max:20|unique:khoas,ma_khoa,'.$id,
            'ten_khoa' => 'required|max:50|unique:khoas,ten_khoa,'.$id,
        ], [
            'ma_khoa.required' => 'Dữ liệu nhập vào không được để trống',
            'ma_khoa.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_khoa.max' => 'Dữ liệu nhập vào phải nhỏ hơn 20 ký tự',
            'ten_khoa.required' => 'Dữ liệu nhập vào không được để trống',
            'ten_khoa.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ten_khoa.max' => 'Dữ liệu nhập vào phải nhỏ hơn 50 ký tự'
        ]);

        $khoa->ma_khoa = $request->ma_khoa;
        $khoa->ten_khoa = $request->ten_khoa;
        $khoa->save();
        return redirect()->back()->with('thongbao', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Khoa  $khoa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $khoa = Khoa::findOrFail($id);
        $khoa->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
}
