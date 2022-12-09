<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
        $unique = Rule::unique('users')->ignore($this->user);
        return [
            'surname'       => 'required|string|max:255',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|numeric|min:11',
            'email'         => 'required|string|max:255|email|'.$unique,
            'password'      => 'required|string|min:6',
            'c_password'    => 'required|same:password|min:6',
            'role'          => 'required'
        ];
    }
}
