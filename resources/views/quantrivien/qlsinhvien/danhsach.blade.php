@extends('layouts.site')

@section('main')
    <div class="card">
        <div class="card">
            <form action="{{ route('sinh-vien.filters') }}" method="GET">
                <div style="background-color: rgba(0,0,0,.03);" class="card-header">
                    <h5 class="card-title">Bộ lọc</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="" class="form-inline">
                                <div class="form-group">
                                    <input class="form-control form-control-sm" name="key"
                                        placeholder="Nhập họ tên / mã sinh viên" autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <select id="khoa_hoc_id" class="form-control form-control-sm" name="khoa_hoc_id" id="gioi_tinh">
                                <option value="" selected="" disabled="">--- Chọn khóa ---</option>
                                @foreach ($khoahocs as $khoahoc)
                                    <option value="{{ $khoahoc->id }}">{{ $khoahoc->ma_khoa_hoc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select id="lop_hoc_id" class="form-control form-control-sm" name="lop_hoc_id" id="gioi_tinh">
                                <option value="" selected="" disabled="">--- Chọn lớp học ---</option>
                                @foreach ($lophocs as $lophoc)
                                    <option value="{{ $lophoc->id }}">{{ $lophoc->ma_lop }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select id="nganh_hoc_id" class="form-control form-control-sm" name="nganh_hoc_id"
                                id="gioi_tinh">
                                <option value="" selected="" disabled="">--- Chọn ngành ---</option>
                                @foreach ($nganhhocs as $nganhhoc)
                                    <option value="{{ $nganhhoc->id }}">{{ $nganhhoc->ten_nganh }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary form-control-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div style="background-color: rgba(0,0,0,.03);" class="card-header">
            <h5 class="card-title">Danh sách sinh viên</h5>
            <form action="{{ route('sinh-vien.index') }}" method="GET">
                <select style="width: 58px;" name="banghi" style="width:68px;" class="form-control form-control-sm" onchange="this.form.submit()">
                    <option value="1">1</option>
                    <option selected value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </form>
            <div class="row float-right">
                <div class="col">
                    <a class="btn-export" href="{{ route('sinh-vien.export') }}">Xuất excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table style="text-align: center" class="table table-hover table-sm">
                <tr>
                    <th>#</th>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Khóa học</th>
                    <th>Lớp học</th>
                    <th>Ngành học</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th style="width: 156px;">Hành động</th>
                </tr>
                @foreach ($sinhviens as $key => $sinhvien)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $sinhvien->ma_sinh_vien }}</td>
                        {{-- <td><img style="height: 68px;" src="{{ url('uploads') }}/{{ $sinhvien->avatar }}"></td> --}}
                        <td>{{ $sinhvien->ho_ten }}</td>
                        <td>{{ $sinhvien->khoahocs->ma_khoa_hoc }}</td>
                        <td>{{ $sinhvien->lophocs->ma_lop }}</td>
                        <td>{{ $sinhvien->nganhhocs->ten_nganh }}</td>
                        <td>{{ $sinhvien->so_dien_thoai }}</td>
                        <td>{{ $sinhvien->taikhoans->email }}</td>
                        <td>
                            <a href="{{ route('sinh-vien.profile', ['id' => $sinhvien->id]) }}"
                                class="btn btn-sm btn-info">
                                <i style="color: white;" class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('sinh-vien.resetPassword', ['id' => $sinhvien->id]) }}"
                                class="btn btn-sm btn-warning">
                                <i style="color: white;" class="fas fa-key"></i>
                            </a>
                            <a href="{{ route('sinh-vien.edit', ['id' => $sinhvien->id]) }}"
                                class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('sinh-vien.destroy', ['id' => $sinhvien->id]) }}"
                                class="btn btn-sm btn-danger btndelete"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{ $sinhviens->appends(request()->input())->links() }}
@endsection

@section('css')
    <style>
        .btn-export {
            background-color: gray;
            border-color: #23923d;
            color: white;
            padding: 8px 4px;
            border-radius: 5px;
        }

        .btn-export:hover {
            color: white;
            background-color: rgb(148, 148, 148);
        }

    </style>
@endsection
