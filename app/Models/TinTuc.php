<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = 'tintucs';
    protected $fillable = ['tieu_de', 'noi_dung_ngan', 'hinh_anh', 'duong_dan', 'ngay_dang'];
}
