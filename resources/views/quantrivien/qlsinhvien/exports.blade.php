<table>
    <tr>
        <th>STT</th>
        <th>Mã sinh viên</th>
        <th>Họ tên</th>
        <th>Khóa học</th>
        <th>Lớp học</th>
        <th>Ngành học</th>
        <th>Email</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Quê quán</th>
        <th>Số điện thoại</th>
        <th>Quyền</th>
    </tr>
    @foreach ($sinhviens as $key => $sinhvien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $sinhvien->ma_sinh_vien }}</td>
            <td>{{ $sinhvien->ho_ten }}</td>
            <td>{{ $sinhvien->khoahocs->ma_khoa_hoc }}</td>
            <td>{{ $sinhvien->lophocs->ma_lop }}</td>
            <td>{{ $sinhvien->nganhhocs->ten_nganh }}</td>
            <td>{{ $sinhvien->taikhoans->email }}</td>
            <td>{{ $sinhvien->ngay_sinh }}</td>
            <td>{{ $sinhvien->gioi_tinh }}</td>
            <td>{{ $sinhvien->que_quan }}</td>
            <td>{{ $sinhvien->so_dien_thoai }}</td>
            <td>
                @if ($sinhvien->taikhoans->quyen == 1)
                    Sinh viên
                @elseif ($sinhvien->taikhoans->quyen == 2)
                    Giảng viên
                @elseif ($sinhvien->taikhoans->quyen == 3) 
                    Quản trị viên
                @endif
            </td>
        </tr>
    @endforeach
</table>