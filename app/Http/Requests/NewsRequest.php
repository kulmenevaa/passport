<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $unique = Rule::unique('news')->ignore($this->news);
        return [
            'title'             => 'required|string|max:90|'.$unique,
            'abbreviation'      => 'required|string|max:140',
            'description'       => 'required|text',
            'public_date'       => 'required|date'
        ];
    }
}
