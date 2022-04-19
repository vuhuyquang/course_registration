@extends('layouts.site')
@section('main')
    <form action="{{ route('nganh-hoc.update', ['id' => $nganhhoc->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_nganh">Mã ngành <label style="color: red" for="ma_nganh">*</label></label>
            <input type="text" class="form-control form-control-sm" id="ma_nganh" name="ma_nganh" value="{{ $nganhhoc->ma_nganh }}" placeholder="Nhập mã ngành" autocomplete="off"
                required>
            @error('ma_nganh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ten_nganh">Tên ngành <label style="color: red" for="ten_nganh">*</label></label>
            <input type="text" class="form-control form-control-sm" id="ten_nganh" name="ten_nganh" value="{{ $nganhhoc->ten_nganh }}" placeholder="Nhập tên ngành" autocomplete="off" required>
            @error('ten_nganh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="khoa_id">Tên khoa <label style="color: red" for="khoa_id">*</label></label>
            <select id="khoa_id" class="form-control form-control-sm" name="khoa_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                @foreach ($khoas as $khoa)
                    <option {{ $nganhhoc->khoa_id == $khoa->id ? 'selected' : '' }} value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                @endforeach
            </select>
            @error('khoa_id')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
