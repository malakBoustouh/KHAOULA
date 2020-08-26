<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        try {
            $token = \JWTAuth::attempt($credentials);
        } catch (JWTException $exception) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        if (!$token) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return response()->json(compact('token'));

    }

    public function logout()
    {
        \Auth::guard('api')->logout();
        return response()->json([],204);

    }

    public function refreshToken(Request $request)
    {
        $token = \Auth::guard('api')->refresh();
        return ['token' => $token];
    }
}
