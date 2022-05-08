<table>
    <tr>
        <th>STT</th>
        <th>Mã sinh viên</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Quê quán</th>
        <th>Số điện thoại</th>
        <th>Thời gian đăng ký</th>
    </tr>
    @foreach ($svdks as $key => $svdk)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $svdk->sinhviens->ma_sinh_vien }}</td>
            <td>{{ $svdk->sinhviens->ho_ten }}</td>
            <td>{{ $svdk->sinhviens->ngay_sinh }}</td>
            <td>{{ $svdk->sinhviens->gioi_tinh }}</td>
            <td>{{ $svdk->sinhviens->que_quan }}</td>
            <td>{{ $svdk->sinhviens->so_dien_thoai }}</td>
            <td>{{ date('H:i:s d/m/Y', strtotime($svdk->created_at)) }}</td>
        </tr>
    @endforeach
</table>