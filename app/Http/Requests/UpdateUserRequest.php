<?php

namespace App\Http\Requests;

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
            'name' => 'required|string',
            'email' => 'required|email|unique:App\Models\User,email,'.$this->user()->id,
            'role' => 'required|integer',
            'gender' => 'required|integer',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'nullable|confirmed|min:6',
        ];
    }
}
