<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate(10);
        $params = array_merge(['teachers' => $teachers], $this->getPageBreadcrumbs(['pages.teachers']));
        return view('pages.teachers.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacher = new Teacher();
        $params = array_merge(['teacher' => $teacher], $this->getPageBreadcrumbs(['pages.teachers', 'buttons.create']));
        return view('pages.teachers.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TeachersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeachersRequest $request)
    {
        $teacher = new Teacher();
        if ($teacher->save()) {
            return redirect()
                    ->route('teachers.index');
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
        $teacher = Teacher::findOrFail($id);
        $teacherFullName = $teacher->name .' '. $teacher->surname;
        $params = array_merge(['teacher' => $teacher], $this->getPageBreadcrumbs(['pages.teachers'], $teacherFullName));
        return view('pages.students.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $params = array_merge(['teacher' => $teacher], $this->getPageBreadcrumbs(['locale.teachers']));
        return view('pages.students.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeachersRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeachersRequest $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        if ($teacher->delete()) {
            return redirect()
                    ->route('teachers.index');
        }
    }
}
