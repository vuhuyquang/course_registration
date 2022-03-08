<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemSo extends Model
{
    use HasFactory;
    protected $table = 'diemsos';
    protected $fillable = [
        'mon_hoc_id', 
        'sinh_vien_id', 
        'giang_vien_id', 
        'danh_gia', 
        'chuyen_can', 
        'giua_ky', 
        'cuoi_ky', 
        'diem_tong_ket', 
        'diem_chu'
    ];

    public function svdks()
    {
        return $this->hasOne(SVDK::class, 'sinh_vien_id', 'id');
    }
}
