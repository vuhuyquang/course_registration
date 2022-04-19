@extends('layouts.site')

@section('main')
<div class="col">
    <form action="" class="form-inline">
        <div class="form-group">
            <input class="form-control" name="key" placeholder="Nhập tên lớp học" autocomplete="off">
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
        <th>Mã lớp</th>
        <th>Tên ngành</th>
        <th>Khóa học</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>
    @foreach ($lophocs as $key => $lophoc)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $lophoc->ma_lop }}</td>
            <td>{{ $lophoc->nganhhocs->ten_nganh }}</td>
            <td>{{ $lophoc->khoahocs->ma_khoa_hoc }}</td>
            <td>{{ date('d/m/Y', strtotime($lophoc->created_at)) }}</td>
            <td>
                <a href="{{ route('lop-hoc.edit', ['id' => $lophoc->id]) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('lop-hoc.destroy', ['id' => $lophoc->id]) }}" class="btn btn-sm btn-danger btndelete"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@endsection

