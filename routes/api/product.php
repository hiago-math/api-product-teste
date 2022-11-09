<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')
    ->prefix('product')
    ->group(function () {
        Route::get('/all', [ProductController::class, 'getAll']);
        Route::get('/{id}', [ProductController::class, 'getById']);
        Route::post('/{id}', [ProductController::class, 'update']);
        Route::post('', [ProductController::class, 'store']);
        Route::delete('/{id}', [ProductController::class, 'delete']);
    });
