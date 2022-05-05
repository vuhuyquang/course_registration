<table>
    <tr>
        <th>STT</th>
        <th>Mã giảng viên</th>
        <th>Họ tên</th>
        <th>Trình độ</th>
        <th>Ngành</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Quê quán</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Quyền</th>
    </tr>
    @foreach ($giangviens as $key => $giangvien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $giangvien->ma_giang_vien }}</td>
            <td>{{ $giangvien->ho_ten }}</td>
            <td>{{ $giangvien->trinh_do }}</td>
            <td>{{ $giangvien->nganhhocs->ten_nganh }}</td>
            <td>{{ $giangvien->ngay_sinh }}</td>
            <td>{{ $giangvien->gioi_tinh }}</td>
            <td>{{ $giangvien->que_quan }}</td>
            <td>{{ $giangvien->so_dien_thoai }}</td>
            <td>{{ $giangvien->taikhoans->email }}</td>
            <td>
                @if ($giangvien->taikhoans->quyen == 1)
                    Sinh viên
                @elseif ($giangvien->taikhoans->quyen == 2)
                    Giảng viên
                @elseif ($giangvien->taikhoans->quyen == 3) 
                    Quản trị viên
                @endif
            </td>
        </tr>
    @endforeach
</table>