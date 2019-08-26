<?php

namespace App\Transformers;


use App\Lib\ApiExceptionAbstract;
use League\Fractal\TransformerAbstract;

class ExceptionTransformer extends TransformerAbstract
{
    public function transform(ApiExceptionAbstract $apiExceptionAbstract)
    {
        $result = [
            'messages' => $apiExceptionAbstract->getMessages(),
            'status_code' => $apiExceptionAbstract->getStatusCode(),
            'status_key' => $apiExceptionAbstract->getStatusKey()
        ];

        if (env('APP_DEBUG')){
            $exception = [
                'message'=>$apiExceptionAbstract->exception->getMessage(),
                'line'=>$apiExceptionAbstract->exception->getLine(),
                'code'=>$apiExceptionAbstract->exception->getCode(),
                'file'=>$apiExceptionAbstract->exception->getFile(),
                'previous'=>$apiExceptionAbstract->exception->getPrevious(),
                'trace'=>$apiExceptionAbstract->exception->getTrace(),

            ];
            $result['exception'] = $exception;
        }
        return $result;
    }

}
