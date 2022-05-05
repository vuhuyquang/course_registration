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
        'nganh_hoc_id',
        'ngay_sinh',
        'gioi_tinh',
        'que_quan',
        'so_dien_thoai',
        'avatar',
        'tai_khoan_id'
    ];

    public function svdks()
    {
        return $this->hasMany(SVDK::class, 'giang_vien_id', 'id');
    }

    public function diemsos()
    {
        return $this->hasMany(DiemSo::class, 'giang_vien_id', 'id');
    }

    public function nganhhocs()
    {
        return $this->hasOne(NganhHoc::class, 'id', 'nganh_hoc_id');
    }

    public function taikhoans()
    {
        return $this->hasOne(TaiKhoan::class, 'id', 'tai_khoan_id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_giang_vien', $key)->orWhere('ho_ten', $key)->orWhere('que_quan', $key)->orWhere('so_dien_thoai', $key);
    	}
    }
}
