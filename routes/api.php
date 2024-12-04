<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Admin
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Ambassador

// Checkout
