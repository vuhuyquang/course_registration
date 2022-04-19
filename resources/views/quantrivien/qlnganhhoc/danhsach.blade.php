@extends('layouts.site')

@section('main')
    <div class="col">
        <form action="" class="form-inline">
            <div class="form-group">
                <input class="form-control" name="key" placeholder="Nhập tên ngành" autocomplete="off">
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
            <th>Mã ngành</th>
            <th>Tên ngành</th>
            <th>Khoa</th>
            <th>Thời gian tạo</th>
            <th>Hành động</th>
        </tr>
        @foreach ($nganhhocs as $key => $nganhhoc)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $nganhhoc->ma_nganh }}</td>
                <td>{{ $nganhhoc->ten_nganh }}</td>
                <td>{{ $nganhhoc->khoas->ten_khoa }}</td>
                <td>{{ date('d/m/Y', strtotime($nganhhoc->created_at)) }}</td>
                <td>
                    <a href="{{ route('nganh-hoc.edit', ['id' => $nganhhoc->id]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('nganh-hoc.destroy', ['id' => $nganhhoc->id]) }}"
                        class="btn btn-sm btn-danger btndelete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
