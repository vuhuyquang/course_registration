@extends('layouts.site')
@section('main')
    <form action="{{ route('hoc-ky.store') }}" method="POST">
        @csrf
        <div class="alert alert-warning">
            <p>Mã học kỳ được đặt theo quy tắc [năm học_kỳ học]. (VD: 2021_2022_2)</p>
        </div>
        <div class="form-group">
            <label for="ma_hoc_ky">Mã học kỳ <label style="color: red" for="ma_hoc_ky">*</label></label>
            <input id="ma_hoc_ky" type="text" class="form-control" name="ma_hoc_ky" placeholder="Nhập mã học kỳ"
                autocomplete="off" required autofocus>
            @error('ma_hoc_ky')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="mo_ta">Mô tả <label style="color: red" for="mo_ta">*</label></label>
            <input id="mo_ta" type="text" class="form-control" name="mo_ta" placeholder="Nhập mô tả" autocomplete="off"
                required>
            @error('mo_ta')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
