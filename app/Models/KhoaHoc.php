<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    use HasFactory;
    protected $table = 'khoahocs';
    protected $fillable = ['ma_khoa_hoc', 'mo_ta'];

    public function lophocs()
    {
        return $this->hasMany(LopHoc::class, 'khoa_hoc_id', 'id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_khoa_hoc', $key);
    	}
    }
}
