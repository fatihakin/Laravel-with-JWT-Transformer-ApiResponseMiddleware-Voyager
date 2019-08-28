<?php

namespace App\Http\Middleware;

use App\Lib\APIExceptions\ForbiddenException;
use App\Lib\APIExceptions\UnauthorizedException;
use Closure;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth('jwt')->user();
        if (!$user) {
            throw (new UnauthorizedException())->setMessages([['Giriş yapmanız gerekiyor.']]);
        }
        auth()->login($user);

        return $next($request);
    }
}
