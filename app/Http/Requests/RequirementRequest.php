<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'variety_id' => 'required|exists:crop_varieties,id',
            'quantity_required' => 'required|numeric|min:0.01|max:999999.99',
            'max_budget' => 'required|numeric|min:0.01|max:99999999.99',
            'description' => 'nullable|string|max:1000',
            'location' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'variety_id.required' => 'Please select a crop variety.',
            'variety_id.exists' => 'The selected crop variety is invalid.',
            'quantity_required.required' => 'Please enter the required quantity.',
            'quantity_required.numeric' => 'Quantity must be a number.',
            'quantity_required.min' => 'Quantity must be at least 0.01 tons.',
            'quantity_required.max' => 'Quantity cannot exceed 999,999.99 tons.',
            'max_budget.required' => 'Please enter your maximum budget.',
            'max_budget.numeric' => 'Budget must be a number.',
            'max_budget.min' => 'Budget must be at least ₹0.01.',
            'max_budget.max' => 'Budget cannot exceed ₹99,999,999.99.',
            'location.required' => 'Please enter the preferred location.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'variety_id' => 'crop variety',
            'quantity_required' => 'required quantity',
            'max_budget' => 'maximum budget',
        ];
    }
}
