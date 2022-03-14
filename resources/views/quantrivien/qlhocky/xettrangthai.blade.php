<link rel="stylesheet" href="{{ asset('assets/css/style_khoa.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style_khoa_them.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style_back.css') }}">
@include('layouts.header')
<div class="heading">XÉT TRẠNG THÁI HỌC KỲ</div>
<div class="container mt-5">
    @if (session('thongbao'))
    <div class="alert alert-success">
        <span aria-hidden="true">{{ session('thongbao') }}</span>
    </div>
    @endif
    <span>
        <a class="btn-a" href="{{ route('hoc-ky.index') }}"><img style="height: 20px;" src="{{ asset('images/left-arrow.png') }}" alt="Quay lại"> Quay lại</a>
    </span>
    <div class="card">
        <div class="card-heading">XÉT TRẠNG THÁI HỌC KỲ</div>
        <div class="card-body">
            <form action="{{ route('hoc-ky.storesetstatus') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id" class="form-label">Học kỳ <label style="color: red;"
                            for="id">*</label></label>
                            <select class="form-control" name="id" id="gioi_tinh">
                                <option value="" selected="" disabled="">--- Chọn học kỳ ---</option>
                                @foreach ($hockys as $hocky)
                                    <option value="{{ $hocky->id }}">{{ $hocky->ma_hoc_ky }}</option>
                                @endforeach
                            </select>
                    @error('id')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng thái <label style="color: red;"
                        for="id">*</label></label>
                    <select class="form-control" name="trang_thai" id="gioi_tinh">
                        <option value="" selected="" disabled="">--- Chọn trạng thái ---</option>
                            <option value="Mở đăng ký">Mở đăng ký</option>
                            <option value="Đóng đăng ký">Đóng đăng ký</option>
                    </select>
                    @error('trang_thai')
                        <span class="form-text">{{ $message }}.</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
