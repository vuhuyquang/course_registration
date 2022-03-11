<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<style>
    .img-icon {
        height: 22px;
        width: 18px;
    }

    .alert-success {
		color: #0f5132;
		background-color: #d1e7dd;
		border-color: #badbcc;
	}
	.alert {
		position: relative;
		padding: 1rem 1rem;
		margin-bottom: 1rem;
		border: 1px solid transparent;
		border-radius: 0.25rem;
	}
</style>
@include('layouts.header')
<div class="heading">DANH SÁCH SINH VIÊN</div>
{{-- <div class="container">
@if (session('thongbao'))
<div class="alert alert-success">
    <span aria-hidden="true">{{ session('thongbao') }}</span>
</div>
@endif
</div> --}}
<a href="{{ route('sinh-vien.create') }}" class="js-add btn-them">Thêm mới</a>
<table>
    <tr>
        <th>STT</th>
        <th>Mã sinh viên</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Khóa học</th>
        <th>Lớp học</th>
        <th>Quê quán</th>
        <th>Email</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach ($sinhviens as $key => $sinhvien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $sinhvien->ma_sinh_vien }}</td>
            <td>{{ $sinhvien->ho_ten }}</td>
            <td>{{ $sinhvien->ngay_sinh }}</td>
            <td>{{ $sinhvien->gioi_tinh }}</td>
            <td>{{ $sinhvien->khoahocs->ma_khoa_hoc }}</td>
            <td>{{ $sinhvien->lophocs->ma_lop }}</td>
            <td>{{ $sinhvien->que_quan }}</td>
            <td>{{ $sinhvien->email }}</td>
            <td><a href="{{ route('sinh-vien.edit', ['id' => $sinhvien->id]) }}"><img class="img-icon" src="{{ asset('images/edit.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('sinh-vien.destroy', ['id' => $sinhvien->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><img class="img-icon"
                        src="{{ asset('images/delete.png') }}" alt="Xóa"></a></td>
        </tr>
    @endforeach
</table>
