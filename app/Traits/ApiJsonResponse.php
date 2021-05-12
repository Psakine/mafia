<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiJsonResponse
{
    /**
     * Return JSON response instance.
     *
     * @param string $message
     * @param int $status
     * @param null $errors
     * @return JsonResponse
     */
    public function jsonResponse(string $message, int $status, $errors = null): JsonResponse
    {
        $data = [
            'status' => $status,
            'message' => $message
        ];

        if (isset($errors)) {
            $data['errors'] = $errors;
        }

        return response()->json($data, $status);
    }
}
