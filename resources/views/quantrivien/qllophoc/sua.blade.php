@extends('layouts.site')
@section('main')
    <form action="{{ route('lop-hoc.update', ['id' => $lophoc->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_lop">Mã lớp <label style="color: red" for="ma_lop">*</label></label>
            <input type="text" class="form-control" id="ma_lop" name="ma_lop" value="{{ $lophoc->ma_lop }}"
                placeholder="Nhập mã ngành" autocomplete="off" required>
            @error('ma_lop')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nganh_id">Ngành <label style="color: red" for="nganh_id">*</label></label>
            <select id="nganh_id" class="form-control" name="nganh_id">
                <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                @foreach ($nganhhocs as $nganhhoc)
                    <option {{ $lophoc->nganh_id == $nganhhoc->id ? 'selected' : '' }} value="{{ $nganhhoc->id }}">
                        {{ $nganhhoc->ten_nganh }}</option>
                @endforeach
            </select>
            @error('nganh_id')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="khoa_hoc_id">Khóa học <label style="color: red" for="khoa_hoc_id">*</label></label>
            <select id="khoa_hoc_id" class="form-control" name="khoa_hoc_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn khóa học ---</option>
                @foreach ($khoahocs as $khoahoc)
                    <option {{ $lophoc->khoa_hoc_id === $khoahoc->id ? 'selected' : '' }} value="{{ $khoahoc->id }}">
                        {{ $khoahoc->ma_khoa_hoc }}</option>
                @endforeach
            </select>
            @error('khoa_hoc_id')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
