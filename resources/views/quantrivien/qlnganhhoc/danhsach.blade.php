@extends('layouts.site')

@section('main')
    <div class="card">
        <div class="card-header" style="background-color: rgba(0,0,0,.03);">
            <h5 class="card-title">Danh sách ngành học</h5>
            <div class="row float-right">
                <div class="col">
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="form-control" name="key" placeholder="Nhập tên ngành" autocomplete="off">
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
                    <th>Mã ngành</th>
                    <th>Tên ngành</th>
                    <th>Khoa</th>
                    <th>Thời gian tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($nganhhocs as $key => $nganhhoc)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>
                            @if (!empty($nganhhoc->ma_nganh))
                                {{ $nganhhoc->ma_nganh }}
                            @else
                                <i>Chưa có thông tin</i>
                            @endif
                        </td>
                        <td>{{ $nganhhoc->ten_nganh }}</td>
                        <td>
                            @if (!empty($nganhhoc->khoas->ten_khoa))
                                {{ $nganhhoc->khoas->ten_khoa }}
                            @else
                                <i>Chưa có thông tin</i>
                            @endif
                        </td>
                        <td>{{ date('H:i:s d/m/Y', strtotime($nganhhoc->created_at)) }}</td>
                        <td>
                            <a href="{{ route('nganh-hoc.edit', ['id' => $nganhhoc->id]) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('nganh-hoc.destroy', ['id' => $nganhhoc->id]) }}"
                                class="btn btn-sm btn-danger btndelete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{ $nganhhocs->appends(request()->only('key'))->links() }}
@endsection
