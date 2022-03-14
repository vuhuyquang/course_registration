<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style_back.css') }}">
@include('layouts.header')
<div class="heading">CẬP NHẬT THÔNG TIN MÔN HỌC</div>
<div class="container mt-5">
    @if (session('thongbao'))
    <div class="alert alert-success">
        <span aria-hidden="true">{{ session('thongbao') }}</span>
    </div>
    @endif
    <span>
        <a class="btn-a" href="{{ route('mon-hoc.index') }}"><img style="height: 20px;" src="{{ asset('images/left-arrow.png') }}" alt="Quay lại"> Quay lại</a>
    </span>
    <div class="card">
        <div class="card-heading">CẬP NHẬT THÔNG TIN MÔN HỌC</div>
        <div class="card-body">
            <form action="{{ route('mon-hoc.update', ['id' => $monhoc->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="ma_mon_hoc" class="form-label">Mã môn học <label style="color: red;"
                            for="ma_mon_hoc">*</label></label>
                    <input type="text" class="form-control" id="ma_mon_hoc" name="ma_mon_hoc" value="{{ $monhoc->ma_mon_hoc }}" placeholder="Nhập mã môn học"
                        required autocomplete="off">
                    @error('ma_mon_hoc')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ten_mon_hoc" class="form-label">Tên môn học <label style="color: red;"
                            for="ten_mon_hoc">*</label></label>
                    <input type="text" class="form-control" id="ten_mon_hoc" name="ten_mon_hoc" value="{{ $monhoc->ten_mon_hoc }}" placeholder="Nhập tên môn học"
                        required autocomplete="off">
                    @error('ten_mon_hoc')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="so_tin_chi" class="form-label">Số tín chỉ <label style="color: red;"
                            for="so_tin_chi">*</label></label>
                    <input type="number" class="form-control" id="so_tin_chi" name="so_tin_chi" value="{{ $monhoc->so_tin_chi }}" placeholder="Nhập số tín chỉ"
                        required autocomplete="off">
                    @error('so_tin_chi')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hoc_phi" class="form-label">Học phí <label style="color: red;"
                            for="hoc_phi">*</label></label>
                    <input type="number" class="form-control" id="hoc_phi" name="hoc_phi" value="{{ $monhoc->hoc_phi }}" placeholder="Nhập số tín chỉ"
                        required autocomplete="off">
                    @error('hoc_phi')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="khoa_id" class="form-label">Khoa <label style="color: red;"
                            for="khoa_id">*</label></label>
                    <select class="form-control" name="khoa_id" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn khoa ---</option>
                        @foreach ($khoas as $khoa)
                            <option {{ $monhoc->khoa_id === $khoa->id ? 'selected' : '' }} value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                        @endforeach
                    </select>
                    @error('khoa_id')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
