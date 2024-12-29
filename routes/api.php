<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

// Admin
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware([Authenticate::class])->group(function () {
        Route::get('user', [AuthController::class, 'user']);
    });
});

// Ambassador

// Checkout
