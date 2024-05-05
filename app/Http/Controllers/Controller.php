<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function defaultMassageSuccess($message){
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' =>  $message
        ], 200);
    }


    function respondError($errorCode, $errorMessage): JsonResponse {
        return response()->json([
            "status" => $errorCode,
            "success" => false,
            "error" => $errorMessage
        ], $errorCode);
    }

    function respondSuccess($data = ["message" => "OK"]): JsonResponse {
        return response()->json([
            "status" => 200,
            "success" => true,
            "data" => $data
        ]);
    }

    function logTrxErrors($message, $trace) {
        Log::channel("daily")->error($message);
        Log::channel("daily")->error($trace);
    }

    function respond500($errorMessage = "Terjadi kesalahan pada server, mohon mencoba lagi!"): JsonResponse {
        return $this->respondError(500, $errorMessage);
    }
}
