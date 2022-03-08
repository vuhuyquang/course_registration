<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
@include('layouts.header')
<div class="heading">THÊM MỚI KHOA</div>
<div class="container mt-5">
    @if (session('thongbao'))
    <div class="alert alert-success">
        <span aria-hidden="true">{{ session('thongbao') }}</span>
    </div>
    @endif
    <div class="card">
        <div class="card-heading">THÊM MỚI KHOA</div>
        <div class="card-body">
            <form action="{{ route('khoa.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="ma_khoa" class="form-label">Mã khoa <label style="color: red;"
                            for="ma_khoa">*</label></label>
                    <input type="text" class="form-control" id="ma_khoa" name="ma_khoa" placeholder="Nhập mã khoa"
                        required autocomplete="off">
                    @error('ma_khoa')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ten_khoa" class="form-label">Tên khoa <label style="color: red;"
                            for="ten_khoa">*</label></label>
                    <input type="text" class="form-control" id="ten_khoa" name="ten_khoa" placeholder="Nhập tên khoa"
                        required autocomplete="off">
                    @error('ten_khoa')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
