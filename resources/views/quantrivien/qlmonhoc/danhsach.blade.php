@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách môn học</h5>
        <div class="row float-right">
            <div class="col">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Nhập tên môn học" autocomplete="off">
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
                <tr>
                    <th>#</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>STC</th>
                    <th>Ngành học</th>
                    <th>Học kỳ</th>
                    <th>Trạng thái</th>
                    {{-- <th style="width: 120px;">Ngày tạo</th> --}}
                    <th style="width: 120px;">Hành động</th>
                </tr>
            </tr>
            @foreach ($monhocs as $key => $monhoc)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $monhoc->ma_mon_hoc }}</td>
                    <td>{{ $monhoc->ten_mon_hoc }}</td>
                    <td>{{ $monhoc->so_tin_chi }}</td>
                    <td>
                        @if (!empty($monhoc->nganhhocs->ten_nganh))
                            {{ $monhoc->nganhhocs->ten_nganh }}
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>{{ $monhoc->hoc_ky }}</td>
                    <td>
                        @if ($monhoc->duoc_phep == 1)
                            <span class="badge badge-success">V</span>
                        @else
                            <span class="badge badge-danger">X</span>
                        @endif
                    </td>
                    {{-- <td>{{ date('H:i:s d/m/Y', strtotime($monhoc->created_at)) }}</td> --}}
                    <td>
                        <a style="color: white;" href="{{ route('mon-hoc.block', ['id' => $monhoc->id]) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-ban"></i>
                        </a>
                        <a href="{{ route('mon-hoc.edit', ['id' => $monhoc->id]) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('mon-hoc.destroy', ['id' => $monhoc->id]) }}" class="btn btn-sm btn-danger btndelete"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
{{ $monhocs->appends(request()->only('key'))->links() }}
@endsection

