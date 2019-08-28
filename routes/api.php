<?php

use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Middleware\ApiResponseMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => [ApiResponseMiddleware::class]
], function () {
    Route::post('login', 'AuthController@login');
    Route::group([
        'middleware' => [ApiAuthMiddleware::class]
    ], function () {
        Route::get('me', 'AuthController@me');
        Route::get('logout', 'AuthController@logout');
    });
});






