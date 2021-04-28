<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Teacher\CreateTeacherRequest;
use App\Http\Requests\Teacher\UpdateTeacherRequest;

class TeachersController extends Controller
{
    protected $service;

    public function __construct(TeacherService $teacherService)
    {
        $this->service = $teacherService;
    }

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
        $jobHistory = $teacher->jobHistory()->get();
        $params = array_merge(['teacher' => $teacher, 'jobHistory' => $jobHistory], $this->getPageBreadcrumbs(['pages.teachers', 'buttons.create']));
        return view('pages.teachers.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TeachersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTeacherRequest $request)
    {
        try {
            $this->service->createTeacher($request);
        } catch(\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('teachers.index');
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
        return view('pages.teachers.show', $params);
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
        $jobHistory = $teacher->jobHistory()->get();
        $params = array_merge(['teacher' => $teacher, 'jobHistory' => $jobHistory], $this->getPageBreadcrumbs(['locale.teachers']));
        return view('pages.teachers.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeachersRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            $jobs = $request->validated()['job_history'];
            $links = [
                'facebook_url' => $request->validated()['facebook_url'],
                'instagram_url' => $request->validated()['instagram_url'],
            ];
            $this->service->updateTeacher($request, $teacher, $jobs, $links);
        } catch (\Exception $exception) {
            dd(['message'=> $exception->getMessage()]);
        }
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $this->service->deleteTeacher($teacher);
        } catch (\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()->route('teachers.index');
    }
}
