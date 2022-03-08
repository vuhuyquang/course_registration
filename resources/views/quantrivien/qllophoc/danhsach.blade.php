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
<div class="heading">DANH SÁCH LỚP HỌC</div>
{{-- <div class="container">
@if (session('thongbao'))
<div class="alert alert-success">
    <span aria-hidden="true">{{ session('thongbao') }}</span>
</div>
@endif
</div> --}}
<a href="{{ route('lop-hoc.create') }}" class="js-add btn-them">Thêm mới</a>
<table>
    <tr>
        <th>STT</th>
        <th>Mã lớp</th>
        <th>Khoa</th>
        <th>Khóa học</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach ($lophocs as $key => $lophoc)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $lophoc->ma_lop }}</td>
            <td>{{ $lophoc->khoas->ten_khoa }}</td>
            <td>{{ $lophoc->khoahocs->ma_khoa_hoc }}</td>
            <td><a href="{{ route('lop-hoc.edit', ['id' => $lophoc->id]) }}"><img class="img-icon" src="{{ asset('images/edit.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('lop-hoc.destroy', ['id' => $lophoc->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><img class="img-icon"
                        src="{{ asset('images/delete.png') }}" alt="Xóa"></a></td>
        </tr>
    @endforeach
</table>
