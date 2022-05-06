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
                <th>Số tín chỉ</th>
                <th>Lớp học phần</th>
            </tr>
            </tr>
            @if (isset($monhocs))
                @foreach ($monhocs as $key => $monhoc)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $monhoc->ma_mon_hoc }}</td>
                        <td>{{ $monhoc->ten_mon_hoc }}</td>
                        <td>{{ $monhoc->so_tin_chi }}</td>
                        <td>
                            <a href="{{ route('sinhvien.lookup.id', ['id' => $monhoc->id]) }}" class="btn btn-sm btn-warning">
                                <i style="color: white;" class="fas fa-ellipsis-h"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
{{ $monhocs->links() }}
@endsection
