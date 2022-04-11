@extends('layouts.site')
@section('main')
    <form action="{{ route('hoc-ky.update', ['id' => $hocky->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_hoc_ky">Mã học kỳ <label style="color: red" for="ma_hoc_ky">*</label></label>
            <input type="text" class="form-control" id="ma_hoc_ky" name="ma_hoc_ky" value="{{ $hocky->ma_hoc_ky }}" placeholder="Nhập mã khoa" autocomplete="off"
                required>
            @error('ma_hoc_ky')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="mo_ta">Mô tả <label style="color: red" for="mo_ta">*</label></label>
            <input type="text" class="form-control" id="mo_ta" name="mo_ta" value="{{ $hocky->mo_ta }}" placeholder="Nhập tên khoa" autocomplete="off" required>
            @error('mo_ta')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
