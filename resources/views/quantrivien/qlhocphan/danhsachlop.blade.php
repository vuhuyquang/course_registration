@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách lớp học</h5>
        <div class="row float-right">
            <div class="col">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Nhập mã sinh viên" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table style="text-align: center" class="table table-hover table-sm">
            <tr>
                <th>#</th>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Quê quán</th>
                <th>Số điện thoại</th>
            </tr>
            @foreach ($svdks as $key => $svdk)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $svdk->sinhviens->ma_sinh_vien }}</td>
                    <td>{{ $svdk->sinhviens->ho_ten }}</td>
                    <td>{{ $svdk->sinhviens->ngay_sinh }}</td>
                    <td>{{ $svdk->sinhviens->gioi_tinh }}</td>
                    <td>{{ $svdk->sinhviens->que_quan }}</td>
                    <td>{{ $svdk->sinhviens->so_dien_thoai }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
