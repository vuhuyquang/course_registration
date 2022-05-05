@extends('layouts.site')

@section('main')
    <div class="card">
        <div class="card-header" style="background-color: rgba(0,0,0,.03);">
            <h5 class="card-title">Danh sách niên khóa</h5>
            <div class="row float-right">
                <div class="col">
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="form-control" name="key" placeholder="Nhập mã niên khóa" autocomplete="off">
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
                    <th>Mã khóa học</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($khoahocs as $key => $khoahoc)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $khoahoc->ma_khoa_hoc }}</td>
                        <td>
                            @if ($khoahoc->mo_ta === null)
                                <i>Chưa có thông tin</i>
                            @else
                                {{ $khoahoc->mo_ta }}
                            @endif
                        </td>
                        <td>{{ date('H:i:s d/m/Y', strtotime($khoahoc->created_at)) }}</td>
                        <td>
                            <a href="{{ route('khoa-hoc.edit', ['id' => $khoahoc->id]) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('khoa-hoc.destroy', ['id' => $khoahoc->id]) }}"
                                class="btn btn-sm btn-danger btndelete"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{ $khoahocs->links() }}
@endsection
