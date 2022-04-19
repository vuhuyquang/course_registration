@extends('layouts.site')
@section('main')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{ url('uploads') }}/avatar_default.png"><span class="font-weight-bold">{{ $sinhvien->ho_ten }}</span><span class="text-black-50">{{ $sinhvien->taikhoans->email }}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Hồ sơ cá nhân</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mã sinh viên</label><input type="text" class="form-control" value="{{ $sinhvien->ma_sinh_vien }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Khóa học</label><input type="text" class="form-control" value="{{ $sinhvien->khoahocs->ma_khoa_hoc }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Lớp học</label><input type="text" class="form-control" value="{{ $sinhvien->lophocs->ma_lop }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Ngành học</label><input type="text" class="form-control" value="{{ $sinhvien->nganhhocs->ten_nganh }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Ngày sinh</label><input type="text" class="form-control" value="{{ $sinhvien->ngay_sinh }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Giới tính</label><input type="text" class="form-control" value="{{ $sinhvien->gioi_tinh }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Quê quán</label><input type="text" class="form-control" value="{{ $sinhvien->que_quan }}" readonly></div>
                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" class="form-control" value="{{ $sinhvien->so_dien_thoai }}" readonly></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@stop()

@section('css')
    <style>
        body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection