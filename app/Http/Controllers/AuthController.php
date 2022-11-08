<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            Cache::put('access_token', $token, );
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function me()
    {
        return response()->json($this->guard()->user());
    }


    public function logout()
    {
        $this->guard()->logout();
        Cache::forget('access_token');

        return response()->json(['message' => 'Sucesso ao deslogar']);
    }


    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
