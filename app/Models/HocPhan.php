<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HocPhan extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $dates = ['deleted_at'];
    protected $table = 'hocphans';
    protected $fillable = [
        'ma_hoc_phan',
        'mon_hoc_id',
        'thoi_gian',
        'dia_diem',
        'giang_vien_id',
        'dk_toi_da',
        'da_dang_ky',
    ];

    public function monhocs()
    {
        return $this->hasOne(MonHoc::class, 'id', 'mon_hoc_id');
    }

    public function svdks()
    {
        return $this->hasMany(SVDK::class, 'hoc_phan_id', 'id');
    }

    public function giangviens()
    {
        return $this->hasOne(GiangVien::class, 'id', 'giang_vien_id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_lop', $key)->orWhere('ma_hoc_phan', $key);
    	}
    }
}
