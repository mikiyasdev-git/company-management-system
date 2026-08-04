<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Successful response.
     */
    protected function success(
        mixed $data = null,
        string $message = 'Success',
        int $status = 200
    ) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Error response.
     */
    protected function error(
        string $message = 'Error',
        mixed $errors = null,
        int $status = 400
    ) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
