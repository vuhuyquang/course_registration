<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $sinhvien;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sinhvien, $password)
    {
        $this->sinhvien = $sinhvien;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('quantrivien.qlsinhvien.captaikhoan')->subject('Cấp tài khoản sinh viên')->with(['sinhvien' => $this->sinhvien, 'password' => $this->password]);
    }
}
