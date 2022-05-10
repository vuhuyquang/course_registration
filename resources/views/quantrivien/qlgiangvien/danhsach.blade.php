@extends('layouts.site')

@section('main')
<div class="card">
    <div style="background-color: rgba(0,0,0,.03);" class="card-header">
        <h5 class="card-title">Danh sách nhân viên</h5>
        <div class="row">
            <div class="col">
                <a class="btn-export" href="{{ route('giang-vien.export') }}">Xuất excel</a>
            </div>
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
        </div>
    </div>
    <div class="card-body">
        <table style="text-align: center" class="table table-hover table-sm">
            <tr>
                <th>#</th>
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
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $giangvien->ma_giang_vien }}</td>
                    <td>{{ $giangvien->ho_ten }}</td>
                    <td>{{ $giangvien->nganhhocs->ten_nganh }}</td>
                    <td>{{ $giangvien->trinh_do }}</td>
                    <td>{{ $giangvien->taikhoans->email }}</td>
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
    </div>
</div>
{{ $giangviens->appends(request()->only('key'))->links() }}
@endsection

@section('css')
    <style>
        .btn-export {
            background-color: gray;
            border-color: #23923d;
            color: white;
            padding: 8px 4px;
            border-radius: 5px;
        }

        .btn-export:hover {
            color: white;
            background-color: rgb(148, 148, 148);
        }

    </style>
@endsection
