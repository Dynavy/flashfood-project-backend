<?php

namespace App\Http\Middleware;

use Closure;

class CheckJsonContentType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        // If the request is not a POST method, allow it to continue.
        if (!$request->isMethod('post'))
            return $next($request);

        // Check if the Accept header is not set to 'application/json'.
        $acceptHeader = $request->header('Accept');
        if ($acceptHeader != 'application/json') {
            return response()->json(
                [
                    'status' => 'error',
                    'code' => 406,
                    'message' => 'Not Acceptable',
                    'details' => 'The Accept header must be set to application/json to process this request.',
                ],
                406
            );
        }

        return $next($request);
    }
}