@extends('layouts.site')
@section('main')
    <form action="{{ route('mon-hoc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_mon_hoc">Mã môn học <label style="color: red" for="ma_mon_hoc">*</label></label>
            <input id="ma_mon_hoc" type="text" class="form-control form-control-sm" name="ma_mon_hoc" placeholder="Nhập mã môn học" autocomplete="off"
                required autofocus>
            @error('ma_mon_hoc')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ten_mon_hoc">Tên môn học <label style="color: red" for="ten_mon_hoc">*</label></label>
            <input id="ten_mon_hoc" type="text" class="form-control form-control-sm" name="ten_mon_hoc" placeholder="Nhập tên môn học" autocomplete="off"
                required autofocus>
            @error('ten_mon_hoc')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nganh_id">Ngành <label style="color: red" for="ma_lop_hoc">*</label></label>
            <select id="nganh_id" class="form-control form-control-sm" name="nganh_id" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn ngành ---</option>
                @foreach ($nganhhocs as $nganhhoc)
                    <option value="{{ $nganhhoc->id }}">{{ $nganhhoc->ten_nganh }}</option>
                @endforeach
            </select>
            @error('nganh_id')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="so_tin_chi">Số tín chỉ <label style="color: red" for="so_tin_chi">*</label></label>
            <input id="so_tin_chi" type="number" class="form-control form-control-sm" name="so_tin_chi" placeholder="Nhập số tín chỉ" autocomplete="off"
                required autofocus>
            @error('so_tin_chi')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
