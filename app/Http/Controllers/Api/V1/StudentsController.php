<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dotenv\Exception\ValidationException;
use App\Models\Student;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentsResource;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\CreateStudentParentRequest;
use App\Http\Requests\Student\UpdateStudentParentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;

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
     * @param  \App\Http\Requests\Student\CreateStudentRequest  $studentRequest
     * @param  \App\Http\Requests\Student\CreateStudentParentRequest  $parentRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudentRequest $studentRequest, CreateStudentParentRequest $parentRequest)
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
        } catch (QueryException $exception) {
            return response()->json([
                // remove comment on development to see error message
                'message'=> $exception->getMessage(),
                'error' => 'internal server error', 
                'code' => 500
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                // remove comment on development to see error message
                'message'=> 'пользователь не найден',
                'error' => 'internal server error', 
                'code' => 500
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message'=> $exception->getMessage(),
                'error' => 'internal server error', 
                'code' => 500
            ]);
        }

        return response(['message' => 'пользователь успешно обновлен', 'code' => 200])->setStatusCode(Response::HTTP_CREATED);
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
