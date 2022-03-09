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
<div class="heading">DANH SÁCH HỌC KỲ</div>
{{-- <div class="container">
@if (session('thongbao'))
<div class="alert alert-success">
    <span aria-hidden="true">{{ session('thongbao') }}</span>
</div>
@endif
</div> --}}
<a href="{{ route('hoc-ky.create') }}" class="js-add btn-them">Thêm mới</a>
<a href="{{ route('hoc-ky.setstatus') }}" class="js-add btn-them">Xét trạng thái</a>
<table>
    <tr>
        <th>STT</th>
        <th>Mã học kỳ</th>
        <th>Mô tả</th>
        <th>Trạng thái</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach ($hockys as $key => $hocky)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $hocky->ma_hoc_ky }}</td>
            <td>{{ $hocky->mo_ta }}</td>
            <td>{{ $hocky->trang_thai }}</td>
            <td><a href="{{ route('hoc-ky.edit', ['id' => $hocky->id]) }}"><img class="img-icon" src="{{ asset('images/edit.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('hoc-ky.destroy', ['id' => $hocky->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><img class="img-icon"
                        src="{{ asset('images/delete.png') }}" alt="Xóa"></a></td>
        </tr>
    @endforeach
</table>
