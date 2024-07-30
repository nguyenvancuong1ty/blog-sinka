<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

abstract class Controller
{
    public function sendResponseSuccess(array | Collection $options = []) {
        $default = [
            'message'   => "success",
            'status' => 200,
            'data' => [],
        ];
        $res = array_merge($default, $options);
        return response()->json($res);
    }

    public function sendResponseError(array | Collection $options = []) {
        $default = [
            'message'   => "error",
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'error' => [],
        ];
        $res = array_merge($default, $options);
        return response()->json($res);
    }
}
