<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormElementRequest extends FormRequest
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
            'textfield' => 'required|min:6',
            'selectfiled' => 'required',
            'textarea' => 'required',
            'filefield' => 'required|mimes:jpeg,jpeg,png',
        ];
    }
}
