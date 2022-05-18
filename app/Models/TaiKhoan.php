<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'taikhoans';
    protected $fillable = ['email', 'password', 'lan_dau_tien', 'quyen'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sinhviens()
    {
        return $this->hasOne(SinhVien::class, 'tai_khoan_id', 'id');
    }

    public function quantriviens()
    {
        return $this->hasOne(QuanTriVien::class, 'tai_khoan_id', 'id');
    }

    public function giangviens()
    {
        return $this->hasOne(GiangVien::class, 'tai_khoan_id', 'id');
    }
}
