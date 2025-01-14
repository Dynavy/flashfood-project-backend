<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Restaurant\OfferController;
use App\Http\Controllers\Restaurant\CategoryController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\CheckJsonContentType;
use Illuminate\Support\Facades\Route;

// USER ROUTES:        
Route::resource('users', UserController::class);
Route::get('users/search/{name}', [UserController::class, 'findByName']);

// CATEGORIES ROUTES:
Route::resource('categories', CategoryController::class);
Route::get('categories/search/{name}', [CategoryController::class, 'findByName']);

// RESTAURANT ROUTES:
Route::resource('restaurants', RestaurantController::class);
Route::get('restaurants/search/{name}', [RestaurantController::class, 'findByName']);

// REVIEW ROUTES:
Route::resource('reviews', ReviewController::class);

// OFFER ROUTES:        
Route::resource('offers', OfferController::class);
Route::get('offers/search/{name}', [OfferController::class, 'findByName']);

// FAVORITE ROUTES:
Route::apiResource('favorites', FavoriteController::class);

// AUTH ROUTES (REGISTER, LOGIN, LOGOUT):
Route::post('register', [AuthController::class, 'register'])->middleware(CheckJsonContentType::class);
Route::post('login', [AuthController::class, 'login'])->middleware(CheckJsonContentType::class);
Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum', CheckJsonContentType::class]);

// PASSWORD RECOVER ROUTES (FORGOTPASSWOWRD, RESETPASSWORD):
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->middleware(CheckJsonContentType::class);
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update')->middleware(CheckJsonContentType::class);


/* Automatic HTTP GET request route generated by Laravel Sancturn that manage the authentication of the users.

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */