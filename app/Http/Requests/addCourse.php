<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addCourse extends FormRequest
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
            'courseName' => 'required',
            'departmentId' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'departmentId.required' => 'The department field is required',
        ];
    }
}
