<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

Route::prefix('error-testing')->group(function () {

    // Test HTTP 400 - Malformed request
    Route::get('/400', function () {
        abort(400, 'Bad Request Test');
    })->name('error.bad-request');

    // Test HTTP 401 - User not authenticated.
    Route::get('/401', function () {
        throw new AuthenticationException('Unauthorized Test');
    })->name('error.unauthorized');

    // Test HTTP 403 - User lacks permissions.
    Route::get('/403', function () {
        throw new AuthorizationException('Unauthorized access');
    })->name('error.forbidden');

    // Test HTTP 404 - Resource not found.
    Route::get('/404', function () {
        throw new ModelNotFoundException('Model not found test');
    })->name('error.not-found');

    // Test HTTP 429 - Rate limit exceeded.
    Route::get('/429', function () {
        throw new TooManyRequestsHttpException(
            null,
            'Too Many Requests Test'
        );
    })->name('error.too-many-requests');

    // Test database table not found error.
    Route::get('/database-error', function () {
        DB::table('non_existing_table')->get();
    })->name('error.database');
});
