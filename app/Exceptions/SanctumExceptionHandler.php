<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Exception;
class SanctumExceptionHandler extends ExceptionHandler
{
    public function render($request, Exception|\Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Http\Exceptions\UnauthorizedHttpException) {
            // Handle unauthorized access for Sanctum middleware
            return response()->json([
                'message' => 'Unauthorized access using Sanctum.',
                'error' => 'Unauthenticated'
            ], 401);
        }

        return parent::render($request, $exception);
    }
}
