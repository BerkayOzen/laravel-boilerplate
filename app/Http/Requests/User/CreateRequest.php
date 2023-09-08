<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'sometimes',
            'gender' => 'sometimes|numeric',
        ];
    }
}
