<?php

namespace App\Http\Middleware;

use App\APILog;
use App\Lib\ApiResponse;
use App\Lib\TransformSerializer;
use Closure;
use Illuminate\Http\Response;

class ApiResponseMiddleware
{
    protected function getApiResponse($response)
    {
        return $response->getOriginalContent();
    }

    public function handle($request, Closure $next)
    {
        $response =  $next($request);
        if ($response instanceof Response){
            $apiResponse = $this->getApiResponse($response);
            if ($apiResponse instanceof ApiResponse){
                return Response::create(
                    $apiResponse->getData(),$apiResponse->getStatus(),$apiResponse->getHeaders()
                );
            }
        }
    }
}
