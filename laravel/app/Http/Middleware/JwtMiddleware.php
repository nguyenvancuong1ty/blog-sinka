<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Controller;
use Closure;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware extends Controller
{
    public function handle($request, Closure $next)
    {
    try {
        $token = $request->bearerToken();
        if (!$token) {
            return $this->sendResponseError([
                'errors' => 'Token not provided', 
                'message' => 'Token not provided', 
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        if (!JWTAuth::setToken($token)->authenticate()) {
            return $this->sendResponseError([
                'errors' => 'Unauthorized', 
                'message' => 'Unauthorized', 
                'status' => Response::HTTP_UNAUTHORIZED
            ]);
        }

    } catch (\Exception $e) {
            return $this->sendResponseError([
                'errors' => 'Unauthorized', 
                'message' => 'Unauthorized', 
                'status' => Response::HTTP_UNAUTHORIZED
            ]);
    }

    return $next($request);
}

}

