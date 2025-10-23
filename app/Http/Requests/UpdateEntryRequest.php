<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:Approved,Rejected',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status field is required.',
            'status.in' => 'Status must be either Approved or Rejected.',
        ];
    }
}
