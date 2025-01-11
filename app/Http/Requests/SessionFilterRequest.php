<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionFilterRequest extends FormRequest
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
            'session_name' => 'nullable|string|max:255',
            'max_members' => 'nullable|integer|min:1',
            'entries_number' => 'nullable|integer|min:5',
        ];
    }
}
