@extends('layouts.site')
@section('main')
    <form action="{{ route('khoa.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_khoa">Mã khoa <label style="color: red" for="ma_khoa">*</label></label>
            <input id="ma_khoa" type="text" class="form-control" name="ma_khoa" placeholder="Nhập mã khoa"
                autocomplete="off" required autofocus>
            @error('ma_khoa')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ten_khoa">Tên khoa <label style="color: red" for="ten_khoa">*</label></label>
            <input id="ten_khoa" type="text" class="form-control" name="ten_khoa" placeholder="Nhập tên khoa" autocomplete="off"
                required>
            @error('ten_khoa')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
