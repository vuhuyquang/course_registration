<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    protected $table = 'khoas';
    protected $fillable = ['ma_khoa', 'ten_khoa'];

    public function lophocs()
    {
        return $this->hasMany(LopHoc::class, 'khoa_id', 'id');
    }

    public function monhocs()
    {
        return $this->hasMany(MonHoc::class, 'khoa_id', 'id');
    }
}
