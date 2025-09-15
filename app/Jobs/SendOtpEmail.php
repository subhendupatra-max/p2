<?php

namespace App\Jobs;

use App\Mail\OtpMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOtpEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $otp;
    protected $userEmail;

    public function __construct($otp, $userEmail)
    {
        $this->otp = $otp;
        $this->userEmail = $userEmail;
    }

    public function handle()
    {
        Mail::to($this->userEmail)->send(new OtpMail($this->otp));
    }
}
