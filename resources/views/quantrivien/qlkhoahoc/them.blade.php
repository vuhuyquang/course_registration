<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
@include('layouts.header')
<div class="heading">THÊM MỚI KHÓA HỌC</div>
<div class="container mt-5">
    @if (session('thongbao'))
    <div class="alert alert-success">
        <span aria-hidden="true">{{ session('thongbao') }}</span>
    </div>
    @endif
    <div class="card">
        <div class="card-heading">THÊM MỚI KHÓA HỌC</div>
        <div class="card-body">
            <form action="{{ route('khoa-hoc.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="ma_khoa_hoc" class="form-label">Mã khóa học <label style="color: red;"
                            for="ma_khoa_hoc">*</label></label>
                    <input type="text" class="form-control" id="ma_khoa_hoc" name="ma_khoa_hoc" placeholder="Nhập mã khóa học"
                        required autocomplete="off">
                    @error('ma_khoa_hoc')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mo_ta" class="form-label">Mô tả</label>
                    <input type="text" class="form-control" id="mo_ta" name="mo_ta" placeholder="Nhập mô tả"
                        required autocomplete="off">
                    @error('mo_ta')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
