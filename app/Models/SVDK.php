<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SVDK extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
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
        return $this->hasOne(HocPhan::class, 'id', 'hoc_phan_id')->withTrashed();
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
