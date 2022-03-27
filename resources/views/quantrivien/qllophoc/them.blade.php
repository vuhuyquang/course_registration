@extends('layouts.site')
@section('main')
    <form action="{{ route('lop-hoc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_lop">Mã lớp học <label style="color: red" for="ma_lop">*</label></label>
            <input id="ma_lop" type="text" class="form-control" name="ma_lop" placeholder="Nhập mã khóa học" autocomplete="off"
                required autofocus>
            @error('ma_lop')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nganh_id">Ngành <label style="color: red" for="ma_lop_hoc">*</label></label>
            <select id="nganh_id" class="form-control" name="nganh_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                @foreach ($nganhhocs as $nganhhoc)
                    <option value="{{ $nganhhoc->id }}">{{ $nganhhoc->ten_nganh }}</option>
                @endforeach
            </select>
            @error('nganh_id')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="khoa_hoc_id">Khóa học <label style="color: red" for="ma_lop_hoc">*</label></label>
            <select id="khoa_hoc_id" class="form-control" name="khoa_hoc_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn khóa học ---</option>
                @foreach ($khoahocs as $khoahoc)
                    <option value="{{ $khoahoc->id }}">{{ $khoahoc->ma_khoa_hoc }}</option>
                @endforeach
            </select>
            @error('khoa_hoc_id')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
