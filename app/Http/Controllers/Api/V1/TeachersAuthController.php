<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeachersAuthController extends Controller
{
    public function __construct()
    {
        Auth::setDefaultDriver('teacher');
    }
    
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['phone_number', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized', 'code' => 401], 401);
        }

        Auth::factory()->setTTL(43800);
        return response()->json([
            'access_token' => $token,
            'message' => 'Authorization succesfully passed',
            'expires_in' => 43800 * 60 // one month
        ], 202);
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
}
