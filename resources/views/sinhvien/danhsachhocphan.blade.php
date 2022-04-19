@extends('layouts.site')

@section('main')
<hr>
<table style="text-align: center" class="table table-hover table-sm">
    <tr>
        <tr>
            <th>STT</th>
            <th>Mã học phần</th>
            <th>Tên môn học</th>
            <th>Thời gian</th>
            <th>Địa điểm</th>
            <th>Giảng viên</th>
            <th>Đăng ký tối đa</th>
            <th>Đã đăng ký</th>
        </tr>
    </tr>
    @foreach ($hocphans as $key => $hocphan)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $hocphan->ma_hoc_phan }}</td>
            <td>{{ $hocphan->monhocs->ten_mon_hoc }}</td>
            <td>
                @if ($hocphan->thoi_gian == null)
                    <i>Chưa có thông tin</i>
                @else
                    {{ $hocphan->thoi_gian }}
                @endif
            </td>
            <td>
                @if ($hocphan->dia_diem == null)
                    <i>Chưa có thông tin</i>
                @else
                    {{ $hocphan->dia_diem }}
                @endif
            </td>
            <td>
                @if ($hocphan->giang_vien_id == null)
                    <i>Chưa có thông tin</i>
                @else
                    {{ $hocphan->giang_vien_id }}
                @endif
            </td>
            <td>{{ $hocphan->dk_toi_da }}</td>
            <td>
                @if ($hocphan->da_dang_ky == null)
                    <i>Chưa có thông tin</i>
                @else
                    {{ $hocphan->da_dang_ky }}
                @endif
            </td>
        </tr>
    @endforeach
</table>
@endsection