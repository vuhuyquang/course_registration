@extends('layouts.site')
@section('main')
    <form action="{{ route('khoa-hoc.update', ['id' => $khoahoc->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_khoa_hoc">Mã khóa học <label style="color: red" for="ma_khoa_hoc">*</label></label>
            <input type="text" class="form-control" id="ma_khoa_hoc" name="ma_khoa_hoc" value="{{ $khoahoc->ma_khoa_hoc }}" placeholder="Nhập mã ngành" autocomplete="off"
                required>
            @error('ma_khoa_hoc')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="mo_ta">Mô tả</label>
            <input type="text" class="form-control" id="mo_ta" name="mo_ta" value="{{ $khoahoc->mo_ta }}" placeholder="Nhập tên ngành" autocomplete="off">
            @error('mo_ta')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
