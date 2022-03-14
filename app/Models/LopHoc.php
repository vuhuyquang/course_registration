<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;
    protected $table = 'lophocs';
    protected $fillable = ['ma_lop', 'khoa_id', 'khoa_hoc_id'];

    public function khoahocs()
    {
        return $this->hasOne(KhoaHoc::class, 'id', 'khoa_hoc_id');
    }

    public function nganhhocs()
    {
        return $this->hasOne(Khoa::class, 'id', 'nganh_id');
    }
}
