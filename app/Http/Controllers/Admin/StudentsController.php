<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Student;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Student\CreateStudentParentRequest;
use App\Http\Requests\Student\UpdateStudentParentRequest;

class StudentsController extends Controller
{

    protected $upload_path;

    public function __construct()
    {
      $this->upload_path = 'images'.DIRECTORY_SEPARATOR.'students'.DIRECTORY_SEPARATOR;
    }
  

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
    public function store(CreateStudentRequest $studentRequest, CreateStudentParentRequest $parentRequest)
    {
        try {
            $data = array_merge($studentRequest->validated(), $parentRequest->validated());
            $student = Student::make($data);
            $student->fill([
                'image' => $studentRequest->image !== null ? $this->uploadImage($studentRequest): null
            ])->save();
            $parent = $student->parent()->make($data);
            $parent->fill([
                'student_id' => $student->id
            ])->save();
        } catch (\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
                ->route('students.index');
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
            $params = array_merge(['student' => $student], $this->getPageBreadcrumbs(['pages.students']));
        } catch (ModelNotFoundException $exception) {
            $this->response->errorNotFound();
        }
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
    public function update(UpdateStudentRequest $studentRequest, UpdateStudentParentRequest $parentRequest, Student $student)
    {
        try {
            $data = array_merge($studentRequest->validated(), $parentRequest->validated());
            if (isset($data['image']) && $data['image'] !== null) {
                $data['image' ] = $this->uploadImage($studentRequest);
                if ($student->image !== null) $this->deleteImage($student->image);
            }
            $student->update($data);
            $student->parent()->update($parentRequest->validated());
        } catch (\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
                ->route('students.index');
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
            if ($student->delete() && $student->image !== null) {
                $this->deleteImage($student->image);
            }
        } catch (ModelNotFoundException $exception) {
            $this->response->errorNotFound();
        }
        return redirect()
            ->route('students.index');
    }

      /**
   * Upload image
   * 
   * @return string|null
   */
  private function uploadImage($request)
  {
      if ($request->has('image') && $request->hasFile('image')) {
          if ($request->image !== null && $request->file('image')->isValid()) {
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

  /**
   * Delete old image
   * 
   * @param string $file_name
   * @return bool
   */
  private function deleteImage($file_name): bool
  {
      $file = public_path($this->upload_path . $file_name);
      if (File::exists($file) && $file_name !== null) {
          unlink($file);
          return true;
      } else {
          return null;
      }
  }
}
