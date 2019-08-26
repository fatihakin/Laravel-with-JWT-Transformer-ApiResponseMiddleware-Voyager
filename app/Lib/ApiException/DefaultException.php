<?php

namespace App\Lib\APIException;


use App\Lib\ApiExceptionAbstract;

class DefaultException extends ApiExceptionAbstract {

    public function getStatusKey()
    {
        return 'internal_server_error';
    }

    public function getStatusCode()
    {
        return 500;
    }
}
