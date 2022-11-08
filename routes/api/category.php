<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')
    ->prefix('category')
    ->group(function () {
        Route::get('/all', [CategoryController::class, 'getAll']);
        Route::get('/{id}', [CategoryController::class, 'getById']);
    });
