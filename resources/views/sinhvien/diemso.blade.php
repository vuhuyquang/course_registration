@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách môn học</h5>
        <div class="row float-right">
            <div class="col">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Nhập tên môn học" autocomplete="off">
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
            <tr>
                <th>#</th>
                <th>Mã học phần</th>
                <th>Tên học phần</th>
                <th>STC</th>
                <th>Giảng viên</th>
                <th>Đánh giá</th>
                <th>Chuyên cần</th>
                <th>Giữa kỳ</th>
                <th>Cuối kỳ</th>
                <th>Tổng kết</th>
                <th>Điểm chữ</th>
            </tr>
            </tr>
            @if (isset($diemsos))
                @foreach ($diemsos as $key => $diemso)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $diemso->monhocs->ma_mon_hoc }}</td>
                        <td>{{ $diemso->monhocs->ten_mon_hoc }}</td>
                        <td>{{ $diemso->monhocs->so_tin_chi }}</td>
                        <td>{{ $diemso->giangviens->ho_ten }}</td>
                        <td>{{ $diemso->danh_gia }}</td>
                        <td>{{ $diemso->chuyen_can }}</td>
                        <td>{{ $diemso->giua_ky }}</td>
                        <td>{{ $diemso->cuoi_ky }}</td>
                        <td>{{ $diemso->diem_tong_ket }}</td>
                        <td>{{ $diemso->diem_chu }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
@endsection
