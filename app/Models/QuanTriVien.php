<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuanTriVien extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'quantriviens';
    protected $fillable = [
        'ma_quan_tri_vien', 
        'ho_ten', 
        'trinh_do', 
        'don_vi', 
        'email', 
        'password', 
        'ngay_sinh',
        'gioi_tinh',
        'que_quan',
        'so_dien_thoai',
        'avatar',
        'quyen'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
