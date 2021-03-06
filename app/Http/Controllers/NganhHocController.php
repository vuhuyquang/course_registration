<?php

namespace App\Http\Controllers;

use App\Models\NganhHoc;
use App\Models\Khoa;
use App\Models\LopHoc;
use Illuminate\Http\Request;

class NganhHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nganhhocs = NganhHoc::orderBy('khoa_id', 'DESC')->search()->paginate(10);
        return view('quantrivien.qlnganhhoc.danhsach', compact('nganhhocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoas = Khoa::all();
        return view('quantrivien.qlnganhhoc.them', compact('khoas'));
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
            'ma_nganh' => 'required|max:20|unique:nganhhocs,ma_nganh',
            'ten_nganh' => 'required|max:50|unique:nganhhocs,ten_nganh',
            'khoa_id' => 'required|numeric'
        ], [
            'ma_nganh.required' => 'Trường dữ liệu không được để trống',
            'ma_nganh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ma_nganh.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ten_nganh.required' => 'Trường dữ liệu không được để trống',
            'ten_nganh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ten_nganh.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'khoa_id.required' => 'Trường dữ liệu không được để trống',
            'khoa_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số'
        ]);

        $nganhhoc = new NganhHoc;
        $nganhhoc->ma_nganh = $request->ma_nganh;
        $nganhhoc->ten_nganh = $request->ten_nganh;
        $nganhhoc->khoa_id = $request->khoa_id;
        if ( $nganhhoc->save()) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại');
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NganhHoc  $nganhHoc
     * @return \Illuminate\Http\Response
     */
    public function show(NganhHoc $nganhHoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NganhHoc  $nganhHoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khoas = Khoa::all();
        $nganhhoc = NganhHoc::findOrFail($id);
        return view('quantrivien.qlnganhhoc.sua', compact('nganhhoc', 'khoas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NganhHoc  $nganhHoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ma_nganh' => 'required|max:20|unique:nganhhocs,ma_nganh,'.$id,
            'ten_nganh' => 'required|max:50|unique:nganhhocs,ten_nganh,'.$id,
            'khoa_id' => 'required|numeric'
        ], [
            'ma_nganh.required' => 'Trường dữ liệu không được để trống',
            'ma_nganh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ma_nganh.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'ten_nganh.required' => 'Trường dữ liệu không được để trống',
            'ten_nganh.max' => 'Dữ liệu nhập vào có tối đa 20 ký tự',
            'ten_nganh.unique' => 'Dữ liệu nhập vào không được trùng lặp',
            'khoa_id.required' => 'Trường dữ liệu không được để trống',
            'khoa_id.numeric' => 'Dữ liệu nhập vào phải là kiểu số'
        ]);

        $nganhhoc = NganhHoc::findOrFail($id);
        $nganhhoc->ma_nganh = $request->ma_nganh;
        $nganhhoc->ten_nganh = $request->ten_nganh;
        $nganhhoc->khoa_id = $request->khoa_id;
        if ($nganhhoc->save()) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NganhHoc  $nganhHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = LopHoc::where('nganh_id', $id)->get()->count();
        if ($check == 0) {
            $nganhhoc = NganhHoc::findOrFail($id);
            if ($nganhhoc->delete()) {
                return redirect()->back()->with('success', 'Xóa thành công');
            } else {
                return redirect()->back()->with('error', 'Xóa thất bại');
            }
        } else {
            return redirect()->back()->with('error', 'Ngành học này vẫn tồn tại lớp học');
        }   
    }
}
