<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'          => 'sometimes|unique:users,name,'. $this->user->id,
            'email'         => 'sometimes|unique:users,email,'. $this->user->id,
            'old_password'  => 'required_with:new_password',
            'new_password'  => 'nullable|string|min:6|different:old_password',
            'user_name'     => 'sometimes|string|max:40',
            'user_surname'  => 'sometimes|string|max:40',
            'user_image'    => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
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
            if ($this->filled('new_password') && $this->filled('old_password'))
                $request['auth']['password'] = Hash::make($this->new_password);
                unset($request['new_password']);
                unset($request['old_password']);

        if ($this->has('email') && $this->filled('email'))
            $request['auth']['email'] = $this->email;
            unset($request['email']);
        $request['auth']['name'] = $this->name;
        $request['profile'] = [
            'name' => $this->user_name, 
            'surname' => $this->user_surname, 
            'middle_name' => $this->user_middle_name ?? null,
            'image' => $this->image ?? null,
        ];
        unset($request['name']);
        unset($request['image']);
        unset($request['user_name']);
        unset($request['user_surname']);
        unset($request['user_middle_name']);
        
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
                    if ( !Hash::check($this->old_password, $this->user->password) ) {
                        $validator->errors()->add('old_password', trans('validation.password'));
                    }
        });
        
        return;
    }
}
