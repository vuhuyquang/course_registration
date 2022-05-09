@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách học phần đăng ký</h5>
        <div class="row float-right">
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
        </div>
    </div>
    <div class="card-body">
        <table style="text-align: center" class="table table-hover table-sm">
            <tr>
            <tr>
                <th>#</th>
                <th>Mã học phần</th>
                <th>Môn học</th>
                <th>Thời gian</th>
                <th>Địa điểm</th>
                <th>Giảng viên</th>
                <th>Học kỳ</th>
                <th>Hiện tại</th>
                <th>Hủy</th>
            </tr>
            </tr>
            @if (!empty($svdks))
                @foreach ($svdks as $key => $svdk)
                    <tr>
                        <th>{{ $key + 1 }}</th>
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
                            @if (empty($svdk->giangviens->ho_ten))
                                <i>Chưa có thông tin</i>
                            @else
                                {{ $svdk->giangviens->ho_ten }}
                            @endif
                        </td>
                        <td>{{ $svdk->ma_hoc_ky }}</td>
                        <td>
                            @if (!empty($hkht) && $svdk->ma_hoc_ky == $hkht)
                                <span class="badge badge-success">V</span>
                            @else
                                <span class="badge badge-danger">X</span>
                            @endif
                        </td>
                        <td>
                            @if (!empty($hkht) && $svdk->ma_hoc_ky == $hkht)
                            <a href="{{ route('sinhvien.cancelRegister', ['id' => $svdk->id]) }}" class="btn btn-sm btn-danger btndelete"
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đăng ký?')">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
@if (!empty($svdks))
{{ $svdks->links() }}
@endif
@endsection
