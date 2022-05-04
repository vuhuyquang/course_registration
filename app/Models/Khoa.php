<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    protected $table = 'khoas';
    protected $fillable = ['ma_khoa', 'ten_khoa'];

    public function nganhhocs()
    {
        return $this->hasMany(NganhHoc::class, 'khoa_id', 'id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_khoa', $key)->orWhere('ten_khoa', $key);
    	}
    }
}
