<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

abstract class Controller
{
    public function sendResponseSuccess(array|Collection $data = [], string $message = 'response', $code = 200) {
        $res = [
            'message'   => $message,
            'data'      => $data,
        ];
        return response()->json($res, $code);
    }

    public function sendResponseError($message = "", $errors = '',  $code = Response::HTTP_INTERNAL_SERVER_ERROR) {
        return response()->json( [
            "error" => $errors,
            "message" => $message,
            "status" => $code
        ]);
    }
}
