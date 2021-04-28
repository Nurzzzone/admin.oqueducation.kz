<?php

namespace App\Services;

use App\Models\Student;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\Boolean;

class StudentService extends Service
{
  /**
   * Create new student
   * 
   * @return void
   */
  public function createStudent($data): void
  {
      $student = Student::create($data);
      $parent = $student->parent()->make($data);
      $parent->fill(['student_id' => $student->id]);
      $parent->save();
  }

  /**
   * Update existing student
   * 
   * @return void
   */
  public function updateStudent($data, $student): void
  {
    // $student->fill($data)->save();
    // $parent = $student->parent()->fill($data);
    // $parent->save();
  }

  /**
   * Delete existing student
   * 
   * @return bool
   */
  public function deleteStudent($student): bool
  {
    if ($student->delete()) {
      return true;
    }
    return false;
  }
}