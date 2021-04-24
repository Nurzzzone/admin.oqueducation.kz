<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentParent;
use Illuminate\Http\Response;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsRequest;
use Illuminate\Database\QueryException;
use App\Http\Resources\StudentsResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Events\QueryExecuted;

class StudentsController extends Controller
{
    protected $service;

    public function __construct(StudentService $studentService)
    {
        $this->service = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (StudentsResource::collection(Student::all()))
                                ->response()
                                ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StudentsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $request)
    {
        try {
            $this->service->createStudent($request->validated());
        } catch (QueryException $exception) {
            return response()->json(
                [
                    // remove comment on development to see error message
                    'message'=> $exception->getMessage(),
                    'error' => 'internal server error', 
                    'code' => 500
                ]
            );
        }
        return response(['message' => 'регистрация прошла успешно', 'code' => 201])
             ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        try {
            $student = (new StudentsResource($student))
                ->response()
                ->setEncodingOptions(JSON_PRETTY_PRINT);
        } catch (ModelNotFoundException $exception) {
            $this->response->errorNotFound();
        }
        return $student;
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
        $data = $request->validated();
        // if (!is_null($data['p1_full_name']) || !is_null($data['p1_phone_number']) || !is_null($data['p2_full_name']) || !is_null($data['p2_phone_number'])) {
        //     $parent = $student->parent()->fill([
        //         'p1_full_name'    => $data['p1_full_name'], 
        //         'p1_phone_number' => $data['p1_phone_number'],
        //         'p2_full_name'    => $data['p2_full_name'],
        //         'p2_phone_number' => $data['p2_phone_number']
        //     ]);
        //     $parent->save();
        // }

        return response(['message' => 'операция прошла успешно', 'code' => 200])->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->deleteStudent($id);
        } catch(QueryException $exception) {
            return response()->json(
                [
                    // remove comment on development to see error message
                    'message'=> $exception->getMessage(),
                    'error' => 'internal server error', 
                    'code' => 500
                ]
            );
        }
        return response(['message' => 'пользователь успешно удален', 'code' => 200])->setStatusCode(200);
    }
}
