<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    

    public function login(Request $request ) : JsonResponse {
        $validator = Validator::make($request->only('email','password'), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Log::info( trans('auth.failed'));
            return $this->sendResponseError(['message' => trans('auth.failed'),'errors' => $validator->errors()->messages()]);
        }
        
        $credentials = request(['email', 'password']);
        $token = JWTAuth::attempt($credentials);
        if (!$token ) {
            return $this->sendResponseError(['errors' => 'Credentials incorrect', 'message' => 'invalid credential', 'status' => 401]);
        }

        return $this->sendResponseSuccess($this->TokenInfo($token));
    }

    public function register(AuthRequest $request) : JsonResponse
    {
        $user = User::create([
            'name' => $request ->email,
            'email' => $request ->email,
            'password' => bcrypt($request ->password),
        ]);

        $token = JWTAuth::attempt($request->all());

        if (!$token) {
            return $this->sendResponseError(['errors' => 'Registration failed', 'status' => 500]);
        }

        return $this->sendResponseSuccess($this->TokenInfo($token));
    }

    public function me() : JsonResponse
    {
        $data = auth()->user();
        return $this->sendResponseSuccess(['data' => $data]);
    }
    


    public function logout()
    {
        auth()->logout();
         return $this->sendResponseSuccess();
    }

    public static function TokenInfo($token) 
    {
        return 
            ['data' => 
                [
                    'access_token' => $token, 
                    'token_type'=> 'bearer',
                    'expires_in'=> JWTAuth::factory()->getTTL() * 60
                ]
            ];
    }
}
