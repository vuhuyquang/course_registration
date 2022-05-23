@extends('layouts.site')

@section('main')
    <div class="card">
        <div style="background-color: rgba(0,0,0,.03);" class="card-header">
            <h5 class="card-title">Danh sách giảng viên giảng dạy</h5>
        </div>
        <div class="card-body">
            <table style="text-align: center" class="table table-hover table-sm">
                <tr>
                    <th>#</th>
                    <th>Mã giảng viên</th>
                    <th>Họ tên</th>
                    <th>Trình độ</th>
                    <th>Ngành</th>
                    <th style="width: 156px;">Lớp giảng dạy</th>
                </tr>
                @foreach ($arr as $key => $giangvien)
                <tr>
                    <th>{{ $key+1 }}</th>
                    <td>{{ $giangvien['ma_giang_vien'] }}</td>
                    <td>{{ $giangvien['ho_ten'] }}</td>
                    <td>{{ $giangvien['trinh_do'] }}</td>
                    <td>
                        @if (!empty($nganhhocs))
                        @foreach ($nganhhocs as $nganhhoc)
                            @if ($nganhhoc->id == $giangvien['nganh_hoc_id'])
                                {{ $nganhhoc->ten_nganh }}
                            @endif
                        @endforeach
                        @else
                            <i>Chưa có thông tin</i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('teacherListID', ['id' => $giangvien['id']]) }}"
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
