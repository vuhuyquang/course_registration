<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SVDK extends Model
{
    use HasFactory;
    protected $table = 'svdks';
    protected $fillable = [
        'hoc_phan_id',
        'sinh_vien_id',
        'giang_vien_id',
        'nganh_id',
        'thoi_gian_dk',
    ];

    public function hocphans()
    {
        return $this->hasOne(TaiKhoan::class, 'id', 'tai_khoan_id');
    }
}
