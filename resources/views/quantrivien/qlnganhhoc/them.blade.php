@extends('layouts.site')
@section('main')
    <form action="{{ route('nganh-hoc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_nganh">Mã ngành <label style="color: red" for="ma_nganh">*</label></label>
            <input id="ma_nganh" type="text" class="form-control" name="ma_nganh" placeholder="Nhập mã ngành" autocomplete="off"
                required autofocus>
            @error('ma_nganh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ten_nganh">Tên ngành <label style="color: red" for="ten_nganh">*</label></label>
            <input id="ten_nganh" type="text" class="form-control" name="ten_nganh" placeholder="Nhập tên ngành" autocomplete="off" required>
            @error('ten_nganh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="khoa_id">Tên ngành <label style="color: red" for="khoa_id">*</label></label>
            <select id="khoa_id" class="form-control" name="khoa_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                @foreach ($khoas as $khoa)
                    <option value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                @endforeach
            </select>
            @error('khoa_id')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
