@extends('layouts.site')

@section('main')
<div class="col">
    <form action="" class="form-inline">
        <div class="form-group">
            <input class="form-control" name="key" placeholder="Nhập tên khoa" autocomplete="off">
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
        <th>Mã khoa</th>
        <th>Tên khoa</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>
    @foreach ($khoas as $key => $khoa)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $khoa->ma_khoa }}</td>
            <td>{{ $khoa->ten_khoa }}</td>
            <td>{{ date('d/m/Y', strtotime($khoa->created_at)) }}</td>
            <td>
                <a href="{{ route('khoa.edit', ['id' => $khoa->id]) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('khoa.destroy', ['id' => $khoa->id]) }}" class="btn btn-sm btn-danger btndelete"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@endsection
