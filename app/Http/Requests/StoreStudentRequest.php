<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id'

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Student name',
            'email' => 'Student email',
            'classroom_id' => 'Classroom',
            'section_id' => 'Section'
        ];
    }
}


