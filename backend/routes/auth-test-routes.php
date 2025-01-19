<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\CheckJsonContentType;

Route::prefix('auth-test')->group(function () {

    Route::post('register', [AuthController::class, 'register'])->middleware(CheckJsonContentType::class);
    Route::post('login', [AuthController::class, 'login'])->middleware(CheckJsonContentType::class);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum', CheckJsonContentType::class]);
});