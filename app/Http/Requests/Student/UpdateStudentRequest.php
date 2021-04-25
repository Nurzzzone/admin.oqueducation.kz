<?php

namespace App\Http\Requests\Student;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name'             => 'sometimes|string|max:255',
            'surname'          => 'sometimes|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'birth_date'       => 'sometimes|date_format:Y.m.d|before:today|max:10',
            'image'            => 'nullable|string',
            'email_address'    => 'nullable|string',
            'home_address'     => 'sometimes|string',
            'phone_number'     => 'sometimes|string|unique:students,phone_number' . $this->student,
            'city'             => 'sometimes|string|max:255',
            'type_id'          => 'digits_between:1,2|nullable',
            'password'         => 'sometimes|min:6',
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

        if ($this->filled('new_password'))
            // get current user password
            if (Hash::check($request[], $request['password']))
                $request['password'] = Hash::make($this->new_password);
        
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
                case "БИЛ/НИШ": 
                    $this->merge(['type_id' => 1]);
                    break;
                case "БИЛ":
                    $this->merge(['type_id' => 1]);
                    break;
                case "НИШ":
                    $this->merge(['type_id' => 1]);
                    break;
                case "ЕНТ":
                    $this->merge(['type_id' => 2]);
                    break;
            }
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
        ];
    }
}
