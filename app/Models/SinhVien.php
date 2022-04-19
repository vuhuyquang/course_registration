<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;
    protected $table = 'sinhviens';
    protected $fillable = [
        'ma_sinh_vien',
        'ho_ten',
        'khoa_hoc_id',
        'lop_hoc_id',
        'nganh_hoc_id',
        'ngay_sinh',
        'gioi_tinh',
        'que_quan',
        'so_dien_thoai',
        'avatar',
        'tai_khoan_id'
    ];

    public function khoahocs()
    {
        return $this->hasOne(KhoaHoc::class, 'id', 'khoa_hoc_id');
    }

    public function lophocs()
    {
        return $this->hasOne(LopHoc::class, 'id', 'lop_hoc_id');
    }

    public function nganhhocs()
    {
        return $this->hasOne(NganhHoc::class, 'id', 'nganh_hoc_id');
    }

    public function taikhoans()
    {
        return $this->hasOne(TaiKhoan::class, 'id', 'tai_khoan_id');
    }
}
