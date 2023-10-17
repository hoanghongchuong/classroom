<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse($code, $message, $data, $status_code, $time_update = null)
    {
        $array = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        if ($time_update != null) {
            $array['time_update'] = $time_update;
        }
        return response()->json($array, $status_code);
    }

    protected function errorResponse($code, $message = null, $statusCode) {
        $array = array(
            'code' => $code,
            'message' => $message,
        );
        return response()->json($array, $statusCode);
    }
}
