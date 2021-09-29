<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ApiBaseController extends Controller
{

    public function successResponse($message, int $statusCode = 200)
    {
        return response()->json(['message' => $message, 'code' => $statusCode, 'status' => true], $statusCode);
    }

    public function successData($message, $data = [], $statusCode = 200)
    {
        return response()->json(['message' => $message, 'data' => $data, 'code' => $statusCode], $statusCode);
    }

    public function errorResponse($message, int $statusCode = 204)
    {
        return response()->json(['message' => $message, 'code' => $statusCode], $statusCode);
    }

    public function errorData($message, $statusCode = 500)
    {
        return response()->json(['message' => $message, 'code' => $statusCode], $statusCode);
    }
}
