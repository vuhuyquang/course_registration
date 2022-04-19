<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify2 extends Mailable
{
    use Queueable, SerializesModels;

    public $hoten;
    public $taikhoan;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hoten, $taikhoan, $password)
    {
        $this->hoten = $hoten;
        $this->taikhoan = $taikhoan;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->taikhoan->quyen == 1) {
            return $this->view('quantrivien.qlsinhvien.caplaimatkhau')->subject('Đặt lại mật khẩu tài khoản sinh viên')->with(['hoten' => $this->hoten, 'password' => $this->password]);
        } elseif ($this->taikhoan->quyen == 2) {
            return $this->view('quantrivien.qlgiangvien.caplaimatkhau')->subject('Đặt lại mật khẩu tài khoản giảng viên')->with(['hoten' => $this->hoten, 'password' => $this->password]);
        }
    }
}
