@extends('layouts.site')
@section('main')
    <form action="{{ route('giang-vien.update', ['id' => $giangvien->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="ma_giang_vien">Mã giảng viên <label style="color: red" for="ma_giang_vien">*</label></label>
            <input id="ma_giang_vien" type="text" class="form-control" name="ma_giang_vien" value="{{ $giangvien->ma_giang_vien }}" placeholder="Nhập mã sinh viên"
                autocomplete="off" required autofocus>
            @error('ma_giang_vien')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ho_ten">Họ tên <label style="color: red" for="ho_ten">*</label></label>
            <input id="ho_ten" type="text" class="form-control" name="ho_ten" value="{{ $giangvien->ho_ten }}" placeholder="Nhập họ tên" autocomplete="off"
                required>
            @error('ho_ten')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="trinh_do">Trình độ <label style="color: red" for="trinh_do">*</label></label>
            <select id="trinh_do" class="form-control" name="trinh_do">
                <option value="" selected="" disabled="">--- Chọn trình độ ---</option>
                    <option {{ $giangvien->trinh_do == 'Tú tài' ? 'selected' : '' }} value="Tú tài">Tú tài</option>
                    <option {{ $giangvien->trinh_do == 'Cử nhân' ? 'selected' : '' }} value="Cử nhân">Cử nhân</option>
                    <option {{ $giangvien->trinh_do == 'Kỹ sư' ? 'selected' : '' }} value="Kỹ sư">Kỹ sư</option>
                    <option {{ $giangvien->trinh_do == 'Thạc sĩ' ? 'selected' : '' }} value="Thạc sĩ">Thạc sĩ</option>
                    <option {{ $giangvien->trinh_do == 'Tiến sĩ' ? 'selected' : '' }} value="Tiến sĩ">Tiến sĩ</option>
                    <option {{ $giangvien->trinh_do == 'Giáo sư' ? 'selected' : '' }} value="Giáo sư">Giáo sư</option>
            </select>
            @error('trinh_do')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nganh_hoc_id">Ngành <label style="color: red" for="nganh_hoc_id">*</label></label>
            <select id="nganh_hoc_id" class="form-control" name="nganh_hoc_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn ngành ---</option>
                @foreach ($nganhhocs as $nganhhoc)
                    <option {{ $giangvien->nganh_hoc_id == $nganhhoc->id ? 'selected' : '' }} value="{{ $nganhhoc->id }}">{{ $nganhhoc->ten_nganh }}</option>
                @endforeach
            </select>
            @error('nganh_hoc_id')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email <label style="color: red" for="email">*</label></label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $giangvien->email }}" placeholder="Nhập tên khoa" autocomplete="off"
                required>
            @error('email')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ngay_sinh">Ngày sinh <label style="color: red" for="ngay_sinh">*</label></label>
            <input id="ngay_sinh" type="date" class="form-control" name="ngay_sinh" value="{{ $giangvien->ngay_sinh }}" placeholder="Nhập ngày sinh" autocomplete="off"
                required>
            @error('ngay_sinh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="gioi_tinh">Giới tính <label style="color: red" for="gioi_tinh">*</label></label>
            <select id="gioi_tinh" class="form-control" name="gioi_tinh" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn giới tính ---</option>
                <option {{ $giangvien->gioi_tinh == 'Nam' ? 'selected' : '' }} value="Nam">Nam</option>
                <option {{ $giangvien->gioi_tinh == 'Nữ' ? 'selected' : '' }} value="Nữ">Nữ</option>
                <option {{ $giangvien->gioi_tinh == 'Khác' ? 'selected' : '' }} value="Khác">Khác</option>
            </select>
            @error('gioi_tinh')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="que_quan">Quê quán <label style="color: red" for="que_quan">*</label></label>
            <input id="que_quan" type="text" class="form-control" name="que_quan" value="{{ $giangvien->que_quan }}" placeholder="Nhập quê quán" autocomplete="off"
                required>
            @error('que_quan')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="so_dien_thoai">Số điện thoại <label style="color: red" for="so_dien_thoai">*</label></label>
            <input id="so_dien_thoai" type="text" class="form-control" name="so_dien_thoai" value="{{ $giangvien->so_dien_thoai }}" placeholder="Nhập số điện thoại" autocomplete="off"
                required>
            @error('so_dien_thoai')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh đại diện <label style="color: red" for="avatar">*</label></label>
            <input id="avatar" type="file" class="form-control" name="avatar" placeholder="Nhập ảnh đại diện" autocomplete="off"
                required>
            @error('avatar')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
