<?php

namespace App\Lib\APIException;


use App\Lib\ApiExceptionAbstract;

class NotFoundException extends ApiExceptionAbstract {

    public function getStatusKey()
    {
        return 'not_found';
    }

    public function getStatusCode()
    {
        return 404;
    }
}
