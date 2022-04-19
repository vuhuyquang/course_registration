<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
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
     * @return 
     */
    public function build()
    {
        if ($this->taikhoan->quyen == 1) {
            return $this->view('quantrivien.qlsinhvien.captaikhoan')->subject('Cấp tài khoản sinh viên')->with(['hoten' => $this->hoten, 'taikhoan' => $this->taikhoan, 'password' => $this->password]);
        } elseif ($this->taikhoan->quyen == 2) {
            return $this->view('quantrivien.qlgiangvien.captaikhoan')->subject('Cấp tài khoản giảng viên')->with(['hoten' => $this->hoten, 'taikhoan' => $this->taikhoan, 'password' => $this->password]);
        }
    }
}
