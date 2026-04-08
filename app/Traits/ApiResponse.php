<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Send a success response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function success(mixed $data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Send an error response.
     *
     * @param string|null $message
     * @param int $code
     * @param mixed|null $errors
     * @return JsonResponse
     */
    protected function error(string $message = null, int $code = 400, mixed $errors = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
