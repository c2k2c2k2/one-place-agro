<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^[0-9]{10}$/', 'unique:users,mobile'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', 'in:farmer,trader'],
            'location' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255', 'required_if:role,trader'],
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
            'mobile.regex' => 'Mobile number must be exactly 10 digits.',
            'mobile.unique' => 'This mobile number is already registered.',
            'role.in' => 'Please select a valid role (Farmer or Trader).',
            'company_name.required_if' => 'Company name is required for traders.',
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
            'mobile' => 'mobile number',
            'company_name' => 'company name',
        ];
    }
}
