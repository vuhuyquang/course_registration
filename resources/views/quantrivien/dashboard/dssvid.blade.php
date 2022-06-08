@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách lớp học</h5>
    </div>
    <div class="card-body">
        <table style="text-align: center" class="table table-hover table-sm">
            <tr>
                <th>#</th>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Mã lớp</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Thời gian ĐK</th>
                <th>Thời gian hủy ĐK</th>
            </tr>
            @foreach ($svdks as $key => $svdk)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $svdk->sinhviens->ma_sinh_vien }}</td>
                    <td>{{ $svdk->sinhviens->ho_ten }}</td>
                    <td>{{ $svdk->hocphans->ma_lop }}</td>
                    <td>{{ $svdk->hocphans->ma_hoc_phan }}</td>
                    <td>{{ $svdk->monhocs->ten_mon_hoc }}</td>
                    <td>{{ date('H:i:s d/m/Y', strtotime($svdk->created_at)) }}</td>
                    <td>
                        @if (empty($svdk->deleted_at))
                            <i>N/A</i>
                        @else
                        {{ date('H:i:s d/m/Y', strtotime($svdk->deleted_at)) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
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
