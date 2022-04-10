<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MailNotify;
use Mail;

class SendEmailSendAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sinhvien;
    protected $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sinhvien, $password)
    {
        $this->sinhvien = $sinhvien;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->sinhvien->email)->send(new MailNotify($this->sinhvien, $this->password));
    }
}
