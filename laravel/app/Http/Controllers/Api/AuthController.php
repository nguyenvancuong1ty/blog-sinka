<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    

    public function login(AuthRequest $request ) : JsonResponse {
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        Log::info("TOKEN.$token.");
        if (!$token ) {
            return $this->sendResponseError(['error' => 'Credentials incorrect', 'status' => 401]);
        }
        return $this->sendResponseSuccess(
            ['data' => 
                ['access_token' => $token, 
                 'token_type'=> 'bearer',
                 'expires_in'=> JWTAuth::factory()->getTTL() * 60]
            ]);
    }

    public function register(AuthRequest $request) : JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['email'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = JWTAuth::attempt($validatedData);

        if (!$token) {
            return $this->sendResponseError(['error' => 'Registration failed', 'status' => 500]);
        }

        return $this->sendResponseSuccess(['data' => [$token]]);
    }


    public function logout()
    {
        auth()->logout();
         return $this->sendResponseSuccess();
    }
}
