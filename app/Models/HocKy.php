<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    use HasFactory;
    protected $table = 'hockys';
    protected $fillable = ['ma_hoc_ky', 'mo_ta', 'trang_thai'];

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
    		return $query->where('ma_hoc_ky', $key);
    	}
    }
}
