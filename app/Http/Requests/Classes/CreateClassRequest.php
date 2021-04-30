<?php

namespace App\Http\Requests\Classes;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassRequest extends FormRequest
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
            'title'                         => 'required',
            'source_url'                    => 'required',
            'type_id'                       => 'required',
            'questions.*.question'          => 'required',
            'questions.*.image'             => 'nullalbe',
            'questions.*.answers.*.answer'  => 'nullable',
            'tasks.*.task'                  => 'required',
            'tasks.*.hint'                  => 'nullable',
            'tasks.*.image'                 => 'nullable'
        ];
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
                case "БИЛ/НИШ": 
                    $this->merge(['type_id' => 1]);
                    break;
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
