<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\CreateStudentParentRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientAuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['phone_number', 'password']);
        $ttl = ['exp' => \Carbon\Carbon::now()->addDays(7)->timestamp];

        if (!$token = JWTAuth::guard('client')->attempt($credentials, $ttl)){
            return response()->json(['error' => 'Unauthorized', 'code' => 401], 401);
        }

        return response()->json([
            'access_token' => $token,
        ], 202);
    }

    /**
     * Register a new user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(CreateStudentRequest $studentRequest, CreateStudentParentRequest $parentRequest)
    {
        try {
            $data = array_merge($studentRequest->validated(), $parentRequest->validated());
            $this->service->createStudent($data);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    // remove the comment on development to see error message
                    'message'=> $exception->getMessage(),
                    // remove the comment on production to see message
                    // 'message' => 'Whoops, looks like something went wrong',
                    'error' => 'internal server error', 
                    'code' => 500
                ]
            );
        }
        return response(['message' => 'регистрация прошла успешно', 'code' => 201])
             ->setStatusCode(Response::HTTP_CREATED);
    }
}
