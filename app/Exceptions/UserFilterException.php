<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UserFilterException extends ErrorException
{
    public $code = Response::HTTP_BAD_REQUEST;
    public $message = 'UserFilterException';
}
