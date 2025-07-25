<?php
namespace App\Helpers;
class JsonResponseFormat
{
    public static function successResponse(int $statusCode = 200, ?string $message, $data)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => []
        ], $statusCode);
    }
    public static function errorResponse(int $statusCode = 500, ?string $message, $errors)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => [],
            'errors' => $errors
        ], $statusCode);
    }
}