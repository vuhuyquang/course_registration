<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;
    protected $table = 'monhocs';
    protected $fillable = ['ma_mon_hoc', 'khoa_id', 'ten_mon_hoc', 'so_tin_chi', 'hoc_phi'];

    public function khoas()
    {
        return $this->hasOne(Khoa::class, 'id', 'khoa_id');
    }
}
