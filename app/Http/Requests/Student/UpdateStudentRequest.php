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
            'image'            => 'nullable',
            'email_address'    => 'nullable|string|email',
            'home_address'     => 'sometimes|string|max:255',
            'phone_number'     => 'sometimes|string|unique:client_users,phone_number' . $this->student,
            'city'             => 'sometimes|string|max:255',
            'type_id'          => 'digits_between:1,2|nullable',
            'old_password'     => 'required_with:new_password',
            'new_password'     => 'nullable|string|min:6|different:old_password',
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

        if ($this->has('new_password') && $this->has('old_password'))
            if($this->filled('new_password') && $this->filled('old_password'))
                $request['auth']['password'] = Hash::make($this->new_password);
                unset($request['new_password']);
                unset($request['old_password']);
        
        if ($this->has('phone_number') && $this->filled('phone_number'))
            $request['auth']['phone_number'] = $this->phone_number;
            unset($this->phone_number);
        
        return $request;
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('new_password') && $this->has('old_password'))
                if($this->filled('new_password') && $this->filled('old_password'))
                    if ( !Hash::check($this->old_password, $this->student->credentials->password) ) {
                        $validator->errors()->add('old_password', trans('validation.password'));
                    }
        });
        return;
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
        if ($this->has('birth_date'))
            $this->merge(['birth_date' => \Carbon\Carbon::parse($this->birth_date)->format('Y.m.d')]);
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
