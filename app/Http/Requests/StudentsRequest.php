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
            'name'             => 'required|string|max:255',
            'surname'          => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'birth_date'       => 'required|date_format:Y.m.d|before:today|max:10',
            'image'            => 'nullable|string',
            'email_address'    => 'nullable|string',
            'home_address'     => 'required|string',
            'phone_number'     => 'required|string|unique:students,phone_number' . $this->student,
            'city'             => 'required|string|max:255',
            'type'             => 'digits_between:1,2|nullable',
            'password'         => 'required|min:6',
            'p1_full_name'     => 'required|string|max:255',
            'p1_phone_number'  => 'required|string|max:255',
            'p2_full_name'     => 'nullable|string|max:255',
            'p2_phone_number'  => 'nullable|string|max:255'    
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
            'name.required'             => trans('validation.required'),
            'surname.required'          => trans('validation.required'),
            'birth_date'                => trans('validation.required'),
            'home_address'              => trans('validation.required'),
            'phone_number.required'     => trans('validation.required'),
            'city.required'             => trans('validation.required'),
            'password.required'         => trans('validation.required'),
            'name.string'               => trans('validation.string'),
            'surname.string'            => trans('validation.string'),
            'middle_name.string'        => trans('validation.string'),
            'image.string'              => trans('validation.string'),
            'email_address.string'      => trans('validation.string'),
            'home_address.string'       => trans('validation.string'),
            'phone_number.string'       => trans('validation.string'),
            'city.string'               => trans('validation.string'),
            'name.max'                  => trans('validation.max.string'),
            'surname.max'               => trans('validation.max.string'),
            'middle_name.max'           => trans('validation.max.string'),
            'city.max'                  => trans('validation.max.string'),
            'phone_number'              => trans('validation.unique'),
            'password'                  => trans('validation.min.string'),
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
            'name'             => trans('validation.attributes.name'),
            'surname'          => trans('validation.attributes.surname'),
            'middle_name'      => trans('validation.attributes.middle_name'),
            'birth_date'       => trans('validation.attributes.birth_date'),
            'image'            => trans('validation.attributes.image'),
            'email_address'    => trans('validation.attributes.email_address'),
            'home_address'     => trans('validation.attributes.home_address'),
            'phone_number'     => trans('validation.attributes.phone_number'),
            'city'             => trans('validation.attributes.city'),
            'type'             => trans('validation.attributes.type'),
            'password'         => trans('validation.attributes.password'),
            'p1_full_name'     => trans('validation.attributes.p1_full_name'),
            'p1_phone_number'  => trans('validation.attributes.p1_phone_number'),
            'p2_full_name'     => trans('validation.attributes.p2_full_name'),
            'p2_phone_number'  => trans('validation.attributes.p2_phone_number'),
        ];
    }
}
