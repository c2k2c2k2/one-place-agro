<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'yield_id' => 'required|exists:yields,id',
            'bid_amount' => 'required|numeric|min:0.01|max:99999999.99',
            'quantity' => 'nullable|numeric|min:0.01|max:999999.99',
            'message' => 'nullable|string|max:500',
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
            'yield_id.required' => 'Yield information is required.',
            'yield_id.exists' => 'The selected yield is invalid.',
            'bid_amount.required' => 'Please enter your bid amount.',
            'bid_amount.numeric' => 'Bid amount must be a number.',
            'bid_amount.min' => 'Bid amount must be at least ₹0.01.',
            'bid_amount.max' => 'Bid amount cannot exceed ₹99,999,999.99.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 0.01 tons.',
            'quantity.max' => 'Quantity cannot exceed 999,999.99 tons.',
            'message.max' => 'Message cannot exceed 500 characters.',
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
            'yield_id' => 'yield',
            'bid_amount' => 'bid amount',
        ];
    }
}
