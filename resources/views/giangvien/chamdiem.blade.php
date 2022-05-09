@extends('layouts.site')

@section('main')
    <div class="card">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    {{ $error }}
                </div>
            @endforeach
        @endif
    </div>
    <div class="card">
        <div class="card-header" style="background-color: rgba(0,0,0,.03);">
            <h5 class="card-title">Tổng kết điểm</h5>
        </div>
        <div class="card-body">
            <table style="text-align: center" class="table table-hover table-sm">
                <tr>
                    <th>#</th>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Chuyên cần</th>
                    <th>Giữa kỳ</th>
                    <th>Cuối kỳ</th>
                    <th style="width: 100px;">Hành động</th>
                </tr>
                @foreach ($svdks as $key => $svdk)
                    <tr>
                        <form action="{{ route('giangvien.markStore') }}" method="POST">
                            @csrf
                            <th>{{ $key + 1 }}</th>
                            <td><input type="text" value="{{ $svdk->sinhviens->ma_sinh_vien }}" readonly></td>
                            <td><input type="text" value="{{ $svdk->sinhviens->ho_ten }}" readonly></td>
                            <td><input type="text" name="chuyen_can"></td>
                            <td><input type="text" name="giua_ky"></td>
                            <td><input type="text" name="cuoi_ky"></td>
                            <input type="hidden" name="mon_hoc_id" value="{{ $svdk->mon_hoc_id }}">
                            <input type="hidden" name="sinh_vien_id" value="{{ $svdk->sinh_vien_id }}">
                            <td>
                                <button class="btn btn-sm btn-primary"><i style="color: white;"
                                        class="fas fa-plus-circle"></i></button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
