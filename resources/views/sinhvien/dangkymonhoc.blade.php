@extends('layouts.site')

@section('main')
    <div class="col">
        <form action="{{ route('sinhvien.register') }}" class="form-inline" method="POST">
            @csrf
            <div class="form-group">
                <input class="form-control" name="ma_hoc_phan" placeholder="Nhập mã học phần" autocomplete="off">
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
            <th>Giảng viên</th>
            <th>Thời gian đăng ký</th>
        </tr>
        </tr>
        @if (isset($svdks))
            @foreach ($svdks as $key => $svdk)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $svdk->hocphans->ma_hoc_phan }}</td>
                    <td>{{ $svdk->monhocs->ten_mon_hoc }}</td>
                    <td>
                        @if ($svdk->giang_vien_id != null)
                            {{ $svdk->giangviens->ho_ten }}
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>{{ $svdk->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection
