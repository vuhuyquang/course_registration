@extends('layouts.site')
@section('main')
    <div class="card">
        <div style="background-color: rgba(0,0,0,.03);" class="card-header">
            <h5 class="card-title">Thêm sinh viên nhập excel</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sinh-vien.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept=".xlsx" name="file" id="validatedCustomFile"
                                    required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">Nhập
                                file</button>
                            @error('file')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form action="{{ route('sinh-vien.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div style="background-color: rgba(0,0,0,.03);" class="card-header">
                <h5 class="card-title">Thêm sinh viên</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="ma_sinh_vien">Mã sinh viên <label style="color: red" for="ma_sinh_vien">*</label></label>
                    <input id="ma_sinh_vien" type="text" class="form-control form-control-sm" name="ma_sinh_vien"
                        placeholder="Nhập mã sinh viên" autocomplete="off" required autofocus>
                    @error('ma_sinh_vien')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ho_ten">Họ tên <label style="color: red" for="ho_ten">*</label></label>
                    <input id="ho_ten" type="text" class="form-control form-control-sm" name="ho_ten"
                        placeholder="Nhập họ tên" autocomplete="off" required>
                    @error('ho_ten')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nganh_hoc_id">Ngành <label style="color: red" for="nganh_hoc_id">*</label></label>
                    <select id="nganh_hoc_id" class="form-control form-control-sm" name="nganh_hoc_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn ngành ---</option>
                        @foreach ($nganhhocs as $nganhhoc)
                            <option value="{{ $nganhhoc->id }}">{{ $nganhhoc->ten_nganh }}</option>
                        @endforeach
                    </select>
                    @error('nganh_hoc_id')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="khoa_hoc_id">Khóa <label style="color: red" for="khoa_hoc_id">*</label></label>
                    <select id="khoa_hoc_id" class="form-control form-control-sm" name="khoa_hoc_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn khóa ---</option>
                        @foreach ($khoahocs as $khoahoc)
                            <option value="{{ $khoahoc->id }}">{{ $khoahoc->ma_khoa_hoc }}</option>
                        @endforeach
                    </select>
                    @error('khoa_hoc_id')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lop_hoc_id">Lớp học <label style="color: red" for="lop_hoc_id">*</label></label>
                    <select id="lop_hoc_id" class="form-control form-control-sm" name="lop_hoc_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn lớp học ---</option>
                        @foreach ($lophocs as $lophoc)
                            <option value="{{ $lophoc->id }}">{{ $lophoc->ma_lop }}</option>
                        @endforeach
                    </select>
                    @error('lop_hoc_id')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email <label style="color: red" for="email">*</label></label>
                    <input id="email" type="email" class="form-control form-control-sm" name="email"
                        placeholder="Nhập tên khoa" autocomplete="off" required>
                    @error('email')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ngay_sinh">Ngày sinh <label style="color: red" for="ngay_sinh">*</label></label>
                    <input id="ngay_sinh" type="date" class="form-control form-control-sm" name="ngay_sinh"
                        placeholder="Nhập ngày sinh" autocomplete="off" required>
                    @error('ngay_sinh')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gioi_tinh">Giới tính <label style="color: red" for="gioi_tinh">*</label></label>
                    <select id="gioi_tinh" class="form-control form-control-sm" name="gioi_tinh" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn giới tính ---</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                    @error('gioi_tinh')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="que_quan">Quê quán <label style="color: red" for="que_quan">*</label></label>
                    <input id="que_quan" type="text" class="form-control form-control-sm" name="que_quan"
                        placeholder="Nhập quê quán" autocomplete="off" required>
                    @error('que_quan')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="so_dien_thoai">Số điện thoại <label style="color: red" for="so_dien_thoai">*</label></label>
                    <input id="so_dien_thoai" type="text" class="form-control form-control-sm" name="so_dien_thoai"
                        placeholder="Nhập số điện thoại" autocomplete="off" required>
                    @error('so_dien_thoai')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="avatar">Ảnh đại diện</label>
                    <input id="avatar" type="file" class="form-control form-control-sm" name="avatar"
                        placeholder="Nhập ảnh đại diện" autocomplete="off">
                    @error('avatar')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </form>
@stop()
