<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

abstract class Controller
{
    public function sendResponseSuccess(array $options = []) {
        $status = $options['status'] ?? Response::HTTP_OK;
        $default = [
            'message'   => "success",
            'status' => $status,
            'data' => [],
        ];
        $res = array_merge($default, $options);
        return response()->json($res, $status);
    }

    public function sendResponseError(array $options = []) {
        $status = $options['status'] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
        $default = [
            'message'   => "error",
            'status' =>  $status,
            'errors' => [],
        ];
        $res = array_merge($default, $options);
        return response()->json($res, $status);
    }
}
