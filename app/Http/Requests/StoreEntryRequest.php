<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntryRequest extends FormRequest
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
            'category' => 'required|string',
            'numeric_value' => 'required|numeric|min:0',
            'date' => 'required|date|before_or_equal:today',
            'notes' => 'nullable|string'
        ];
    }
    public function messages(): array
    {
        return [
            'category.required' => 'Category field is required.',
            'numeric_value.required' => 'Numeric value is required.',
            'numeric_value.numeric' => 'Numeric value must be a number.',
            'date.required' => 'Date is required.',
            'date.before_or_equal' => 'Date must be today or before.',
        ];
    }
}
