<?php

namespace App\Exceptions;

use Exception;

class NotFoundUserException extends Exception
{
    protected $message = 'Không tìm thấy người dùng';
}
