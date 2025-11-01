<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        // 👇 Si la petición es de la API, siempre responde en JSON
        if ($request->is($request->expectsJson())) {

            // Error de validación
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Error de validación',
                    'errors' => $exception->errors(),
                ], 422);
            }

            // Error de autenticación
            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'message' => 'No autenticado.',
                ], 401);
            }

            // Otros errores
            return response()->json([
                'message' => $exception->getMessage(),
            ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
        }

        return parent::render($request, $exception);
    }
}
