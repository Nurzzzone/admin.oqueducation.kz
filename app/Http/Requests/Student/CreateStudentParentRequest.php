<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentParentRequest extends FormRequest
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
        return 
        [
            'p1_full_name'      => 'required|string|max:255',
            'p1_phone_number'   => 'required|string|max:255',
            'p2_full_name'      => 'nullable|string|max:255',
            'p2_phone_number'   => 'nullable|string|max:255'    
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return
        [
            'p1_full_name.required'     => trans('validation.required'),
            'p1_phone_number.required'  => trans('validation.required'),
            'p1_full_name.string'       => trans('validation.string'),
            'p1_phone_number.string'    => trans('validation.string'),
            'p2_full_name.string'       => trans('validation.string'),
            'p2_phone_number.string'    => trans('validation.string'),
            'p1_full_name.max'          => trans('validation.max.string'),
            'p1_phone_number.max'       => trans('validation.max.string'),
            'p2_full_name.max'          => trans('validation.max.string'),
            'p2_phone_number.max'       => trans('validation.max.string'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return 
        [
            'p1_full_name'     => trans('validation.attributes.p1_full_name'),
            'p1_phone_number'  => trans('validation.attributes.p1_phone_number'),
            'p2_full_name'     => trans('validation.attributes.p2_full_name'),
            'p2_phone_number'  => trans('validation.attributes.p2_phone_number'),
        ];
    }
}
