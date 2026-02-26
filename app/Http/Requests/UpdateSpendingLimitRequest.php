<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpendingLimitRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'limit_amount' => 'required|numeric|min:0|max:9999999.99',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'limit_amount.required' => 'O valor do limite é obrigatório.',
            'limit_amount.numeric' => 'O valor do limite deve ser numérico.',
            'limit_amount.min' => 'O valor do limite deve ser maior ou igual a zero.',
            'limit_amount.max' => 'O valor do limite é muito alto.',
        ];
    }
}
