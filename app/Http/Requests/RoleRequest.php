<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->route('role')),
            ],
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The role name is required.',
            'name.string' => 'The role name must be a string.',
            'name.max' => 'The role name may not be greater than 255 characters.',
            'name.unique' => 'The role name has already been taken.',
            'permissions.required' => 'At least one permission is required.',
            'permissions.array' => 'The permissions must be an array.',
            'permissions.*.exists' => 'One or more of the selected permissions do not exist.',
        ];
    }
}
