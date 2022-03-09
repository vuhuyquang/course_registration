<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
    use HasFactory;
    protected $table = 'giangviens';
    protected $fillable = [
        'ma_giang_vien',
        'ho_ten',
        'trinh_do',
        'khoa_id',
        'mat_khau',
        'ngay_sinh',
        'gioi_tinh',
        'que_quan',
        'so_dien_thoai',
        'quyen'
    ];

    public function svdks()
    {
        return $this->hasMany(SVDK::class, 'giang_vien_id', 'id');
    }

    public function diemsos()
    {
        return $this->hasMany(DiemSo::class, 'giang_vien_id', 'id');
    }

    public function khoas()
    {
        return $this->hasOne(Khoa::class, 'id', 'khoa_id');
    }
}
