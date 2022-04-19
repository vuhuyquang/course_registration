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
<table style="text-align: center" class="table table-hover table-sm">
    <tr>
        <th>STT</th>
        <th>Mã giảng viên</th>
        <th>Họ tên</th>
        <th>Ngành</th>
        <th>Trình độ</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Hành động</th>
    </tr>
    @foreach ($giangviens as $key => $giangvien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $giangvien->ma_giang_vien }}</td>
            <td>{{ $giangvien->ho_ten }}</td>
            <td>{{ $giangvien->nganhhocs->ten_nganh }}</td>
            <td>{{ $giangvien->trinh_do }}</td>
            <td>{{ $giangvien->email }}</td>
            <td>{{ $giangvien->so_dien_thoai }}</td>
            <td>
                <a href="{{ route('giang-vien.profile', ['id' => $giangvien->id]) }}" class="btn btn-sm btn-info">
                    <i style="color: white;" class="fas fa-eye"></i>
                </a>
                <a href="{{ route('giang-vien.resetPassword', ['id' => $giangvien->id]) }}" class="btn btn-sm btn-warning">
                    <i style="color: white;" class="fas fa-key"></i>
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
