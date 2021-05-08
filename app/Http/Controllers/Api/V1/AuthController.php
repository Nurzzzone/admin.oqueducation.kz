<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StudentsResource;
use App\Http\Resources\TeachersResource;
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
                $user = Auth::user();
                return $this->respondWithToken($token, $user);
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
    protected function respondWithToken($token, $user = null)
    {
        if (Auth::getDefaultDriver() == 'api') {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
            ]);
        }

        switch($user->type->name) {
            case 'teacher':
                $user_data = ['user_data' => (new TeachersResource($user->teacher))];
                break;
            case 'student':
                $user_data = ['user_data' => (new StudentsResource($user->student))];
                break;
        }

        return response()->json(array_merge([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user_type' => $user->type->name,
        ], $user_data));
    }

    protected function respondWithError()
    {
       return response()->json(['error' => 'Unauthorized', 'code' => 401], 401);
    }
}