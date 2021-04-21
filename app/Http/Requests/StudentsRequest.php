<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
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
            'name'           => 'required|string|max:255',
            'surname'        => 'required|string|max:255',
            'middle_name'    => 'nullable|string|max:255',
            'birth_date'     => 'required|date_format:Y.m.d|before:today|max:10',
            'image'          => 'nullable|string',
            'email_address'  => 'nullable|string',
            'home_address'   => 'required|string',
            'phone_number'   => 'required|string|unique:students,phone_number' . $this->student,
            'city'           => 'required|string|max:255',
            'type'           => 'digits_between:1,2|nullable',
            'password'       => 'required|min:6'
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

        if ($this->filled('password')) $request['password'] = Hash::make($this->password);
        
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
            if ($this->type == 'БИЛ/НИШ') $this->merge(['type' => 1]);
            if ($this->type == 'ЕНТ') $this->merge(['type' => 2]);
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
            'name.required'          => trans('validation.required'),
            'surname.required'       => trans('validation.required'),
            'birth_date'             => trans('validation.required'),
            'home_address'           => trans('validation.required'),
            'phone_number.required'  => trans('validation.required'),
            'city.required'          => trans('validation.required'),
            'password.required'      => trans('validation.required'),
            'name.max'               => trans('validation.numeric.max'),
            'surname.max'            => trans('validation.numeric.max'),
            'middle_name.max'        => trans('validation.numeric.max'),
            'city.max'               => trans('validation.numeric.max'),
            'phone_number'           => trans('validation.unique'),
            'password'               => trans('validation.numeric.min'),
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
            'name'          => trans('validation.attributes.name'),
            'surname'       => trans('validation.attributes.surname'),
            'middle_name'   => trans('validation.attributes.middle_name'),
            'birth_date'    => trans('validation.attributes.birth_date'),
            'image'         => trans('validation.attributes.image'),
            'email_address' => trans('validation.attributes.email_address'),
            'home_address'  => trans('validation.attributes.home_address'),
            'phone_number'  => trans('validation.attributes.phone_number'),
            'city'          => trans('validation.attributes.city'),
            'type'          => trans('validation.attributes.type'),
            'password'      => trans('validation.attributes.password'),
        ];
    }
}
