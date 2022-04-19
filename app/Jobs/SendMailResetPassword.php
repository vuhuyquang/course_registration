<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MailNotify2;
use Mail;

class SendMailResetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hoten;
    protected $taikhoan;
    protected $password;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->taikhoan->email)->send(new MailNotify2($this->hoten, $this->taikhoan, $this->password));
    }
}
