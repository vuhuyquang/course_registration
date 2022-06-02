@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Điểm tổng kết</h5>
    </div>
    <div class="card-body">
        <table class="table-hover table-sm">
            <tr>
                <td>Mã sinh viên: {{ Auth::user()->sinhviens->ma_sinh_vien }}</td>
                <td>Họ tên: {{ Auth::user()->sinhviens->ho_ten }}</td>
            </tr>
            <tr>
                <td>Điểm tổng kết: {{ $dtb }}</td>
                <td>GPA: {{ $gpa }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách môn học</h5>
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
                <th>Lần học</th>
                <th>Lần thi</th>
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
                        <td>{{ $diemso->lan_hoc }}</td>
                        <td>{{ $diemso->lan_thi }}</td>
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
