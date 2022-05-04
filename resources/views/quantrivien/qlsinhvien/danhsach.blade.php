@extends('layouts.site')

@section('main')
    <div class="row">
    <div class="col">
        <form action="" class="form-inline">
            <div class="form-group">
                <input class="form-control" name="key" placeholder="Nhập tên sinh viên" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <div class="col">
        <a class="btn-export" href="{{ route('sinh-vien.export') }}">Xuất excel</a>
    </div>
</div>
    <hr>
    <table style="text-align: center" class="table table-hover table-sm">
        <tr>
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Ảnh</th>
            <th>Họ tên</th>
            <th>Khóa học</th>
            <th>Lớp học</th>
            <th>Ngành học</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
        @foreach ($sinhviens as $key => $sinhvien)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $sinhvien->ma_sinh_vien }}</td>
                <td><img style="height: 78px;" src="{{ url('uploads') }}/{{ $sinhvien->avatar }}"></td>
                <td>{{ $sinhvien->ho_ten }}</td>
                <td>{{ $sinhvien->khoahocs->ma_khoa_hoc }}</td>
                <td>{{ $sinhvien->lophocs->ma_lop }}</td>
                <td>{{ $sinhvien->nganhhocs->ten_nganh }}</td>
                <td>{{ $sinhvien->taikhoans->email }}</td>
                <td>
                    <a href="{{ route('sinh-vien.profile', ['id' => $sinhvien->id]) }}" class="btn btn-sm btn-info">
                        <i style="color: white;" class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('sinh-vien.resetPassword', ['id' => $sinhvien->id]) }}" class="btn btn-sm btn-warning">
                        <i style="color: white;" class="fas fa-key"></i>
                    </a>
                    <a href="{{ route('sinh-vien.edit', ['id' => $sinhvien->id]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('sinh-vien.destroy', ['id' => $sinhvien->id]) }}"
                        class="btn btn-sm btn-danger btndelete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
{{ $sinhviens->links() }}
@endsection

@section('css')
    <style>
        .btn-export {
            background-color: gray;
            border-color: #23923d;
            color: white;
            padding: 8px 4px;
            border-radius: 5px;
            float: right;
        }

        .btn-export:hover {
            color: white;
            background-color: rgb(148, 148, 148);
        }
    </style>
@endsection
