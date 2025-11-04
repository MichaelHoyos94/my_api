<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Funcion para responder desde la api ok.
     */
    protected function success($data, $message = '', $code = 200) : JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Funcion para responder desde la api con error.
     */
    protected function error($message, $code = 400) : JsonResponse 
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);  
    }
}