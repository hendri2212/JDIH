<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnotherLevelUserRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['dpr', 'admin'])
            ],
            'photo' => [
                Rule::requiredIf(function(){
                    return $this->has('id') ? $this->type == 'dpr' && User::where('photo', null)->where('id_user', $this->id)->first() : $this->type == 'dpr';
                }),
                'image'
            ],
            'username' => 'required|unique:users',
            'password' => [
                Rule::requiredIf(function(){
                    return !$this->has('id');
                }),
                'min:8',
            ],
            'id_fraction' => [
                'exclude_unless:type,dpr',
                'required',
                'exists:fractions,id_fraction'
            ]
        ];
    }
}
