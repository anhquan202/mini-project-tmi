<?php
namespace App\Services\Mail;

use Illuminate\Support\Facades\Log;
use App\Jobs\SendPasswordResetCodeMail;

class MailService implements IMailService
{
    public function sendVerifyResetCodeMail(string $email)
    {
        try {
            $generatedCode = rand(1000, 9999);
            SendPasswordResetCodeMail::dispatch($email, $generatedCode);
            session(['generatedCode' => $generatedCode]);

            return true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}