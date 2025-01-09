<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
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
            'name' => 'required', 'string', Rule::unique('plans', 'name')->ignore($this->route('plan')),
            'description' => 'required|string|max:255',
            'price' => 'required|integer',
            'with_trainer' => 'required|integer|max:1',
            'period' => 'required|integer',
            'plan_type_id' => 'required|integer|max:255',
            'redirect_to' => 'in:index,create',
        ];
    }
    public function messages(): array
    {
        return ['name.required' => 'The plan name is required.', 'name.string' => 'The plan name must be a string.', 'name.unique' => 'The plan name already exists. Route parameter: ' . $this->route('plan'), 'description.required' => 'The description is required.', 'description.string' => 'The description must be a string.', 'description.max' => 'The description may not be greater than 255 characters.', 'price.required' => 'The price is required.', 'price.integer' => 'The price must be an integer.', 'with_trainer.required' => 'The with trainer field is required.', 'with_trainer.integer' => 'The with trainer field must be an integer.', 'with_trainer.max' => 'The with trainer field may not be greater than 1.', 'period.required' => 'The period is required.', 'period.integer' => 'The period must be an integer.', 'period.max' => 'The period may not be greater than 255.', 'plan_type_id.required' => 'The plan type ID is required.', 'plan_type_id.integer' => 'The plan type ID must be an integer.', 'plan_type_id.max' => 'The plan type ID may not be greater than 255.', 'redirect_to.in' => 'The redirect to field must be one of the following values: index, create.',];
    }
}
