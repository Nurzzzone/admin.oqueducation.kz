<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\V1\Controller;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if ($request->has('email') && $request->filled('email')) {
            $credentials = $request->only(['email', 'password']);
            Auth::setDefaultDriver('api');

            if (!$token = Auth::attempt($credentials)) {
                return $this->respondWithError();
            }
            return $this->respondWithToken($token);
        }

        if ($request->has('phone_number') && $request->filled('phone_number')) {

            $credentials = $request->only(['phone_number', 'password']);

            Auth::setDefaultDriver('client');

            if ($token = Auth::attempt($credentials)) {
                return $this->respondWithToken($token);
            }
            return $this->respondWithError();

        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        if (Auth::getDefaultDriver() == 'api') {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
            ]);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'type' => Auth::user()->type->name,
        ]);
    }

    protected function respondWithError()
    {
       return response()->json(['error' => 'Unauthorized', 'code' => 401], 401);
    }
}