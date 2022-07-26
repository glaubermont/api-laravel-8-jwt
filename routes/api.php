<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentaryController;
use App\Http\Middleware\ProtectedRouteAuth;

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
route::prefix('v1')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/documentary/getById/{id}','App\Http\Controllers\DocumentaryController@getById');
    Route::get('/documentary/getAll','App\Http\Controllers\DocumentaryController@getAll');
    Route::middleware([ProtectedRouteAuth::class])->group(function(){
        Route::put('/documentary/update/{id}','App\Http\Controllers\DocumentaryController@update');
        Route::delete('/documentary/delete/{id}','App\Http\Controllers\DocumentaryController@delete');
        Route::post('/documentary/store', 'App\Http\Controllers\DocumentaryController@store');

        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);       
    });
});

