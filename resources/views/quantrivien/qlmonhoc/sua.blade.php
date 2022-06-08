@extends('layouts.site')
@section('main')
    <form action="{{ route('mon-hoc.update', ['id' => $monhoc->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_mon_hoc">Mã môn học <label style="color: red" for="ma_mon_hoc">*</label></label>
            <input type="text" class="form-control form-control-sm" id="ma_mon_hoc" name="ma_mon_hoc" value="{{ $monhoc->ma_mon_hoc }}" placeholder="Nhập mã ngành" autocomplete="off"
                required>
            @error('ma_mon_hoc')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ten_mon_hoc">Tên môn học <label style="color: red" for="ten_mon_hoc">*</label></label>
            <input type="text" class="form-control form-control-sm" id="ten_mon_hoc" name="ten_mon_hoc" value="{{ $monhoc->ten_mon_hoc }}" placeholder="Nhập tên ngành" autocomplete="off" required>
            @error('ten_mon_hoc')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nganh_id">Ngành <label style="color: red" for="ma_lop_hoc">*</label></label>
            <select id="nganh_id" class="form-control form-control-sm" name="nganh_id">
                <option value="" selected="" disabled="">--- Chọn ngành ---</option>
                @foreach ($nganhhocs as $nganhhoc)
                    <option {{ $monhoc->nganh_id == $nganhhoc->id ? 'selected' : '' }} value="{{ $nganhhoc->id }}">{{ $nganhhoc->ten_nganh }}</option>
                @endforeach
            </select>
            @error('nganh_id')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="so_tin_chi">Số tín chỉ <label style="color: red" for="so_tin_chi">*</label></label>
            <input id="so_tin_chi" type="number" class="form-control form-control-sm" name="so_tin_chi" value="{{ $monhoc->so_tin_chi }}" placeholder="Nhập số tín chỉ" autocomplete="off"
                required>
            @error('so_tin_chi')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="hoc_ky">Học kỳ <label style="color: red" for="ma_lop_hoc">*</label></label>
            <select id="hoc_ky" class="form-control form-control-sm" name="hoc_ky" id="gioi_tinh">
                <option value="" selected="" disabled="">--- Chọn học kỳ ---</option>
                <option {{ $monhoc->hoc_ky == 1 ? 'selected' : '' }} value="1">1</option>
                <option {{ $monhoc->hoc_ky == 2 ? 'selected' : '' }} value="2">2</option>
                <option {{ $monhoc->hoc_ky == 3 ? 'selected' : '' }} value="3">3</option>
                <option {{ $monhoc->hoc_ky == 4 ? 'selected' : '' }} value="4">4</option>
                <option {{ $monhoc->hoc_ky == 5 ? 'selected' : '' }} value="5">5</option>
                <option {{ $monhoc->hoc_ky == 6 ? 'selected' : '' }} value="6">6</option>
                <option {{ $monhoc->hoc_ky == 7 ? 'selected' : '' }} value="7">7</option>
                <option {{ $monhoc->hoc_ky == 8 ? 'selected' : '' }} value="8">8</option>
            </select>
            @error('hoc_ky')
                <small class="help-block">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop()
