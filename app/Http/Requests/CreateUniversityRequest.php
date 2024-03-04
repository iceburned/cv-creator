<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUniversityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'datepicker' => 'required',
            'university_name' => 'required',
            'accreditation' => 'required',
        ];
    }
}
