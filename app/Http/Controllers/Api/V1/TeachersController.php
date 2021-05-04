<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TeachersResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeachersController extends Controller
{
    public function __construct()
    {
        Auth::setDefaultDriver('teacher');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (TeachersResource::collection(Teacher::all()))
                                ->response()
                                ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['phone_number', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized', 'code' => 401], 401);
        }

        $ttl = Auth::factory()->setTTL(43800);
        return response()->json([
            'access_token' => $token,
            'message' => 'Authorization succesfully passed',
            'expires_in' => 43800 * 60 // one month
        ], 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        try {
            $teacher = (new TeachersResource($teacher))
                ->response()
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        } catch (ModelNotFoundException $exception) {
            $this->response->errorNotFound();
        }
        return $teacher;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
