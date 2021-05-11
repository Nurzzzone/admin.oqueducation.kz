<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ClassService extends Service
{
  protected $upload_path;
  protected $file_subdirs;

  public function __construct()
  {
    $this->upload_path = 'images'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR;
    $this->file_subdirs = ['questins', 'answers', 'tasks'];
  }

  public function prepareForHTML()
  {
    $subjects = Subject::all()->toArray();
    $teachers = Teacher::all()->map(function($item) {
        $fullNameArray = $item->only('name', 'surname', ('middle_name' ?? null));
        return ['id' => $item['id'], 'full_name' => trim(implode(' ', $fullNameArray))];
    })->toArray();
    
    return [
      'subjects' => $subjects,
      'teachers' => $teachers
    ];
  }

  /**
   * Create new class
   * 
   * @return void
   */
  public function createClass($data): void
  {
    DB::beginTransaction();
    try {
      $class = Classes::create($data);
      $this->createQuestions($data['questions'], $class);
      $this->createHometask($data['hometask'], $class);
      DB::commit();
    } catch(\Exception $exception) {
      DB::rollBack();
      dd(['message' => $exception->getMessage()]);
    }
  }

  /**
   * Create class questions
   * 
   * @return void
   */
  private function createQuestions($questions, $class): void
  {
    foreach ($questions as $questionKey => $questionValue) {
      // save question image
      if (array_key_exists('image', $questionValue)) {
        if ($questionValue['image'] !== null && is_file($questionValue['image'])) {
          $questions[$questionKey]['image'] = $this->uploadImage($questionValue['image'], 'questions');
        }
      }
      // save question
      $question = $class->questions()->create($questions[$questionKey]);
      
      foreach ($questions[$questionKey]['answers'] as $answerKey => $answer) {
        // save answer image
        if (array_key_exists('image', $answer)) {
          if ($answer['image'] !== null && is_file($answer['image'])) {
            $questions[$questionKey]['answers'][$answerKey]['image'] = $this->uploadImage($answer['image'], 'answers');
            sleep(1); // unless will create one image
          }
        }

        if (isset($questions[$questionKey]['answers'][$answerKey]['is_correct']))
          foreach ($questions[$questionKey]['answers'][$answerKey]['is_correct'] as $is_correct) {
            $questions[$questionKey]['answers'][$answerKey]['is_correct'] = true;
          }
        else
          $questions[$questionKey]['answers'][$answerKey]['is_correct'] = false;

        $question->answers()->create($questions[$questionKey]['answers'][$answerKey]);
      }
    }
  }

  /**
   * Create class hometasks
   * 
   * @return void
   */
  private function createHometask($data, $class): void
  {
    $hometask = $class->hometasks()->create($data);

    if ($data['tasks'] !== null && !empty($data['tasks'])) {
      foreach ($data['tasks'] as $taskKey => $task) {
        if (array_key_exists('image', $task)) {
          if ($task['image'] !== null && is_file($task['image'])) {
            $data['tasks'][$taskKey]['image'] = $this->uploadImage($task['image'], 'tasks');
            sleep(1); // unless will create one image
          }
        }

        $hometask->tasks()->create($data['tasks'][$taskKey]);
      }
    }
  }

  /**
   * Update class
   * 
   * @return void
   */
  public function updateClass($data, $class): void
  {
    DB::beginTransaction();
    try {
      $class->update($data);
      $this->updateQuestions($data['questions'], $class);
      $this->updateHometask($data['hometask'], $class);
      DB::commit();
    } catch(\Exception $exception) {
      dd(['message' => $exception->getMessage()]);
      DB::rollback();
    }
  }

  /**
   * Update class questions
   * 
   * @return void
   */
  private function updateQuestions($questions, $class): void
  {
    if (count($questions) > $class->questions->count()) { // create new question
      $this->updateWithNewQuestions($questions, $class);
    } elseif (count($questions) < $class->questions->count()) { // delete old question
      $this->updateWithoutOldQuestions($questions, $class);
    }
    
    foreach ($questions as $questionKey => $questionValue) { // update existing questions
      if ($questionValue['id'] !== null) {
        $question = $class->questions()->find($questionValue['id']);
        
        // update question image
        if (isset($questions[$questionKey]['image'])) {
          if ($questions[$questionKey]['image'] !== null) {
            $questions[$questionKey]['image'] = $this->uploadImage($questions[$questionKey]['image'], 'questions');

            if ($question->image !== null) {
              $this->deleteImage($question->image, 'questions');
            }
          }
        }
        $question->update($questions[$questionKey]);
        
        foreach ($questions[$questionKey]['answers'] as $answerKey => $answer) {
          $this->updateAnswers($questions[$questionKey]['answers'], $class->questions->find($questionValue['id']));
        }
      }
    }
  }

  /**
   * Create new questiosn on update
   * 
   * @return void
   */
  private function updateWithNewQuestions($questions, $class): void
  {
    if (!empty($questions) && $questions !== null) {
      $newQuestionsKeys = array_diff(array_keys($questions), array_keys($class->questions->toArray()));
      foreach ($newQuestionsKeys as $newQuestionsKey) {
        $newQuestions = collect($questions)->filter(function($value, $key) use($newQuestionsKey) {
            return $key == $newQuestionsKey;
        })->toArray();
      }
      $this->createQuestions($newQuestions, $class);
    }
  }

  /**
   * Delete old question on update
   * 
   * @return void
   */
  private function updateWithoutOldQuestions($questions, $class): void
  {
    if (!empty($questions) && $questions !== null) {
      $oldQuestionsKeys = array_diff(array_keys($class->questions->toArray()), array_keys($questions));
      foreach ($oldQuestionsKeys as $oldQuestionKey) {
        $oldQuestions = $class->questions->filter(function($value, $key) use ($oldQuestionKey) {
          return $key == $oldQuestionKey;
        })->toArray();
      }
      foreach ($oldQuestions as $oldQuestion) {
        $question = $class->questions->find($oldQuestion['id']);
        if ($question->image !== null) {
          $this->deleteImage($question->image, 'questions');
        }
        $questions->delete();
      }
    }
  }

  /**
   * Update answers
   * 
   * @return void
   */
  private function updateAnswers($answers, $question): void
  {
    if (count($answers) > $question->answers()->count()) {
      $this->updateWithNewAnswers($answers, $question);
    } elseif (count($answers) < $question->answers()->count()) {
      $this->updateWithoutOldAnswers($answers, $question);
    }


    foreach ($answers as $answerKey => $answer) {
      if ($answer['id'] !== null) {
        $ans = $question->answers->find($answer['id']);

        // update answer image
        if (isset($answer['image']) && $answer['image'] !== null) {
          $answer['image'] = $this->uploadImage($answer['image'], 'answers');

          if ($ans->image !== null) {
            $this->deleteImage($ans->image, 'answers');
          }
        }

        if (isset($answer['is_correct']))
          foreach ($answer['is_correct'] as $is_correct) {
            $answer['is_correct'] = true;
          }
        else
          $answer['is_correct'] = false;

        $ans->update($answer);
      }
    }
  }

  /**
   * Create new answer on update
   * 
   * @return void
   */
  private function updateWithNewAnswers($answers, $question): void
  {
    if (!empty($answers) && $answers !== null) {
      $newAnswersKeys = array_diff(array_keys($answers), array_keys($question->answers->toArray()));
      foreach ($newAnswersKeys as $newAnswersKey) {
        $newAnswers = collect($answers)->filter(function($value, $key) use($newAnswersKey) {
          return $key == $newAnswersKey;
        })->toArray();
      }
      foreach ($newAnswers as $newAnswer) {
        if (isset($newAnswer['is_correct'])) {
          foreach ($newAnswer['is_correct'] as $is_correct) {
            $newAnswer['is_correct'] = true;
          }
        }
        else {
          $newAnswer['is_correct'] = false;
        }

        $question->answers()->create($newAnswer);
      }
    }
  }

  /**
   * Delete answer on update
   * 
   * @return void
   */
  private function updateWithoutOldAnswers($answers, $question): void
  {
    if (!empty($answers) && $answers !== null) {
      $oldAnswersKeys = array_diff(array_keys($question->answers->toArray()), array_keys($answers));
      foreach ($oldAnswersKeys as $oldAnswersKey) {
        $oldAnswers = $question->answers->filter(function($value, $key) use($oldAnswersKey) {
            return $key == $oldAnswersKey;
        })->toArray();
      }
      foreach ($oldAnswers as $oldAnswer) {
        $question->answers()->find($oldAnswer['id'])->delete();
      }
    }
  }

  /**
   * Update class hometasks
   * 
   * @return void
   */
  private function updateHometask($data, $class): void
  {
    $hometask = $class->hometasks->update($data);
    if (count($data['tasks']) > $class->hometasks->tasks->count()) { // create new task
      $this->updateWithNewTask($data['tasks'], $class->hometasks);
    } elseif (count($data['tasks']) < $class->hometasks->tasks->count()) { // delete old task
      $this->updateWithoutOldTask($data['tasks'], $class->hometasks);
    }

    // update tasks
    foreach ($data['tasks'] as $taskKey => $taskValue) {
      if ($taskValue['id'] !== null) {
        $task = $class->hometasks->tasks()->find($taskValue['id']);
        
        // update task image
        if (isset($task['image']) && $task['image'] !== null) {
          $data['tasks'][$taskKey]['image'] = $this->uploadImage($taskValue['image'], 'tasks');

          if ($task->image !== null) {
            $this->deleteImage($task->image, 'tasks');
          }
        }

        $task->update($data['tasks'][$taskKey]);
      }
    }
  }

  /**
   * Update class hometasks
   * 
   * @return void
   */
  private function updateWithNewTask($tasks, $hometask): void
  {
    if (!empty($tasks) && $tasks !== null) {
      $newTasksKeys = array_diff(array_keys($tasks), array_keys($hometask->tasks->toArray()));
      foreach ($newTasksKeys as $newTaksKey) {
        $newTasks = collect($tasks)->filter(function($value, $key) use($newTaksKey) {
            return $key == $newTaksKey;
        })->toArray();
      }
      foreach ($newTasks as $newTask) {
        $hometask->tasks()->create($newTask);
      }
    }
  }

  /**
   * Delete old task on update
   * 
   * @return void
   */
  private function updateWithoutOldTask($tasks, $hometask): void
  {
    if (!empty($tasks) && $tasks !== null) {
      $oldTasksKeys = array_diff(array_keys($hometask->tasks->toArray()), array_keys($tasks));
      foreach ($oldTasksKeys as $oldTasksKey) {
        $oldTasks = $hometask->tasks->filter(function($value, $key) use($oldTasksKey) {
            return $key == $oldTasksKey;
        })->toArray();
      }
      foreach ($oldTasks as $oldTask) {
        $hometask->tasks->find($oldTask['id'])->delete();
      }
    }
  }

  /**
   * Delete class
   * 
   * @return void
   */
  public function deleteClass($class): void
  {
    DB::transaction(function () use ($class) {
      $class->delete();

      // delete question image
      if ($class->questions->isNotEmpty()) {
        foreach ($class->questions as $question) {
          $this->deleteImage($question->image, 'questions');

          // delete answer image
          if ($question->answers->isNotEmpty()) {
            foreach ($question->answers as $answer) {
              $this->deleteImage($answer->image, 'answers');
            }
          }
        }
      }

      // delete task image
      if ($class->hometasks->tasks->isNotEmpty()) {
        foreach ($class->hometasks->tasks as $task) {
          $this->deleteImage($task->image, 'tasks');
        }
      }
    });
  }

  /**
   * Upload image
   * 
   */
  private function uploadImage($file, $subdir)
  {
    if ($file !== null && is_file($file)) {
      $upload_path = $this->upload_path . $subdir.DIRECTORY_SEPARATOR;
      $file_extension = $file->getClientOriginalExtension();
      $file_name = 'IMG_'.date('Ymd').'_'.time().'.'.$file_extension;
      $file->move(public_path($upload_path), $file_name);
      return $file_name;
    }
  }

  /**
   * Delete image
   * 
   */
  private function deleteImage($file_name, $subdir)
  {
    if ($file_name !== null) {
      $file_path = $this->upload_path . $subdir.DIRECTORY_SEPARATOR;
      $file = public_path($file_path . $file_name);

      if (File::exists($file)) {
        unlink($file);
        return true;
      }
      return false;
    }
  }
}