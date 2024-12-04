<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class MemberShipApplicationRequest extends FormRequest
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
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'required|nullable|mimes:pdf|max:5120',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [

            'image.required' => 'An image is required.',
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'The image must be one of the following types: jpeg, png, jpg, gif, or svg.',
            'image.max' => 'The image size must not exceed 2MB.',

            'pdf.required' => 'A PDF file is required.',
            'pdf.mimes' => 'The file must be a valid PDF.',
            'pdf.max' => 'The PDF size must not exceed 5MB.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
