<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^628[0-9]{8,13}$/'],
            'message' => 'nullable|string|max:1000',
            // Keeping product_id and location as they are in existing logic
            'product_id' => 'required|exists:products,id',
            'location' => 'required|string|max:255',
        ];
    }
}
