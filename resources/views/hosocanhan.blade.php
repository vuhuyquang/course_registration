@extends('layouts.site')
@section('main')

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Hồ sơ cá nhân</div>
                        @if (Auth::user()->quyen == 1)
                            <div class="card-body">
                                <form action="{{ route('postProfile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="ma_sinh_vien" class="col-md-4 col-form-label text-md-right">Mã sinh
                                            viên</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->ma_sinh_vien }}" id="ma_sinh_vien"
                                                class="form-control form-control-sm" name="ma_sinh_vien" required autofocus
                                                readonly class="form-control-plaintext form-control-sm">
                                            @error('ma_sinh_vien')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="ho_ten" class="col-md-4 col-form-label text-md-right">Họ tên</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->ho_ten }}" id="ho_ten"
                                                class="form-control form-control-sm" name="ho_ten" required autofocus
                                                readonly class="form-control-plaintext form-control-sm">
                                            @error('ho_ten')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="khoa_hoc_id" class="col-md-4 col-form-label text-md-right">Niên
                                            khóa</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->khoahocs->ma_khoa_hoc }}"
                                                id="khoa_hoc_id" class="form-control form-control-sm" name="khoa_hoc_id"
                                                required autofocus readonly class="form-control-plaintext form-control-sm">
                                            @error('khoa_hoc_id')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lop_hoc_id" class="col-md-4 col-form-label text-md-right">Lớp
                                            học</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->lophocs->ma_lop }}" id="lop_hoc_id"
                                                class="form-control form-control-sm" name="lop_hoc_id" required autofocus
                                                readonly class="form-control-plaintext form-control-sm">
                                            @error('lop_hoc_id')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nganh_hoc_id" class="col-md-4 col-form-label text-md-right">Ngành
                                            học</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->nganhhocs->ma_nganh }}"
                                                id="nganh_hoc_id" class="form-control form-control-sm" name="nganh_hoc_id"
                                                required autofocus readonly class="form-control-plaintext form-control-sm">
                                            @error('nganh_hoc_id')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ Auth::user()->email }}" id="email"
                                                class="form-control form-control-sm" name="email" required autofocus
                                                readonly>
                                            @error('email')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="ngay_sinh" class="col-md-4 col-form-label text-md-right">Ngày
                                            sinh</label>
                                        <div class="col-md-6">
                                            <input type="date" value="{{ $sinhvien->ngay_sinh }}" id="ngay_sinh"
                                                class="form-control form-control-sm" name="ngay_sinh" required>
                                            @error('ngay_sinh')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gioi_tinh" class="col-md-4 col-form-label text-md-right">Giới
                                            tính</label>
                                        <div class="col-md-6">
                                            <select class="form-control form-control-sm" name="gioi_tinh">
                                                <option {{ $sinhvien->gioi_tinh == 'Nam' ? 'selected' : '' }}
                                                    value="Nam">
                                                    Nam
                                                </option>
                                                <option {{ $sinhvien->gioi_tinh == 'Nữ' ? 'selected' : '' }} value="Nữ">
                                                    Nữ
                                                </option>
                                                <option {{ $sinhvien->gioi_tinh == 'Khác' ? 'selected' : '' }}
                                                    value="Khác">
                                                    Khác
                                                </option>
                                            </select>
                                            @error('gioi_tinh')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="que_quan" class="col-md-4 col-form-label text-md-right">Quê
                                            quán</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->que_quan }}" id="que_quan"
                                                class="form-control form-control-sm" name="que_quan" required>
                                            @error('que_quan')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="so_dien_thoai" class="col-md-4 col-form-label text-md-right">Số điện
                                            thoại</label>
                                        <div class="col-md-6">
                                            <input type="text" value="{{ $sinhvien->so_dien_thoai }}" id="so_dien_thoai"
                                                class="form-control form-control-sm" name="so_dien_thoai" required>
                                            @error('so_dien_thoai')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="avatar" class="col-md-4 col-form-label text-md-right">Ảnh đại
                                            diện</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control form-control-sm" name="avatar"
                                                autocomplete="off">
                                            @error('avatar')
                                                <small class="help-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Lưu
                                        </button>
                                    </div>
                            </div>
                            </form>
                    </div>
                @elseif (Auth::user()->quyen == 2)

                @elseif (Auth::user()->quyen == 3)
                    <div class="card-body">
                        <form action="{{ route('postProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="ma_quan_tri_vien" class="col-md-4 col-form-label text-md-right">Mã quản trị
                                    viên</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $quantrivien->ma_quan_tri_vien }}" id="ma_quan_tri_vien"
                                        class="form-control form-control-sm" name="ma_quan_tri_vien" required autofocus
                                        readonly class="form-control-plaintext form-control-sm">
                                    @error('ma_quan_tri_vien')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ho_ten" class="col-md-4 col-form-label text-md-right">Họ tên</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $quantrivien->ho_ten }}" id="ho_ten"
                                        class="form-control form-control-sm" name="ho_ten" required autofocus readonly
                                        class="form-control-plaintext form-control-sm">
                                    @error('ho_ten')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="trinh_do" class="col-md-4 col-form-label text-md-right">Trình độ</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $quantrivien->trinh_do }}" id="trinh_do"
                                        class="form-control form-control-sm" name="trinh_do" required autofocus readonly
                                        class="form-control-plaintext form-control-sm">
                                    @error('trinh_do')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lop_hoc_id" class="col-md-4 col-form-label text-md-right">Đơn vị</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $quantrivien->don_vi }}" id="lop_hoc_id"
                                        class="form-control form-control-sm" name="lop_hoc_id" required autofocus readonly
                                        class="form-control-plaintext form-control-sm">
                                    @error('lop_hoc_id')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ Auth::user()->email }}" id="email"
                                        class="form-control form-control-sm" name="email" required autofocus readonly>
                                    @error('email')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ngay_sinh" class="col-md-4 col-form-label text-md-right">Ngày
                                    sinh</label>
                                <div class="col-md-6">
                                    <input type="date" value="{{ $quantrivien->ngay_sinh }}" id="ngay_sinh"
                                        class="form-control form-control-sm" name="ngay_sinh" required>
                                    @error('ngay_sinh')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gioi_tinh" class="col-md-4 col-form-label text-md-right">Giới
                                    tính</label>
                                <div class="col-md-6">
                                    <select class="form-control form-control-sm" name="gioi_tinh">
                                        <option {{ $quantrivien->gioi_tinh == 'Nam' ? 'selected' : '' }} value="Nam">Nam
                                        </option>
                                        <option {{ $quantrivien->gioi_tinh == 'Nữ' ? 'selected' : '' }} value="Nữ">
                                            Nữ
                                        </option>
                                        <option {{ $quantrivien->gioi_tinh == 'Khác' ? 'selected' : '' }} value="Khác">
                                            Khác
                                        </option>
                                    </select>
                                    @error('gioi_tinh')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="que_quan" class="col-md-4 col-form-label text-md-right">Quê
                                    quán</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $quantrivien->que_quan }}" id="que_quan"
                                        class="form-control form-control-sm" name="que_quan" required>
                                    @error('que_quan')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="so_dien_thoai" class="col-md-4 col-form-label text-md-right">Số điện
                                    thoại</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $quantrivien->so_dien_thoai }}" id="so_dien_thoai"
                                        class="form-control form-control-sm" name="so_dien_thoai" required>
                                    @error('so_dien_thoai')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">Ảnh đại
                                    diện</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control form-control-sm" name="avatar"
                                        autocomplete="off">
                                    @error('avatar')
                                        <small class="help-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Lưu
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
        </div>
        </div>
    @stop
