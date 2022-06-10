<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocPhi extends Model
{
    use HasFactory;

    protected $table = 'hocphis';
    protected $fillable = ['sinh_vien_id', 'so_tin_chi', 'ma_hoc_ky', 'da_dong'];

    public function sinhviens()
    {
        return $this->hasOne(SinhVien::class, 'id', 'sinh_vien_id');
    }
}
