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
        'mon_hoc_id',
        'giang_vien_id',
        'nganh_id',
        'thoi_gian_dk',
    ];

    public function hocphans()
    {
        return $this->hasOne(HocPhan::class, 'id', 'hoc_phan_id');
    }

    public function giangviens()
    {
        return $this->hasOne(GiangVien::class, 'id', 'giang_vien_id');
    }

    public function monhocs()
    {
        return $this->hasOne(MonHoc::class, 'id', 'mon_hoc_id');
    }

    public function sinhviens()
    {
        return $this->hasOne(SinhVien::class, 'id', 'sinh_vien_id');
    }
}
