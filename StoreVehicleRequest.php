<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'driver_id' => 'required|exists:drivers,id',
            'plate'     => 'required|string|size:7|unique:vehicles,plate',
            'capacity'  => 'required|integer|min:1|max:60', //deixei a capacidade máxima como 60
            'mainRoute' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'driver_id.exists' => 'O motorista informado não existe.',
            'driver_id.required' => 'É necessário selecionar um motorista para o veículo',
            'plate.required' => 'O número da placa é obrigatório',
            'plate.unique' => 'Esta placa já está cadastrada.',
            'capacity.required' => 'A capacidade do veículo é obrigatória.',
            'capacity.max' => 'A capacidade máxima do veículo foi excedida.', //adicionei mensagem
            'mainRoute.required' => 'A rota do veículo é obrigatória',
        ];
    }
}

// obs; tá dando um erro por causa do front