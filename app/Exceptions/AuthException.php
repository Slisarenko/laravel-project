<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class AuthException extends ErrorException
{
    public $code = Response::HTTP_BAD_REQUEST;
    public $message = 'AuthException';
}
