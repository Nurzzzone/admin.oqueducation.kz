<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentParentRequest extends FormRequest
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
            'p1_full_name'      => 'sometimes|string|max:255',
            'p1_phone_number'   => 'sometimes|string|max:255',
            'p2_full_name'      => 'nullable|string|max:255',
            'p2_phone_number'   => 'nullable|string|max:255'    
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
        
        if ($this->has('p1_full_name') 
         || $this->has('p1_phone_number') 
         || $this->has('p2_full_name')
         || $this->has('p2_phone_number'))
            $request['parents'] = [
                'p1_full_name'    => $this->p1_full_name ?? null,
                'p1_phone_number' => $this->p1_phone_number ?? null,
                'p2_full_name'    => $this->p2_full_name ?? null,
                'p2_phone_number' => $this->p2_phone_number ?? null,
            ];
            unset($request['p1_full_name']);
            unset($request['p1_phone_number']);
            unset($request['p2_full_name']);
            unset($request['p2_phone_number']);
        
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
