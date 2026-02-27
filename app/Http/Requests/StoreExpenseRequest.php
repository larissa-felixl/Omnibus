<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_plate' => 'required|string|max:255',
            'value' => 'required|numeric|min:0|max:999999.99',
            'proof_of_payment' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'driver_id.required' => 'O ID do motorista é obrigatório.',
            'driver_id.exists' => 'O motorista informado não existe.',
            'vehicle_plate.required' => 'A placa do veículo é obrigatória.',
            'value.required' => 'O valor da despesa é obrigatório.',
            'value.numeric' => 'O valor deve ser numérico.',
            'value.min' => 'O valor deve ser maior ou igual a zero.',
            'proof_of_payment.required' => 'O comprovante de pagamento é obrigatório.',
        ];
    }
}
