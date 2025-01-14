<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset.form');

// Route::get('/', function () {
//     return view('welcome');
// });
