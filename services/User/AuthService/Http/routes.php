<?php

namespace Services\User\AuthService\Http;

use Illuminate\Support\Facades\Route;
use Services\User\AuthService\Http\Controllers\AuthController;

Route::prefix('auth')->middleware('api')->controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('user', 'user');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
});
