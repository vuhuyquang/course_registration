<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanhCao extends Model
{
    use HasFactory;

    protected $table = 'canhcaos';
    protected $fillable = ['sinh_vien_id', 'muc_do'];

    public function sinhviens()
    {
        return $this->hasOne(SinhVien::class, 'id', 'sinh_vien_id');
    }
}
