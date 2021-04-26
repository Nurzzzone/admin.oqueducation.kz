<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Teacher\CreateTeacherRequest;
use App\Http\Requests\Teacher\UpdateTeacherRequest;
use Exception;

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
    public function store(CreateTeacherRequest $request)
    {
        DB::beginTransaction();
        try {
            $teacher = Teacher::create($request->validated());
            foreach ($request->validated()['job_history'] as $job) {
                $teacherJobHistory = $teacher->jobHistory()->create($job);
            }
            $teacherSocials = $teacher->socials()->create($request->validated());
            DB::commit();
            // dd(['message' => 'teacher created successfully']);
        } catch(\Exception $exception) {
            DB::rollBack();
            Schema::disableForeignKeyConstraints();
            DB::table('teachers')->truncate();
            DB::table('teachers_jhistory')->truncate();
            DB::table('teachers_socials')->truncate();
            Schema::enableForeignKeyConstraints();
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
        dd($request->validated());
        DB::beginTransaction();
        try {
            if ($teacher) {
                $teacher->update([$request->validated()]);
                $teacher->socials()->update($request->validated());
                foreach ($request->validated()['job_title'] as $job) {
                    $teacher->jobHistory()->update($job);
                }
                DB::commit();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $teacher->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()->route('teachers.index');
    }
}
