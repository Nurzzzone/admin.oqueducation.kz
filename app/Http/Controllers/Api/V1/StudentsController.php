<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentParent;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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
        $data = $request->validated();
        $student = Student::create([
            'name'          => $data['name'],
            'surname'       => $data['surname'], 
            'middle_name'   => $data['middle_name'],
            'email_address' => $data['email_address'],
            'home_address'  => $data['home_address'],
            'phone_number'  => $data['phone_number'],
            'birth_date'    => $data['birth_date'],
            'image'         => $data['image'],
            'password'      => $data['password'],
            'type_id'       => $data['type'],
            'city'          => $data['city']
        ]);
        $parent = $student->parent()->create([
            'p1_full_name'    => $data['p1_full_name'], 
            'p1_phone_number' => $data['p1_phone_number'],
            'p2_full_name'    => $data['p2_full_name'],
            'p2_phone_number' => $data['p2_phone_number']
        ]);
 
        $student->fill([
            'parent_id' => $parent->id,
        ]);
        $student->save();

        return response(['message' => 'регистрация прошла успешно', 'status' => 201])->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return (new StudentsResource($student))
                                ->response()
                                ->setEncodingOptions(JSON_PRETTY_PRINT);
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
        $student = Student::findOrFail($id);
        $student->fill([
            'name'          => $data['name'],
            'surname'       => $data['surname'], 
            'middle_name'   => $data['middle_name'],
            'email_address' => $data['email_address'],
            'home_address'  => $data['home_address'],
            'phone_number'  => $data['phone_number'],
            'birth_date'    => $data['birth_date'],
            'image'         => $data['image'],
            'password'      => $data['password'],
            'type_id'       => $data['type'],
            'city'          => $data['city']
        ]);
        // if (!is_null($data['p1_full_name']) || !is_null($data['p1_phone_number']) || !is_null($data['p2_full_name']) || !is_null($data['p2_phone_number'])) {
        //     $parent = $student->parent()->fill([
        //         'p1_full_name'    => $data['p1_full_name'], 
        //         'p1_phone_number' => $data['p1_phone_number'],
        //         'p2_full_name'    => $data['p2_full_name'],
        //         'p2_phone_number' => $data['p2_phone_number']
        //     ]);
        //     $parent->save();
        // }
        $student->save();

        return (new StudentsResource($student))
                            ->response()
                            ->setStatusCode(Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if ($student->delete()) {
            return response(['message' => 'пользователь успешно удален', 'status' => 204])->setStatusCode(204);
        }
    }
}
