<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'id_no' => 'string|max:255',
            'id_type' => 'string|max:255',
            'gender' => 'in:male,female',
            'dob' => 'date|date_format:Y-m-d',
            'address' => 'string',
            'medium_acquisition' => 'string',
        ];
    }
}
