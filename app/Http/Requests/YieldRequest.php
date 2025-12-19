<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YieldRequest extends FormRequest
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
            'quantity' => 'required|numeric|min:0.01|max:999999.99',
            'price_per_ton' => 'required|numeric|min:0.01|max:999999.99',
            'description' => 'nullable|string|max:1000',
            'harvest_date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max per image
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'string',
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
            'quantity.required' => 'Please enter the quantity.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least 0.01 tons.',
            'quantity.max' => 'Quantity cannot exceed 999,999.99 tons.',
            'price_per_ton.required' => 'Please enter the price per ton.',
            'price_per_ton.numeric' => 'Price must be a number.',
            'price_per_ton.min' => 'Price must be at least ₹0.01.',
            'price_per_ton.max' => 'Price cannot exceed ₹999,999.99.',
            'harvest_date.required' => 'Please select the harvest date.',
            'harvest_date.date' => 'Please enter a valid date.',
            'harvest_date.after_or_equal' => 'Harvest date cannot be in the past.',
            'location.required' => 'Please enter the location.',
            'images.max' => 'You can upload a maximum of 5 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Images must be in JPEG, PNG, JPG, or WebP format.',
            'images.*.max' => 'Each image must not exceed 5MB.',
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
            'price_per_ton' => 'price per ton',
            'harvest_date' => 'harvest date',
        ];
    }
}
