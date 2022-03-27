@extends('layouts.site')
@section('main')
    <form action="{{ route('khoa-hoc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_khoa_hoc">Mã khóa học <label style="color: red" for="ma_khoa_hoc">*</label></label>
            <input id="ma_khoa_hoc" type="text" class="form-control" name="ma_khoa_hoc" placeholder="Nhập mã khóa học" autocomplete="off"
                required autofocus>
            @error('ma_khoa_hoc')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="mo_ta">Mô tả</label>
            <input id="mo_ta" type="text" class="form-control" name="mo_ta" placeholder="Nhập mô tả" autocomplete="off">
            @error('mo_ta')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
