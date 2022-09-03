<?php

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
],
    function (){
        Route::post('login', [App\Http\Controllers\API\Auth\AuthController::class, 'login']);
        Route::post('logout', [App\Http\Controllers\API\Auth\AuthController::class, 'logout']);
        Route::get('refresh', [App\Http\Controllers\API\Auth\AuthController::class, 'refresh']);
        Route::get('user', [App\Http\Controllers\API\Auth\AuthController::class, 'user']);
    }
);
