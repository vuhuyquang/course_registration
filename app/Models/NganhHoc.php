<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NganhHoc extends Model
{
    use HasFactory;
    protected $table = 'nganhhocs';
    protected $fillable = ['ma_nganh', 'ten_nganh', 'khoa_id'];

    public function monhocs()
    {
        return $this->hasMany(MonHoc::class, 'nganh_id', 'id');
    }

    public function khoas()
    {
        return $this->hasOne(Khoa::class, 'id', 'khoa_id');
    }

    public function sinhviens()
    {
        return $this->hasMany(SinhVien::class, 'nganh_hoc_id'. 'id');
    }

    public function giangviens()
    {
        return $this->hasMany(SinhVien::class, 'nganh_hoc_id'. 'id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_nganh', $key)->orWhere('ten_nganh', $key);
    	}
    }
}
