<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailStudyWarning extends Mailable
{
    use Queueable, SerializesModels;

    protected $sinhvien;
    protected $mucdo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sinhvien, $mucdo)
    {
        $this->sinhvien = $sinhvien;
        $this->mucdo = $mucdo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('canhcao')->with(['sinhvien' => $this->sinhvien, 'mucdo' => $this->mucdo]);
    }
}
