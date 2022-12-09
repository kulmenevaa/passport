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
    'controller' => AuthController::class,
    'prefix' => 'auth'
], function() {
    Route::post('login', 'login');
    Route::post('recovery-password', 'recoveryPassword');
    Route::post('reset-password', 'resetPassword');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'logout');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResources(['users' => UserController::class], ['only' => ['show']]);
    Route::group(['middleware' => 'scope:admin'], function() {
        Route::group(['controller' => NewsController::class], function() {
            
        });
    });
});