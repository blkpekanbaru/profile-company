<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected function senResponse($result, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $result
        ], $code);
    }

    protected function sendError($error, $errorMessage = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessage))
        {
            $response['errors'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}
