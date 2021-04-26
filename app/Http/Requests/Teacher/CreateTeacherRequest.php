<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherRequest extends FormRequest
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
            'name'                   => 'required|string|max:255',
            'surname'                => 'nullable|string|max:255',
            'middle_name'            => 'nullable|string|max:255',
            'birth_date'             => 'nullable|date|before:today|max:10',
            'phone_number'           => 'required|string|max:255|unique:teachers,phone_number' . $this->teacher,
            'home_address'           => 'nullable|string|max:255',
            'email_address'          => 'nullable|email|string|max:255',
            'image'                  => 'nullable|string|max:255',
            'description'            => 'nullable|string|max:4000',
            'is_active'              => 'nullable|boolean',
            'position'               => 'nullable|string',
            'facebook_url'           => 'nullable|string|max:255|url',
            'instagram_url'          => 'nullable|string|max:255|url',
            'password'               => 'required|string|min:6|max:255',
            'position'               => 'nullable|string|max:255',
            'job_history.position'   => 'nullable|string|max:255',
            'job_history.start_date' => 'nullable|date',
            'job_history.end_date'   => 'nullable|date',
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

        if ($this->has('password') && $this->filled('password'))
                $request['password'] = Hash::make($this->password);
        
        return $request;
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
            'name.required'         => trans('validation.required'),
            'phone_number.required' => trans('validation.required'),
            'name.string'           => trans('validation.string'),
            'surname.string'        => trans('validation.string'),
            'middle_name.string'    => trans('validation.string'),
            'phone_number.string'   => trans('validation.string'),
            'home_address.string'   => trans('validation.string'),
            'email_address.string'  => trans('validation.string'),
            'image.string'          => trans('validation.string'),
            'description.string'    => trans('validation.string'),
            'facebook_url.string'   => trans('validation.string'),
            'instagram_url.string'  => trans('validation.string'),
            'name.max'              => trans('validation.max.string'),
            'surname.max'           => trans('validation.max.string'),
            'middle_name.max'       => trans('validation.max.string'),
            'phone_number.max'      => trans('validation.max.string'),
            'home_address.max'      => trans('valdiation.max.string'),
            'email_address.max'     => trans('validation.max.string'),
            'image.max'             => trans('validation.max.string'),
            'description'           => trans('validation.max.string'),
            'facebook_url.max'      => trans('validation.max.string'),
            'instagram_url.max'     => trans('validation.max.string'),
            'facebook_url.url'      => trans('validation.url'),
            'instagram_url.url'     => trans('validation.url'),
            'email_address.email'   => trans('validation.email'),
            'birth_date.date_format'=> trans('validation.date'),
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
            'phone_number'  => trans('validation.attributes.phone_number'),
            'email_address' => trans('validation.attributes.email_address'),
            'image'         => trans('validation.attributes.image'),
            'description'   => trans('validation.attributes.description'),
            'facebook_url'  => trans('validation.attributes.facebook'),
            'instagram_url' => trans('validation.instagram_url'),
        ];
    }
}
