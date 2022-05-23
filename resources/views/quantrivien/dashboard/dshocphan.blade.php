@extends('layouts.site')

@section('main')
    <div class="card">
        <div class="card-header" style="background-color: rgba(0,0,0,.03);">
            <h5 class="card-title">Danh sách học phần</h5>
            <div class="col">
                <a class="btn-export" href="{{ route('hoc-phan.export') }}">Xuất excel</a>
            </div>
        </div>
        <div class="card-body">
            <table style="text-align: center" class="table table-hover table-sm">
                <tr>
                    <th>#</th>
                    <th>Mã lớp</th>
                    <th>Mã HP</th>
                    <th>Môn học</th>
                    <th>STC</th>
                    <th>Thời gian</th>
                    <th>Địa điểm</th>
                    <th>Giảng viên</th>
                    <th>Tối đa</th>
                    <th>Đã ĐK</th>
                    <th>Mã học kỳ</th>
                </tr>
                @if (!empty($arr))
                    @foreach ($arr as $key => $hocphan)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $hocphan['ma_lop'] }}</td>
                            <td>{{ $hocphan['ma_hoc_phan'] }}</td>
                            <td>
                                @foreach ($monhocs as $monhoc)
                                    @if ($monhoc->id == $hocphan['mon_hoc_id'])
                                        {{ $monhoc->ten_mon_hoc }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $hocphan['so_tin_chi'] }}</td>
                            <td>
                                @if (empty($hocphan['thoi_gian']))
                                    <i>N/A</i>
                                @else
                                    {{ $hocphan['thoi_gian'] }}
                                @endif
                            </td>
                            <td>
                                @if (empty($hocphan['dia_diem']))
                                    <i>N/A</i>
                                @else
                                    {{ $hocphan['dia_diem'] }}
                                @endif
                            </td>
                            <td>
                                {{-- @if (!empty($giangviens))
                                    @foreach ($giangviens as $giangvien)
                                        @if ($giangvien->id = $hocphan['giang_vien_id'])
                                            {{ $giangvien->ho_ten }}
                                        @elseif (empty($hocphan['giang_vien_id']))
                                            <i>Chưa có thông tin</i>
                                        @endif
                                    @endforeach
                                @elseif (empty($hocphan['giang_vien_id']))
                                    <i>Chưa có thông tin</i>
                                @else
                                    <i>Chưa có thông tin</i>  
                                @endif --}}
                                @if (empty($hocphan->giangviens->ho_ten))
                                    <i>N/A</i>
                                @else
                                    {{ $hocphan->giangviens->ho_ten }}
                                @endif
                            </td>
                            <td>{{ $hocphan['dk_toi_da'] }}</td>
                            <td>{{ $hocphan['da_dang_ky'] }}</td>
                            <td>{{ $hocphan['ma_hoc_ky'] }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .btn-export {
            background-color: gray;
            border-color: #23923d;
            color: white;
            padding: 8px 4px;
            border-radius: 5px;
        }

        .btn-export:hover {
            color: white;
            background-color: rgb(148, 148, 148);
        }

    </style>
@endsection