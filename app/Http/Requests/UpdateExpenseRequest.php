<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
            'vehicle_plate' => 'sometimes|required|string|max:255',
            'value' => 'sometimes|required|numeric|min:0|max:999999.99',
            'proof_of_payment' => 'sometimes|required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'vehicle_plate.required' => 'A placa do veículo é obrigatória.',
            'value.required' => 'O valor da despesa é obrigatório.',
            'value.numeric' => 'O valor deve ser numérico.',
            'value.min' => 'O valor deve ser maior ou igual a zero.',
            'proof_of_payment.required' => 'O comprovante de pagamento é obrigatório.',
        ];
    }
}
