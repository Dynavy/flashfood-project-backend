<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Status 400 --> Bad Request.
        if ($request->header('Content-Type') !== 'application/json' || $exception instanceof \InvalidArgumentException) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Bad request.',
                'error' => [
                    'type' => 'InvalidArgumentException',
                    'details' => 'The request cannot be processed due to invalid input. Ensure Content-Type has application/json (POSTMAN).',
                ],
            ], 400);
        }

        // Status 401 --> Unauthorized.
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'message' => 'Invalid Credentials.',
                'error' => [
                    'type' => 'AuthenticationException',
                    'details' => 'You need to authenticate to access this resource.',
                ],
            ], 401);
        }

        // Status 403 --> Forbidden.
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'status' => 'error',
                'code' => 403,
                'message' => 'Forbidden.',
                'error' => [
                    'type' => 'AuthorizationException',
                    'details' => 'You do not have permission to access this resource.',
                ],
            ], 403);
        }

        // Status 404 --> The resource was not found in the database.
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Resource not found.',
                'error' => [
                    'type' => 'ModelNotFoundException',
                    'details' => 'The resource you requested could not be found in the database.',
                ],
            ], 404);
        }

        // Status 429 --> Too Many Requests.
        if ($exception instanceof TooManyRequestsHttpException) {
            return response()->json([
                'status' => 'error',
                'code' => 429,
                'message' => 'Too many requests.',
                'error' => [
                    'type' => 'TooManyRequestsHttpException',
                    'details' => 'You have exceeded the rate limit. Please try again later.',
                ],
            ], 429);
        }

        // Status 500 --> Database query error (query exception).
        if ($exception instanceof QueryException) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Database query error.',
                'error' => [
                    'type' => 'QueryException',
                    'details' => 'An issue occurred with the database query. Please try again later.',
                ],
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
