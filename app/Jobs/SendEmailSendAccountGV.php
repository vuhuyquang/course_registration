<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MailNotify3;
use Mail;

class SendEmailSendAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $giangvien;
    protected $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($giangvien, $password)
    {
        $this->giangvien = $giangvien;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->giangvien->email)->send(new MailNotify3($this->giangvien, $this->password));
    }
}
