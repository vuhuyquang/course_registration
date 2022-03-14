<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style_back.css') }}">
@include('layouts.header')
<div class="heading">THÊM MỚI SINH VIÊN</div>
<div class="container mt-5">
    @if (session('thongbao'))
    <div class="alert alert-success">
        <span aria-hidden="true">{{ session('thongbao') }}</span>
    </div>
    @endif
    <span>
        <a class="btn-a" href="{{ route('sinh-vien.index') }}"><img style="height: 20px;" src="{{ asset('images/left-arrow.png') }}" alt="Quay lại"> Quay lại</a>
    </span>
    <div class="card">
        <div class="card-heading">THÊM MỚI SINH VIÊN</div>
        <div class="card-body">
            <form action="{{ route('sinh-vien.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Mật khẩu của tài khoản là ngày/tháng/năm sinh của sinh viên. (VD: 01/01/2021)</label>
                </div>
                <div class="mb-3">
                    <label for="ma_sinh_vien" class="form-label">Mã sinh viên <label style="color: red;"
                            for="ma_sinh_vien">*</label></label>
                    <input type="text" class="form-control" id="ma_sinh_vien" name="ma_sinh_vien" placeholder="Nhập mã sinh viên"
                        required autocomplete="off">
                    @error('ma_sinh_vien')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ho_ten" class="form-label">Họ tên <label style="color: red;"
                            for="ho_ten">*</label></label>
                    <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nhập họ tên"
                        required autocomplete="off">
                    @error('ho_ten')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="khoa_id" class="form-label">Khoa <label style="color: red;"
                            for="khoa_id">*</label></label>
                    <select class="form-control" name="khoa_id" id="khoa_id">
                        <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                        @foreach ($khoas as $khoa)
                            <option value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                        @endforeach
                    </select>
                    @error('khoa_id')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ngay_sinh" class="form-label">Ngày sinh <label style="color: red;"
                        for="gioi_tinh">*</label></label>
                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                        required autocomplete="off">
                    @error('ngay_sinh')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gioi_tinh" class="form-label">Giới tính <label style="color: red;"
                            for="gioi_tinh">*</label></label>
                    <select class="form-control" name="gioi_tinh" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn giới tính ---</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                    </select>
                    @error('gioi_tinh')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="que_quan" class="form-label">Quê quán <label style="color: red;"
                        for="gioi_tinh">*</label></label>
                    <input type="text" class="form-control" id="que_quan" name="que_quan" placeholder="Nhập quê quán"
                        required autocomplete="off">
                    @error('que_quan')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <label style="color: red;"
                        for="gioi_tinh">*</label></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                        required autocomplete="off">
                    @error('email')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
