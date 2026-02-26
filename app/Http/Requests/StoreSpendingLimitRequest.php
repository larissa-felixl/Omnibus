<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SpendingLimit;

class StoreSpendingLimitRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'limit_amount' => 'required|numeric|min:0|max:9999999.99',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'O ID do usuário é obrigatório.',
            'user_id.exists' => 'O usuário informado não existe.',
            'limit_amount.required' => 'O valor do limite é obrigatório.',
            'limit_amount.numeric' => 'O valor do limite deve ser numérico.',
            'limit_amount.min' => 'O valor do limite deve ser maior ou igual a zero.',
            'limit_amount.max' => 'O valor do limite é muito alto.',
        ];
    }

    /**
     * Validação adicional após as regras padrão
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Verifica se já existe um limite para este usuário no mês atual
            $existingLimit = SpendingLimit::where('user_id', $this->user_id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->first();

            if ($existingLimit) {
                $validator->errors()->add(
                    'user_id',
                    'Já existe um limite de gastos cadastrado para este usuário no mês atual.'
                );
            }
        });
    }
}
