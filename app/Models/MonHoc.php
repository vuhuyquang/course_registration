<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;
    protected $table = 'monhocs';
    protected $fillable = ['ma_mon_hoc', 'khoa_id', 'ten_mon_hoc', 'so_tin_chi', 'hoc_phi'];

    public function nganhhocs()
    {
        return $this->hasOne(NganhHoc::class, 'id', 'nganh_id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_mon_hoc', $key)->orWhere('ten_mon_hoc', $key);
    	}
    }
}
