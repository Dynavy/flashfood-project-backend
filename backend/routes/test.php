<?php

use Illuminate\Support\Facades\Route;

Route::get('/test/400', function () {
    abort(400, 'Bad Request Test');
});

Route::get('/test/401', function () {
    throw new \Illuminate\Auth\AuthenticationException('Unauthorized Test');
});

Route::get('/test/403', function () {
    throw new \Illuminate\Auth\Access\AuthorizationException('Unauthorized access');
});

Route::get('/test/404', function () {
    // Simula un modelo no encontrado
    throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Model not found test');
});

Route::get('/invalid-query', function () {
    DB::table('non_existing_table')->get();
});

Route::get('/test/429', function () {
    throw new \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException(
        null, 
        'Too Many Requests Test' 
    );
});