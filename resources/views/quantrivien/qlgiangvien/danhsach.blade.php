@extends('layouts.site')

@section('main')
<div class="col">
    <form action="" class="form-inline">
        <div class="form-group">
            <input class="form-control" name="key" placeholder="Nhập tên giảng viên" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
<hr>
<table style="text-align: center" class="table table-hover">
    <tr>
        <th>STT</th>
        <th>Mã giảng viên</th>
        <th>Họ tên</th>
        <th>Ngành</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>
    @foreach ($giangviens as $key => $giangvien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $giangvien->ma_giang_vien }}</td>
            <td>{{ $giangvien->ho_ten }}</td>
            <td>{{ $giangvien->nganhhocs->ten_nganh }}</td>
            <td>{{ date('d/m/Y H:i:s', strtotime($giangvien->created_at)) }}</td>
            <td>
                <a href="{{ route('giang-vien.edit', ['id' => $giangvien->id]) }}" class="btn btn-sm btn-warning">
                    <i style="color: white;" class="fas fa-eye"></i>
                </a>
                <a href="{{ route('giang-vien.edit', ['id' => $giangvien->id]) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('giang-vien.destroy', ['id' => $giangvien->id]) }}" class="btn btn-sm btn-danger btndelete"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@endsection
