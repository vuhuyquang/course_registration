<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use App\Models\LopHoc;
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
        $khoas = Khoa::orderBy('id', 'ASC')->search()->paginate(10);
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
            'ma_khoa.required' => 'Trường dữ liệu không được để trống',
            'ma_khoa.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_khoa.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ten_khoa.required' => 'Trường dữ liệu không được để trống',
            'ten_khoa.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'ten_khoa.unique' => 'Trường dữ liệu không được trùng lặp'
        ]);

        $khoa = new Khoa;
        $khoa->ma_khoa = $request->ma_khoa;
        $khoa->ten_khoa = $request->ten_khoa;
        if ($khoa->save()) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Khoa  $khoa
     * @return \Illuminate\Http\Response
     */

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
            'ma_khoa.required' => 'Trường dữ liệu không được để trống',
            'ma_khoa.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ma_khoa.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ten_khoa.required' => 'Trường dữ liệu không được để trống',
            'ten_khoa.max' => 'Dữ liệu nhập vào có tối đa 50 ký tự',
            'ten_khoa.unique' => 'Trường dữ liệu không được trùng lặp'
        ]);

        $khoa->ma_khoa = $request->ma_khoa;
        $khoa->ten_khoa = $request->ten_khoa;
        if ($khoa->save()) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
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
        if ($khoa->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }
}
