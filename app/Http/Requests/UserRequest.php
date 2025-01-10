<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules =  [
            //
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required',
            'string',
            'email',
            'max:255',
            'unique:users',
            Rule::unique('users')->ignore($this->route('user')),
            'redirect_to' => 'nullable|in:index,create',

        ];

        if ($this->isMethod('post')) {

            // Password & role is required when creating a new user
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['role'] = 'required|exists:roles,name';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {

            // Password & role is optional when updating an existing user
            $rules['password'] = 'sometimes|string|min:8|confirmed';
            $rules['role'] = 'sometimes|exists:roles,name';
        }
        return $rules;
    }
}
