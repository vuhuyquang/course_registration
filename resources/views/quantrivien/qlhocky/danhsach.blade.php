@extends('layouts.site')

@section('main')
    <div class="card">
        <div class="card-header" style="background-color: rgba(0,0,0,.03);">
            <h5 class="card-title">Danh sách học kỳ</h5>
            <div class="row float-right">
                <div class="col">
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="form-control" name="key" placeholder="Nhập mã học kỳ" autocomplete="off">
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
                    <th>Mã học kỳ</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($hockys as $key => $hocky)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $hocky->ma_hoc_ky }}</td>
                        <td>{{ $hocky->mo_ta }}</td>
                        <td>
                            @if ($hocky->trang_thai == 'Mở')
                                <span class="badge badge-success">Mở</span>
                            @else
                                <span class="badge badge-danger">Đóng</span>
                            @endif
                        </td>
                        <td>{{ date('H:i:s d/m/Y', strtotime($hocky->created_at)) }}</td>
                        <td>
                            <a href="{{ route('hoc-ky.setStatus', ['id' => $hocky->id]) }}"
                                class="btn btn-sm btn-warning">
                                <i style="color: white;" class="fas fa-power-off"></i>
                            </a>
                            <a href="{{ route('hoc-ky.edit', ['id' => $hocky->id]) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('hoc-ky.destroy', ['id' => $hocky->id]) }}"
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
    {{ $hockys->links() }}
@endsection
