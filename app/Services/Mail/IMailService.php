<?php
namespace App\Services\Mail;
interface IMailService
{
    public function sendVerifyResetCodeMail(string $email);
}