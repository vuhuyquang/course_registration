@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách tin tức</h5>
    </div>
    <div class="card-body">
        <table style="text-align: center" class="table table-hover table-sm">
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Nội dung ngắn</th>
                <th>Hình ảnh</th>
                <th>Đường dẫn</th>
                <th>Ngày đăng</th>
                <th>Xóa</th>
            </tr>
            @foreach ($tintucs as $key => $tintuc)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $tintuc->tieu_de }}</td>
                    <td>{{ $tintuc->noi_dung_ngan }}</td>
                    <td><img height="200px" src="{{ $tintuc->hinh_anh }}" alt=""></td>
                    <td>{{ $tintuc->duong_dan }}</td>
                    <td>{{ date('d/m/Y', strtotime($tintuc->ngay_dang)) }}</td>
                    <td>
                        <a href="{{ route('tin-tuc.destroy', ['id' => $tintuc->id]) }}" class="btn btn-sm btn-danger btndelete"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
{{ $tintucs->appends(request()->only('key'))->links() }}
@endsection
