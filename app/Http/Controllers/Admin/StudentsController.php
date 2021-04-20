<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsRequest;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        $params = array_merge(['students' => $students], $this->getPageBreadcrumbs(['pages.students']));
        return view('pages.students.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = new Student();
        $params = array_merge(['student' => $student], $this->getPageBreadcrumbs(['pages.students']));
        return view('pages.students.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StudentsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $request)
    {
        $student = new Student();
        if ($student->save()) {
            return redirect()
                    ->route('students.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $params = array_merge(['student' => $student], $this->getPageBreadcrumbs(['pages.students']));
        return view('pages.students.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $params = array_merge(['student' => $student], $this->getPageBreadcrumbs(['pages.students']));
        return view('pages.students.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StudentsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentsRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        if ($student->save()) {
            return redirect()
                    ->route('students.index');
        }
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
            return redirect()
                    ->route('students.index');
        }
    }
}
