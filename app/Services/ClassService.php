<?php

namespace App\Services;

use App\Models\Classes;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class ClassService extends Service
{

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
    foreach ($questions as $questionKey => $question) {
      foreach ($questions[$questionKey]['answers'] as $answerKey => $answers) {
        $question = $class->questions()->create($questions[$questionKey]);
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
        $question = $class->questions()->find($questionValue['id'])->update($questions[$questionKey]);
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
        $class->questions->find($oldQuestion['id'])->delete();
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
        $question->answers->find($answer['id'])->update($answer);
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

    foreach ($data['tasks'] as $taskKey => $task) {
      if ($task['id'] !== null) {
        $class->hometasks->tasks()->find($task['id'])->update($data['tasks'][$taskKey]);
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
    });
  }
}