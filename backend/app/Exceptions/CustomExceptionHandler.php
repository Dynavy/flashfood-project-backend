<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
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

        // Status 500 --> Database query error (query exception).
        if ($exception instanceof QueryException) {
            return response()->json([
                'message' => 'Database query error.',
                'error' => 'An issue occurred with the database query. Please try again later.',
            ], 500);
        }

        // Status 500 --> Internal server error, something went wrong on the server. 
        if ($exception instanceof \Exception) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => [
                    'type' => 'Exception',
                    'details' => 'Something went wrong on the server, please try again later.',
                ],
            ], 500);
        }

        return parent::render($request, $exception);
    }
}