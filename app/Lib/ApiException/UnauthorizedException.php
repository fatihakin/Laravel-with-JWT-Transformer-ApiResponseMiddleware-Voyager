<?php

namespace App\Lib\APIException;


use App\Lib\ApiExceptionAbstract;

class UnauthorizedException extends ApiExceptionAbstract {

    public function getStatusKey()
    {
        return 'unauthorized';
    }

    public function getStatusCode()
    {
        return 401;
    }
}
