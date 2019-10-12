<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user'         => 'required',
            'username'     => 'required|max:50|unique:users',
            'email'        => 'nullable|email|unique:users',
            'phone1'       => 'required|unique:users',
            'password'     => 'required',
            'roles'        => 'required',
        ];
    }
}
