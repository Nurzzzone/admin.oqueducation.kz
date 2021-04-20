<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StudentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extend('type', function($attr, $value) {
            if ($value == "БИЛ/НИШ") {
                return 1;
            } elseif ($value == "ЕНТ") {
                return 2;
            }
        });

        return [
            'name'           => 'required|max:255',
            'surname'        => 'required|max:255',
            'middle_name'    => 'nullable|max:255',
            'image'          => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'email_address'  => 'required', 
            'phone_number'   => 'required|unique:students,phone_number' . $this->student,
            'city'           => 'required|max:255',
            'parent'         => 'required',
            'type'           => 'type|nullable|digits_betweeb:1,2',
            'password'       => 'required|min:6'
        ];
    }
}
