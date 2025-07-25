<?php

namespace App\Exceptions;

use Exception;

class FailedVerifyResetPasswordCodeException extends Exception
{
    protected $message = 'Mã xác thực không khớp';
}
