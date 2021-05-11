<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'user_name' => 'sometimes|required|max:40',
            'user_surname' => 'sometimes|required|max:40',
            'user_image' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
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

        if ($this->has('password') && $this->filled('password')) {
            $request['auth']['password'] = Hash::make($this->password);
            unset($request['password']);
        }
        $request['auth']['name'] = $this->name;
        $request['auth']['email'] = $this->email;
        $request['profile'] = [
            'name' => $this->user_name, 
            'surname' => $this->user_surname, 
            'middle_name' => $this->user_middle_name ?? null,
            'image' => $this->image ?? null,
        ];
        unset($request['name']);
        unset($request['email']);
        unset($request['user_name']);
        unset($request['user_surname']);
        unset($request['user_middle_name']);

        
        return $request;
    }
}
