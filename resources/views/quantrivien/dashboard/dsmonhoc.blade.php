@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Danh sách môn học đăng ký</h5>
    </div>
    <div class="card-body">
        <table style="text-align: center" class="table table-hover table-sm">
            <tr>
                <tr>
                    <th>#</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Số tín chỉ</th>
                    <th>Ngành học</th>
                </tr>
            </tr>
            @foreach ($arr as $key => $monhoc)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $monhoc['ma_mon_hoc'] }}</td>
                    <td>{{ $monhoc['ten_mon_hoc'] }}</td>
                    <td>{{ $monhoc['so_tin_chi'] }}</td>
                    <td>
                        @foreach ($nganhhocs as $nganhhoc)
                            @if ($nganhhoc->id == $monhoc['nganh_id'])
                                {{ $nganhhoc->ten_nganh }}
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

