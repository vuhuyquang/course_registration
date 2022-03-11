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
        'ngay_sinh',
        'gioi_tinh',
        'khoa_hoc_id',
        'lop_hoc_id',
        'mat_khau',
        'que_quan',
        'email ',
        'avatar',
        'quyen'
    ];

    public function khoahocs()
    {
        return $this->hasOne(KhoaHoc::class, 'id', 'khoa_hoc_id');
    }

    public function lophocs()
    {
        return $this->hasOne(LopHoc::class, 'id', 'lop_hoc_id');
    }
}
