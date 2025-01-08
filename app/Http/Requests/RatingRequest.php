<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'rating_id' => 'sometimes|exists:ratings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'rateable_id' => 'required|integer',
            'rateable_type' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id,
        ]);
    }
}
