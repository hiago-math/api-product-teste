<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::get('/hasToken', function () {
            return Cache::has('access_token') ? 1 : 0;
        });
    });
