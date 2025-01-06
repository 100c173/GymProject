<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingFilterRequest extends FormRequest
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
            'rating' => 'nullable|in:1,2,3,4,5,All',
            'rateable_type' => 'nullable|string',
            'rater_name' => 'nullable|string',
            'rateable_name' => 'nullable|string',
            'entries_number' => 'nullable|integer|min:5',
        ];
    }
}
