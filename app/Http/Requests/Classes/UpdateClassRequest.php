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
            'title'                         => 'sometimes|string|max:255',
            'source_url'                    => 'sometimes|string|max:255|url',
            'type_id'                       => 'sometimes|digits_between:1,3',
            'hometask'                      => 'sometimes|string|max:255',
            'questions.*.id'                => 'nullable',
            'questions.*.name'              => 'sometimes|string|max:255',
            'questions.*.image'             => 'nullable',
            'questions.*.answers.*.id'      => 'nullable',
            'questions.*.answers.*.name'    => 'nullable|string|max:255',
            'questions.*.answers.*.image'   => 'nullable',
            'tasks.*.id'                    => 'nullable',
            'tasks.*.name'                  => 'nullable|string|max:255',
            'tasks.*.hint'                  => 'nullable|string|max:255',
            'tasks.*.image'                 => 'nullable'
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
        
        if ($this->has('hometask') && $this->filled('hometask'))
            $request['hometask'] = [
                'name' => $this->hometask,
                'tasks' => $this->tasks,
            ];
            unset($request['tasks']);
        
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
