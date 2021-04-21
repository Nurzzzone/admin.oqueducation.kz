<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsParentsRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentsRequest;
use App\Http\Resources\StudentsResource;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json('hello');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StudentsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $studentRequest, StudentsParentsRequest $parentRequest)
    {
        return (new StudentsResource(Student::create($studentRequest->validated())))
                            ->response()
                            ->setStatusCode(Response::HTTP_CREATED);
        // return response()->json($data, 200, [], JSON_PRETTY_PRINT);
        // return (new StudentsResource(Student::create($request->validated())))
        //             ->response()
        //             ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
