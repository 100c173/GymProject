<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeFilterRequest extends FormRequest
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
            'min_time' => 'nullable|date_format:H:i',
            'max_time' => 'nullable|date_format:H:i',
            'min_date' => 'nullable|date_format:Y-m-d',
            'max_date' => 'nullable|date_format:Y-m-d',
            'entries_number' => 'nullable|integer|min:5',
        ];
    }
}
