<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style_back.css') }}">
@include('layouts.header')
<div class="heading">THÊM MỚI CHUYÊN NGÀNH</div>
<div class="container mt-5">
    @if (session('thongbao'))
        <div class="alert alert-success">
            <span aria-hidden="true">{{ session('thongbao') }}</span>
        </div>
    @endif
    <span>
        <a class="btn-a" href="{{ route('nganh-hoc.index') }}"><img style="height: 20px;" src="{{ asset('images/left-arrow.png') }}" alt="Quay lại"> Quay lại</a>
    </span>
    <div class="card">
        <div class="card-heading">THÊM MỚI CHUYÊN NGÀNH</div>
        <div class="card-body">
            <form action="{{ route('nganh-hoc.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="ma_nganh" class="form-label">Mã ngành <label style="color: red;"
                            for="ma_nganh">*</label></label>
                    <input type="text" class="form-control" id="ma_nganh" name="ma_nganh" placeholder="Nhập mã ngành"
                        required autocomplete="off">
                    @error('ma_nganh')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ten_nganh" class="form-label">Tên ngành <label style="color: red;"
                            for="ten_nganh">*</label></label>
                    <input type="text" class="form-control" id="ten_nganh" name="ten_nganh" placeholder="Nhập tên ngành"
                        required autocomplete="off">
                    @error('ten_nganh')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="khoa_id" class="form-label">Khoa <label style="color: red;"
                            for="khoa_id">*</label></label>
                    <select class="form-control" name="khoa_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                        @foreach ($khoas as $khoa)
                            <option value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                        @endforeach
                    </select>
                    @error('khoa_id')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
