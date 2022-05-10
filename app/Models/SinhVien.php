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

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_sinh_vien', $key)->orWhere('ho_ten', 'LIKE', '%' . $key . '%')->orWhere('que_quan', 'LIKE', '%' . $key . '%')->orWhere('so_dien_thoai', 'LIKE', '%' . $key . '%');
    	}
    }

    public function scopeNienkhoa($query)
    {
        if ($khoahocid = request()->khoa_hoc_id) {
            return $query->where('khoa_hoc_id', $khoahocid);
        }
    }

    public function scopeLophoc($query)
    {
        if ($lophocid = request()->lop_hoc_id) {
            return $query->where('lop_hoc_id', $lophocid);
        }
    }

    public function scopeNganhhoc($query)
    {
        if ($nganhhocid = request()->nganh_hoc_id) {
            return $query->where('nganh_hoc_id', $nganhhocid);
        }
    }
}
