<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Teacher\CreateTeacherRequest;
use App\Http\Requests\Teacher\UpdateTeacherRequest;

class TeachersController extends Controller
{
    protected $upload_path;

    public function __construct()
    {
        $this->upload_path = 'images'.DIRECTORY_SEPARATOR.'teachers'.DIRECTORY_SEPARATOR;
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
        DB::beginTransaction();
        try {
            $teacher = Teacher::make($request->validated());
            if ($request->has('image')) 
                if ($request->image !== null)
                    $teacher->fill([
                        'image' => $this->uploadImage($request)
                    ]);
            $teacher->save();
            foreach ($request->validated()['job_history'] as $job) {
                $teacherJobHistory = $teacher->jobHistory()->create($job);
            }
            $teacherSocials = $teacher->socials()->create($request->validated());
            DB::commit();
            // dd(['message' => 'teacher created successfully']);
        } catch(\Exception $exception) {
            DB::rollBack();
            // Schema::disableForeignKeyConstraints();
            // DB::table('teachers')->truncate();
            // DB::table('teachers_jhistory')->truncate();
            // DB::table('teachers_socials')->truncate();
            // Schema::enableForeignKeyConstraints();
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
        DB::beginTransaction();
        try {
            if ($teacher) {
                $data = $request->validated();
                if ($data['new_password'] !== null && $data['old_password'] !== null) {
                    dd('Запрос на изменение пароля находится в разработке');
                }
                $teacher = Teacher::findOrFail($teacher->id);
                $teacher->update($data);

                // if ($data['image'] !== null) {
                //     $this->uploadImage($data['image']);
                //     if ($teacher->image !== null) $this->deleteImage($teacher->image);
                // }
                $teacher->socials()->update([
                    'facebook_url' => $data['facebook_url'],
                    'instagram_url' => $data['instagram_url'],
                ]);

                if (count($data['job_history']) > $teacher->jobHistory()->count()) {
                    $jobsArr = array_diff(array_keys($data['job_history']), array_keys($teacher->jobHistory()->get()->toArray()));
                    $jobs = [];
                    foreach ($jobsArr as $job) {
                        $jobs[] = collect($data['job_history'])->filter(function($value, $key) use($job) {
                            return $key == $job;
                        })->toArray();
                    }
                    foreach ($jobs as $job) {
                        foreach ($job as $job) {
                            $teacherJobHistory = $teacher->jobHistory()->create($job);
                        }
                    }
                } elseif (count($data['job_history']) < $teacher->jobHistory()->count()) {
                    $jobsArr = array_diff(array_keys($teacher->jobHistory()->get()->toArray()), array_keys($data['job_history']));
                    $jobs = [];
                    foreach ($jobsArr as $job) {
                        $jobs[] = $teacher->jobHistory()->get()->filter(function($value, $key) use($job) {
                            return $key == $job;
                        })->toArray();
                    }
                    foreach ($jobs as $job) {
                        foreach ($job as $job) {
                            Schema::disableForeignKeyConstraints();
                            $teacherJobHistory = $teacher->jobHistory()->where('id', '=', $job['id'])->delete();
                            Schema::enableForeignKeyConstraints();
                        }
                    }
                }

                foreach ($data['job_history'] as $job) {
                    if ($job['id'] !== null) {
                        $teacher->jobHistory()->where('id', '=', $job['id'])->update($job);
                    }
                }

                DB::commit();
                dd('successfully updated');
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
            if ($teacher->image !== null) $this->deleteImage($teacher->image);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()->route('teachers.index');
    }

    private function uploadImage($request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $file_extension = $file->getClientOriginalExtension();
                $file_name = 'IMG_'.date('Ymd').'_'.time().'.'.$file_extension;
                $file->move(public_path($this->upload_path), $file_name);
                return $file_name;
            }
        } else {
            return null;
        }
    }

    private function deleteImage($file_name)
    {
        $file = public_path($this->upload_path . $file_name);
        if (File::exists($file) || !is_null($file_name)) {
            unlink($file);
            return true;
        } else {
            return null;
        }
    }
}
