<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
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
            'plan_id' => [
                'required', 
                'exists:plans,id',
                Rule::unique('subscriptions')->where(function ($query) {
                    return $query->where('user_id', auth()->id())
                                 ->where('plan_id', $this->plan_id)
                                 ->whereNull('deleted_at'); // Ignore soft-deleted records;
                })->ignore($this->route('id')),
            ],  // Ensure the plan_id exists in the plans table
            'start' => ['required', 'date', 'after_or_equal:' . Carbon::today()->toDateString()],  // Ensure the start date is today or after
        ];
        
    }

    public function messages()
    {
        return [
            'plan_id.required' => 'A valid plan ID is required.',
            'plan_id.exists' => 'The selected plan does not exist.',
            'start.required' => 'The start date is required.',
            'start.date' => 'The start date is invalid.',
            'start.after_or_equal' => 'The start date must be today or later.',
            'plan_id.unique' => 'You have already subscribed to this plan.',
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
