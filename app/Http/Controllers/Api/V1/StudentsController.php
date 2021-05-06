<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentsResource;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Requests\Student\UpdateStudentParentRequest;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentsController extends Controller
{
    protected $service;

    public function __construct(StudentService $studentService)
    {
        $this->service = $studentService;
        Auth::setDefaultDriver('student');
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
     * @param \App\Http\Requests\Student\UpdateStudentRequest
     * @param \App\Http\Requests\Student\UpdateStudentParentRequest
     * @param \App\Models\Student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $studentRequest, UpdateStudentParentRequest $parentRequest, Student $student)
    {
        try {
            $data = array_merge($studentRequest->validated(), $parentRequest->validated());
            $this->service->updateStudent($data, $student);
        } catch (\Exception $exception) {
            return response()->json([
                // remove comment on development to see error message
                'message'=> $exception->getMessage(),
                'error' => 'internal server error', 
                'code' => 500
            ]);
        } 

        return response(['message' => 'пользователь успешно обновлен', 'code' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            $this->service->deleteStudent($student);
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
