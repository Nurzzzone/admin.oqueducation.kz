<?php

namespace App\Services;

use App\Models\Teacher;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Teacher\UpdateTeacherRequest;

class TeacherService extends Service
{

  protected $upload_path;

  public function __construct()
  {
    $this->upload_path = 'images'.DIRECTORY_SEPARATOR.'teachers'.DIRECTORY_SEPARATOR;
  }

  /**
   * Create teacher
   * 
   * @return void
   */
  public function createTeacher($request): void
  {
    DB::beginTransaction();
    try {
        $teacher = Teacher::make($request->validated());
        $teacher->fill([
            'image' => $this->uploadImage($request)
        ])->save();
        $teacher->socials()->create($request->validated());
        $this->createTeacherJobHistory($teacher, $request->validated()['job_history']);
        DB::commit();
    } catch(\Exception $exception) {
        DB::rollBack();
        dd(['message' => $exception->getMessage()]);
    }
  }

  /**
   * Update teacher
   * 
   * @return void
   */
  public function updateTeacher($request, $teacher, $jobHistory, $links): void
  {
    DB::beginTransaction();
    try {
      $data = $request->validated();
      if ($data['new_password'] !== null && $data['old_password'] !== null) {
          dd('Запрос на изменение пароля находится в разработке');
      }
      if (isset($data['image']) && $data['image'] !== null) {
          $data['image' ] = $this->uploadImage($request);
          if ($teacher->image !== null) $this->deleteImage($teacher->image);
      }
      $teacher->update($data);
      $teacher->socials()->update($links);
      if (count($jobHistory) > $teacher->jobHistory()->count()) {
        $this->updateWithNewTeacherHistory($jobHistory, $teacher);
      } elseif (count($jobHistory) < $teacher->jobHistory()->count()) {
        $this->updateWithoutOldTeacherHistory($jobHistory, $teacher);
      }
      $this->updateTeacherJobHistory($teacher, $jobHistory);
      DB::commit();
    } catch (\Exception $exception) {
        DB::rollBack();
        dd(['message'=> $exception->getMessage()]);
    }
  }

  /**
   * Delete teacher
   * 
   * @return void
   */
  public function deleteTeacher($teacher): void
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
  }

  /**
   * Create jobs
   * 
   * @return void
   */
  private function createTeacherJobHistory($teacher, $jobs): void
  {
    foreach ($jobs as $job) {
      $teacher->jobHistory()->create($job);
    }
  }

  /**
   * Update jobs
   * 
   * @return void
   */
  private function updateTeacherJobHistory($teacher, $jobs): void
  {
    foreach ($jobs as $job) {
      if ($job['id'] !== null)
        $teacher->jobHistory()->where('id', '=', $job['id'])->update($job);
    }
  }

  /**
   * Add a new job on update
   * 
   * @return void
   */
  private function updateWithNewTeacherHistory($jobHistory, $teacher): void
  {
    $jobsArr = array_diff(array_keys($jobHistory), array_keys($teacher->jobHistory()->get()->toArray()));
    foreach ($jobsArr as $job) {
        $jobs = collect($jobHistory)->filter(function($value, $key) use($job) {
            return $key == $job;
        })->toArray();
    }
    $this->createTeacherJobHistory($teacher, $jobs);
  }

  /**
   * Delete job if it's removed on edit page
   * 
   * @return void
   */
  private function updateWithoutOldTeacherHistory($jobHistory, $teacher): void
  {
    $jobsArr = array_diff(array_keys($teacher->jobHistory()->get()->toArray()), array_keys($jobHistory));
    foreach ($jobsArr as $job) {
        $jobs = $teacher->jobHistory()->get()->filter(function($value, $key) use($job) {
            return $key == $job;
        })->toArray();
    }
    $this->deleteTeacherJobHistory($teacher, $jobs);
  }

  /**
   * Delete all jobs related to teacher
   * 
   * @return void
   */
  private function deleteTeacherJobHistory($teacher, $jobs): void
  {
    foreach ($jobs as $job) {
      Schema::disableForeignKeyConstraints();
      $teacherJobHistory = $teacher->jobHistory()->where('id', '=', $job['id'])->delete();
      Schema::enableForeignKeyConstraints();
    }
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