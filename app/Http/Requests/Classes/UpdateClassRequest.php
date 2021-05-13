<?php

namespace App\Http\Requests\Classes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                             => 'sometimes|string|max:255',
            'source_url'                        => 'sometimes|string|max:255|url',
            'type_id'                           => 'sometimes|digits_between:1,3',
            'is_active'                         => 'sometimes|boolean',
            'hometask'                          => 'sometimes|string|max:255',
            'teacher_id'                        => 'nullable|numeric',
            'subject_id'                        => 'nullable|numeric',
            'questions.*.id'                    => 'nullable|numeric',
            'questions.*.name'                  => 'nullable|string|max:255',
            'questions.*.image'                 => 'nullable',
            'questions.*.answers.*.id'          => 'nullable|numeric',
            'questions.*.answers.*.name'        => 'nullable|string|max:255',
            'questions.*.answers.*.image'       => 'nullable',
            'questions.*.answers.*.is_correct.*'=> 'sometimes|boolean',
            'tasks.*.id'                        => 'nullable|numeric',
            'tasks.*.name'                      => 'nullable|string|max:4000',
            'tasks.*.hint'                      => 'nullable|string|max:255',
            'tasks.*.image'                     => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp'
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    public function validated()
    {
        $request = $this->validator->validated();
        
        if ($this->has('tasks')) {
            foreach($this->tasks as $taskKey => $task) {
                if ($task['name'] === null) {
                    unset($request['tasks'][$taskKey]);
                }
            }
        }

        if ($this->has('questions')) {
            foreach($this->questions as $questionKey => $question) {
                if ($question['name'] === null) {
                    unset($request['questions'][$questionKey]);
                }
            }
        }

        if ($this->has('hometask') && $this->filled('hometask')) {
            $request['hometask'] = ['name' => $this->hometask];
            foreach ($request['tasks'] as $taskKey => $task) {
                $request['hometask']['tasks'][$taskKey] = $task;
            }
            unset($request['tasks']);
        }
        
        return $request;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('type'))
            switch ($this->type) {
                case "БИЛ":
                    $this->merge(['type_id' => 1]);
                    break;
                case "НИШ":
                    $this->merge(['type_id' => 2]);
                    break;
                case "ЕНТ":
                    $this->merge(['type_id' => 3]);
                    break;
            }
    }
}
