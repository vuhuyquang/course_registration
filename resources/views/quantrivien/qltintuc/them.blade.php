@extends('layouts.site')
@section('main')
    <form action="{{ route('tin-tuc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tieu_de">Tiêu đề <label style="color: red" for="tieu_de">*</label></label>
            <input id="tieu_de" type="text" class="form-control form-control-sm" name="tieu_de" placeholder="Nhập mã khoa"
                autocomplete="off" required autofocus>
            @error('tieu_de')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="noi_dung_ngan">Nội dung ngắn <label style="color: red" for="noi_dung_ngan">*</label></label>
           <textarea required name="noi_dung_ngan" id="noi_dung_ngan" cols="30" rows="4" class="form-control form-control-sm"></textarea>
            @error('noi_dung_ngan')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="hinh_anh">Hình ảnh <label style="color: red" for="hinh_anh">*</label></label>
            <input id="hinh_anh" type="text" class="form-control form-control-sm" name="hinh_anh" placeholder="Nhập mã khoa"
                autocomplete="off" required>
            @error('hinh_anh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="duong_dan">Đường dẫn <label style="color: red" for="duong_dan">*</label></label>
           <textarea name="duong_dan" id="duong_dan" cols="30" rows="2" class="form-control form-control-sm" required></textarea>
            @error('duong_dan')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ngay_dang">Ngày đăng <label style="color: red" for="ngay_dang">*</label></label>
            <input id="ngay_dang" type="date" class="form-control form-control-sm" name="ngay_dang"
                placeholder="Nhập ngày sinh" autocomplete="off" required>
            @error('ngay_dang')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
