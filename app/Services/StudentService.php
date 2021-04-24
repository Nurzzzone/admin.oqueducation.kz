<?php

namespace App\Services;

use App\Models\Student;
use App\Services\Service;
use App\Models\StudentParent;
use Illuminate\Support\Facades\DB;

class StudentService extends Service
{
  /**
   * Create new student
   * 
   * @return void
   */
  public function createStudent($data): void
  {
    $student = Student::make($data);
    $parent = $student->parent()->create($data);
    $student->fill(['parent_id' => $parent->id]);
    $student->save();
  }

  /**
   * Update existing student
   * 
   * @return void
   */
  public function updateStudent($data, $id): void
  {
    $student = Student::findOrFail($id);
    $student->fill($data);
    $student->save();
  }

  /**
   * Delete existing student
   * 
   * @return void
   */
  public function deleteStudent($id): void
  {
    $student = Student::findOrFail($id);
    $student->delete();
  }
}