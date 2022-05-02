@extends('layouts.site')

@section('main')
    <div class="col">
        <form action="{{ route('sinhvien.register') }}" class="form-inline" method="POST">
            @csrf
            <div class="form-group">
                <input class="form-control" name="ma_lop" placeholder="Nhập mã lớp" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
            </button>
        </form>
    </div>
    <hr>
    <table style="text-align: center" class="table table-hover table-sm">
        <tr>
        <tr>
            <th>STT</th>
            <th>Mã học phần</th>
            <th>Môn học</th>
            <th>Thời gian</th>
            <th>Địa điểm</th>
            <th>Giảng viên</th>
        </tr>
        </tr>
        @if (isset($svdks))
            @foreach ($svdks as $key => $svdk)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $svdk->hocphans->ma_hoc_phan }}</td>
                    <td>{{ $svdk->monhocs->ten_mon_hoc }}</td>
                    <td>
                        @if ($svdk->hocphans->thoi_gian != null)
                            {{ $svdk->hocphans->thoi_gian }}
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>
                        @if ($svdk->hocphans->dia_diem != null)
                            {{ $svdk->hocphans->dia_diem }}
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>
                        {{-- @if ($svdk->giangviens->ho_ten != null)
                            {{ $svdk->giangviens->ho_ten }}
                        @else
                            <i>Chưa có thông tin</i>
                        @endif --}}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection
