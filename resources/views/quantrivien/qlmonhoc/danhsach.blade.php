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
<div class="heading">DANH SÁCH MÔN HỌC</div>
{{-- <div class="container">
@if (session('thongbao'))
<div class="alert alert-success">
    <span aria-hidden="true">{{ session('thongbao') }}</span>
</div>
@endif
</div> --}}
<a href="{{ route('mon-hoc.create') }}" class="js-add btn-them">Thêm mới</a>
<table>
    <tr>
        <th>STT</th>
        <th>Mã môn học</th>
        <th>Tên môn học</th>
        <th>Số tín chỉ</th>
        <th>Học phí</th>
        <th>Ngành học</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach ($monhocs as $key => $monhoc)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $monhoc->ma_mon_hoc }}</td>
            <td>{{ $monhoc->ten_mon_hoc }}</td>
            <td>{{ $monhoc->so_tin_chi }}</td>
            <td>{{ $monhoc->hoc_phi }}</td>
            <td>{{ $monhoc->nganhhocs->ten_nganh }}</td>
            <td><a href="{{ route('mon-hoc.edit', ['id' => $monhoc->id]) }}"><img class="img-icon" src="{{ asset('images/edit.png') }}" alt="Sửa"></a></td>
            <td><a href="{{ route('mon-hoc.destroy', ['id' => $monhoc->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><img class="img-icon"
                        src="{{ asset('images/delete.png') }}" alt="Xóa"></a></td>
        </tr>
    @endforeach
</table>
