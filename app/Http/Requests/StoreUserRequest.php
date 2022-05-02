<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string',
            'username' => 'required|string|unique:App\Models\User,username',
            'email' => 'required|email|unique:App\Models\User,email',
            'role' => 'required|integer',
            'gender' => 'required|integer',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
