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
}
