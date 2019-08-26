<?php

namespace App\Http\Middleware;

use App\APILog;
use App\Lib\APIErrorResponseAbstract;
use App\Lib\APIException\DefaultException;
use App\Lib\ApiExceptionAbstract;
use App\Lib\ApiResponse;
use App\Lib\Transformer;
use App\Lib\TransformSerializer;
use App\Transformers\DefaultErrorTransformer;
use App\Transformers\ExceptionTransformer;
use Closure;
use Illuminate\Http\Response;
use League\Fractal\Resource\Item;

class ApiResponseMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof Response) {
            if (isset($response->exception)) {
                if ($response->exception instanceof ApiExceptionAbstract) {
                    $apiExceptionAbstract = $response->exception;
                    $transformer = (new Transformer())
                        ->createData(new Item($apiExceptionAbstract, new ExceptionTransformer()));

                    return Response::create(
                        $transformer->toArray(), $apiExceptionAbstract->getStatusCode());
                } else {
                    $defaultException = new DefaultException();
                    $defaultException->setMessages(['Bir hata oluştu...']);
                    $defaultException->exception = $response->exception;
                    $transformer = (new Transformer())
                        ->createData(new Item($defaultException, new ExceptionTransformer()));

                    return Response::create(
                        $transformer->toArray(), $defaultException->getStatusCode());
                }
            }

            $apiResponse = $this->getApiResponse($response);
            if ($apiResponse instanceof ApiResponse) {
                return Response::create(
                    $apiResponse->getData(), $apiResponse->getStatus(), $apiResponse->getHeaders()
                );
            }
        }
    }

    protected function getApiResponse($response)
    {
        return $response->getOriginalContent();
    }
}
