@extends('layouts.site')

@section('main')
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
<hr>
<table style="text-align: center" class="table table-hover table-sm">
    <tr>
        <tr>
            <th>STT</th>
            <th>Mã môn học</th>
            <th>Tên môn học</th>
            <th>Số tín chỉ</th>
            <th>Ngành học</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </tr>
    @foreach ($monhocs as $key => $monhoc)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $monhoc->ma_mon_hoc }}</td>
            <td>{{ $monhoc->ten_mon_hoc }}</td>
            <td>{{ $monhoc->so_tin_chi }}</td>
            <td>{{ $monhoc->nganhhocs->ten_nganh }}</td>
            <td>
                @if ($monhoc->duoc_phep == 1)
                    <span class="badge badge-success">V</span>
                @else
                    <span class="badge badge-danger">X</span>
                @endif
            </td>
            <td>{{ date('d/m/Y', strtotime($monhoc->created_at)) }}</td>
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
@endsection

