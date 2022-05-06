@extends('layouts.site')
@section('main')
    <form action="{{ route('hoc-phan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_lop">Mã lớp <label style="color: red" for="ma_lop">*</label></label>
            <input id="ma_lop" type="text" class="form-control form-control-sm" name="ma_lop" placeholder="Nhập mã học phần"
                autocomplete="off" required autofocus>
            @error('ma_lop')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ma_hoc_phan">Mã học phần <label style="color: red" for="ma_hoc_phan">*</label></label>
            <input id="ma_hoc_phan" type="text" class="form-control form-control-sm" name="ma_hoc_phan" placeholder="Nhập mã học phần"
                autocomplete="off" required autofocus>
            @error('ma_hoc_phan')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="mon_hoc_id">Môn học <label style="color: red" for="mon_hoc_id">*</label></label>
            <select id="mon_hoc_id" class="form-control form-control-sm" name="mon_hoc_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn môn học ---</option>
                @foreach ($monhocs as $monhoc)
                    <option value="{{ $monhoc->id }}">{{ $monhoc->ten_mon_hoc }} / {{ $monhoc->nganhhocs->ten_nganh }}</option>
                @endforeach
            </select>
            @error('mon_hoc_id')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="so_tin_chi">Số tín chỉ <label style="color: red" for="so_tin_chi">*</label></label>
            <input id="so_tin_chi" type="number" class="form-control form-control-sm" name="so_tin_chi" placeholder="Nhập mã học phần"
                autocomplete="off" required autofocus>
            @error('so_tin_chi')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="thoi_gian">Thời gian <label style="color: red" for="thoi_gian">*</label></label>
            <input id="thoi_gian" type="text" class="form-control form-control-sm" name="thoi_gian" placeholder="Nhập mã học phần"
                autocomplete="off" required autofocus>
            @error('thoi_gian')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="dia_diem">Địa điểm <label style="color: red" for="dia_diem">*</label></label>
            <input id="dia_diem" type="text" class="form-control form-control-sm" name="dia_diem" placeholder="Nhập mã học phần"
                autocomplete="off" required autofocus>
            @error('dia_diem')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="giang_vien_id">Giảng viên <label style="color: red" for="giang_vien_id">*</label></label>
            <select id="giang_vien_id" class="form-control form-control-sm" name="giang_vien_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn môn học ---</option>
                @foreach ($giangviens as $giangvien)
                    <option value="{{ $giangvien->id }}">{{ $giangvien->ho_ten }} / {{ $giangvien->nganhhocs->ten_nganh }}</option>
                @endforeach
            </select>
            @error('giang_vien_id')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="ma_hoc_ky">Học kỳ <label style="color: red" for="ma_hoc_ky">*</label></label>
            <select id="ma_hoc_ky" class="form-control form-control-sm" name="ma_hoc_ky" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn môn học ---</option>
                @foreach ($hockys as $hocky)
                    <option value="{{ $hocky->ma_hoc_ky }}">{{ $hocky->ma_hoc_ky }}</option>
                @endforeach
            </select>
            @error('ma_hoc_ky')
                <span class="form-text">{{ $message }}.</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
