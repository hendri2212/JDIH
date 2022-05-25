<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'photo' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'type' => 'required',
            'secret_key' => [
                'exclude_unless:type,superadmin',
                'required',
                Rule::in(['Superuser@*123'])
            ]
        ];
    }
}
