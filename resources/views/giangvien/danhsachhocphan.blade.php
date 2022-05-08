@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách học phần giảng dạy</h5>
        <div class="row float-right">
            <div class="col">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Nhập mã học phần" autocomplete="off">
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
                <th>Mã lớp</th>
                <th>Mã HP</th>
                <th>Môn học</th>
                <th>STC</th>
                <th>Thời gian</th>
                <th>Địa điểm</th>
                <th>Hiện tại</th>
                <th>Mã học kỳ</th>
                <th style="width: 40px;">Hành động</th>
            </tr>
            @if (!empty($hocphans))
            @foreach ($hocphans as $key => $hocphan)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $hocphan->ma_lop }}</td>
                    <td>{{ $hocphan->ma_hoc_phan }}</td>
                    <td>{{ $hocphan->monhocs->ten_mon_hoc }}</td>
                    <td>{{ $hocphan->so_tin_chi }}</td>
                    <td>
                        @if (empty($hocphan->thoi_gian))
                            <i>N/A</i>
                        @else
                            {{ $hocphan->thoi_gian }}
                        @endif
                    </td>
                    <td>
                        @if (empty($hocphan->dia_diem))
                            <i>N/A</i>
                        @else
                            {{ $hocphan->dia_diem }}
                        @endif
                    </td>
                    <td>
                        @if ($hocphan->ma_hoc_ky == $hkht)
                            <span class="badge badge-success">V</span>
                        @else
                            <span class="badge badge-danger">X</span>
                        @endif
                    </td>
                    <td>{{ $hocphan->ma_hoc_ky }}</td>
                    <td>
                        <a href="{{ route('giangvien.mark', ['id' => $hocphan->id]) }}" class="btn btn-sm btn-warning">
                            <i style="color: white;" class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            @endif
        </table>
    </div>
</div>
@if (!empty($hocphans))
{{ $hocphans->links() }}
@endif
@endsection
