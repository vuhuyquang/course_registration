<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
@include('layouts.header')
<div class="heading">CẬP NHẬT THÔNG TIN LỚP HỌC</div>
<div class="container mt-5">
    @if (session('thongbao'))
    <div class="alert alert-success">
        <span aria-hidden="true">{{ session('thongbao') }}</span>
    </div>
    @endif
    <div class="card">
        <div class="card-heading">CẬP NHẬT THÔNG TIN LỚP HỌC</div>
        <div class="card-body">
            <form action="{{ route('lop-hoc.update', ['id' => $lophoc->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="ma_lop" class="form-label">Mã khoa <label style="color: red;"
                            for="ma_lop">*</label></label>
                    <input type="text" class="form-control" id="ma_lop" value="{{ $lophoc->ma_lop }}" name="ma_lop" placeholder="Nhập mã khoa"
                        required autocomplete="off">
                    @error('ma_lop')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="khoa_id" class="form-label">Khoa <label style="color: red;"
                            for="khoa_id">*</label></label>
                    <select class="form-control" name="khoa_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                        @foreach ($khoas as $khoa)
                            <option {{ $lophoc->khoa_id === $khoa->id ? 'selected' : '' }} value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                        @endforeach
                    </select>
                    @error('khoa_id')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="khoa_hoc_id" class="form-label">Khóa học <label style="color: red;"
                            for="khoa_hoc_id">*</label></label>
                    <select class="form-control" name="khoa_hoc_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn khóa học ---</option>
                        @foreach ($khoahocs as $khoahoc)
                            <option {{ $lophoc->khoa_hoc_id === $khoahoc->id ? 'selected' : '' }} value="{{ $khoahoc->id }}">{{ $khoahoc->ma_khoa_hoc }}</option>
                        @endforeach
                    </select>
                    @error('khoa_hoc_id')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
