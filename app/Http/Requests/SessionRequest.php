<?php

namespace App\Http\Requests;

use App\Rules\TrainerAvailable;
use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'members_number' => 'required|integer|min:1|max:100',
            'trainer_id' => 'required',
            'plan_id' => 'required',
            'status' => 'required',
            'time_id' => ['required',new TrainerAvailable($this->input('time_id'), $this->input('trainer_id') ,$this->input('session_id') )],
            'redirect_to' => 'in:index,create',
        ];
    }
}
