<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tintucs = TinTuc::orderBy('ngay_dang', 'DESC')->paginate(10);
        return view('quantrivien.qltintuc.danhsach', compact('tintucs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quantrivien.qltintuc.them');
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
            'tieu_de' => 'required',
            'noi_dung_ngan' => 'required',
            'hinh_anh' => 'required',
            'duong_dan' => 'required',
        ], [
            'tieu_de.required' => 'Trường dữ liệu không được để trống',
            'noi_dung_ngan.required' => 'Trường dữ liệu không được để trống',
            'hinh_anh.required' => 'Trường dữ liệu không được để trống',
            'duong_dan.required' => 'Trường dữ liệu không được để trống',
        ]);
        $tintuc = new TinTuc;
        $tintuc->tieu_de = $request->tieu_de;
        $tintuc->noi_dung_ngan = $request->noi_dung_ngan;
        $tintuc->hinh_anh = $request->hinh_anh;
        $tintuc->duong_dan = $request->duong_dan;
        $tintuc->ngay_dang = $request->ngay_dang;
        if ($tintuc->save()) {
            return back()->with('success', 'Thêm thành công');
        } else {
            return back()->with('error', 'Thêm thất bại');
        }   
    }

    public function destroy(TinTuc $tinTuc, $id)
    {
        $tintuc = TinTuc::findOrFail($id);
        if ($tintuc->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }
}
