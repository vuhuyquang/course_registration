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
<div class="heading">DANH SÁCH GIẢNG VIÊN</div>
{{-- <div class="container">
@if (session('thongbao'))
<div class="alert alert-success">
    <span aria-hidden="true">{{ session('thongbao') }}</span>
</div>
@endif
</div> --}}
<a href="{{ route('giang-vien.create') }}" class="js-add btn-them">Thêm mới</a>
<table>
    <tr>
        <th>STT</th>
        <th>Mã giảng viên</th>
        <th>Họ tên</th>
        <th>Đơn vị</th>
        <th>Xem chi tiết</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach ($giangviens as $key => $giangvien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $giangvien->ma_giang_vien }}</td>
            <td>{{ $giangvien->ho_ten }}</td>
            <td>{{ $giangvien->khoas->ten_khoa }}</td>
            <td><a href=""><img class="img-icon" src="{{ asset('images/detail.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('giang-vien.edit', ['id' => $giangvien->id]) }}"><img class="img-icon" src="{{ asset('images/edit.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('giang-vien.destroy', ['id' => $giangvien->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><img class="img-icon"
                        src="{{ asset('images/delete.png') }}" alt="Xóa"></a></td>
        </tr>
    @endforeach
</table>
