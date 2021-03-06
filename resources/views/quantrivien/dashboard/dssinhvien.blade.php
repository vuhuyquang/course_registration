@extends('layouts.site')

@section('main')
    <div class="card">
        <div style="background-color: rgba(0,0,0,.03);" class="card-header">
            <h5 class="card-title">Danh sách sinh viên đăng ký</h5>
        </div>
        <div class="card-body">
            <table style="text-align: center" class="table table-hover table-sm">
                <tr>
                    <th>#</th>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Khóa học</th>
                    <th>Lớp học</th>
                    <th>Ngành học</th>
                    <th style="width: 156px;">Hành động</th>
                </tr>
                @foreach ($arr as $key => $sinhvien)
                <tr>
                    <th>{{ $key+1 }}</th>
                    <td>{{ $sinhvien['ma_sinh_vien'] }}</td>
                    <td>{{ $sinhvien['ho_ten'] }}</td>
                    <td>
                        @if (!empty($khoahocs))
                        @foreach ($khoahocs as $khoahoc)
                            @if ($khoahoc->id == $sinhvien['khoa_hoc_id'])
                                {{ $khoahoc->ma_khoa_hoc }}
                            @endif
                        @endforeach
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>
                        @if (!empty($lophocs))
                        @foreach ($lophocs as $lophoc)
                            @if ($lophoc->id == $sinhvien['lop_hoc_id'])
                                {{ $lophoc->ma_lop }}
                            @endif
                        @endforeach
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>
                        @if (!empty($nganhhocs))
                        @foreach ($nganhhocs as $nganhhoc)
                            @if ($nganhhoc->id == $sinhvien['nganh_hoc_id'])
                                {{ $nganhhoc->ten_nganh }}
                            @endif
                        @endforeach
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('studentListID', ['id' => $sinhvien['id']]) }}"
                            class="btn btn-sm btn-info">
                            <i style="color: white;" class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>    
                @endforeach
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
