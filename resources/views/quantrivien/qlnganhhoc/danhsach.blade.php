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
<div class="heading">DANH SÁCH CHUYÊN NGÀNH</div>
{{-- <div class="container">
@if (session('thongbao'))
<div class="alert alert-success">
    <span aria-hidden="true">{{ session('thongbao') }}</span>
</div>
@endif
</div> --}}
<a href="{{ route('nganh-hoc.create') }}" class="js-add btn-them">Thêm mới</a>
<table>
    <tr>
        <th>STT</th>
        <th>Mã ngành</th>
        <th>Tên ngành</th>
        <th>Danh sách lớp</th>
        <th>Danh sách môn học</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach ($nganhhocs as $key => $nganhhoc)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $nganhhoc->ma_nganh }}</td>
            <td>{{ $nganhhoc->ten_nganh }}</td>
            <td><a href=""><img class="img-icon" src="{{ asset('images/detail.png') }}" alt="Sửa"></a></td>
            <td><a href=""><img class="img-icon" src="{{ asset('images/detail.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('nganh-hoc.edit', ['id' => $nganhhoc->id]) }}"><img class="img-icon" src="{{ asset('images/edit.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('nganh-hoc.destroy', ['id' => $nganhhoc->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><img class="img-icon"
                        src="{{ asset('images/delete.png') }}" alt="Xóa"></a></td>
        </tr>
    @endforeach
</table>
