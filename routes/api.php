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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['api'],
], function() {

Route::group(['namespace' => 'App\Http\Controllers\API\Auth'], function()
{

    Route::post('/login', 'ApiAuthenticationController@login')->name('login');

    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::post('/user', 'ApiAuthenticationController@user')->name('user');
        Route::post('/logout', 'ApiAuthenticationController@logout')->name('logout');
    });
    
});

});
    




