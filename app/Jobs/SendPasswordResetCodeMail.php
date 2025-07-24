<?php

namespace App\Jobs;

use App\Models\UserAccount;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordResetCodeMail implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new job instance.
     */

    public function __construct(protected string $email, protected string $resetCode)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ResetPasswordMail($this->resetCode));
    }
}
