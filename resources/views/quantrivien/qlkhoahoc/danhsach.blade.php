@extends('layouts.site')

@section('main')
    <div class="col">
        <form action="" class="form-inline">
            <div class="form-group">
                <input class="form-control" name="key" placeholder="Nhập tên khóa học" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <hr>
    <table style="text-align: center" class="table table-hover table-sm">
        <tr>
            <th>STT</th>
            <th>Mã khóa học</th>
            <th>Mô tả</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
        @foreach ($khoahocs as $key => $khoahoc)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $khoahoc->ma_khoa_hoc }}</td>
                <td>
                    @if ($khoahoc->mo_ta === null)
                        <i>Chưa có thông tin</i>
                    @else
                        {{ $khoahoc->mo_ta }}
                    @endif
                </td>
                <td>{{ date('d/m/Y', strtotime($khoahoc->created_at)) }}</td>
                <td>
                    <a href="{{ route('khoa-hoc.edit', ['id' => $khoahoc->id]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('khoa-hoc.destroy', ['id' => $khoahoc->id]) }}"
                        class="btn btn-sm btn-danger btndelete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
