<?php

use App\Http\Middleware\CheckAdminAndCompany;
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
    'middleware' => 'auth:jwt'
], function () {
    Route::get('me', 'AuthController@me');
    Route::get('logout', 'AuthController@logout');
});

//Route::group([
//
//    'middleware' => 'auth:jwt'
//
//], function ($router) {
//
//
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::get('me', 'AuthController@me');
//
//});

Route::post('login', 'AuthController@login');
