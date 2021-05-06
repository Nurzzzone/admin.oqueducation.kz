<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubjectRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:subjects,name' . $this->subject
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.string'   => trans('validated.string'),
            'name.max'      => trans('validated.max.string'),
            'name.unique'   => trans('validated.unique')
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('validation.attributes.title'),
        ];
    }
}
