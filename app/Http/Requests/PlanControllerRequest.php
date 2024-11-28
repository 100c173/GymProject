<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanControllerRequest extends FormRequest
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
            'name'=>'required|string|',
            'description'=>'required|string|max:255',
            'price'=>'required|integer|',
            'with_trainer'=>'required|integer|max:1',
            'period'=>'required|integer|max:255',
            'plan_type_id'=>'required|integer|max:255',
        ];
    }
}
