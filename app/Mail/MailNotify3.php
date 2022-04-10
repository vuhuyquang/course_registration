<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $giangvien;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($giangvien, $password)
    {
        $this->giangvien = $giangvien;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('quantrivien.qlgiangvien.captaikhoan')->subject('Cấp tài khoản sinh viên')->with(['giangvien' => $this->giangvien, 'password' => $this->password]);
    }
}
