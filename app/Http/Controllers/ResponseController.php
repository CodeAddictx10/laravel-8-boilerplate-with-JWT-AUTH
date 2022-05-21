<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ResponseController extends Controller
{
    /**
     * API response format
     * @param bool $status
     * @param mixed $payload
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public static function response(bool $status, mixed $payload, int $httpStatusCode): JsonResponse
    {
        return response()->json([
            'status'=>$status,
            'payload'=>$payload
        ], $httpStatusCode);
    }
}
