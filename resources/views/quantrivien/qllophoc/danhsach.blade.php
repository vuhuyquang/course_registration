@extends('layouts.site')

@section('main')
    <div class="card">
        <div class="card-header" style="background-color: rgba(0,0,0,.03);">
            <h5 class="card-title">Danh sách lớp học</h5>
            <div class="row float-right">
                <div class="col">
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="form-control" name="key" placeholder="Nhập mã lớp học" autocomplete="off">
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
                    <th>Tên ngành</th>
                    <th>Khóa học</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($lophocs as $key => $lophoc)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $lophoc->ma_lop }}</td>
                        <td>{{ $lophoc->nganhhocs->ten_nganh }}</td>
                        <td>{{ $lophoc->khoahocs->ma_khoa_hoc }}</td>
                        <td>{{ date('H:i:s d/m/Y', strtotime($lophoc->created_at)) }}</td>
                        <td>
                            <a href="{{ route('lop-hoc.edit', ['id' => $lophoc->id]) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('lop-hoc.destroy', ['id' => $lophoc->id]) }}"
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
    {{ $lophocs->links() }}
@endsection
