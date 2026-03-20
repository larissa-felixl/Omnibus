<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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

    // eva ta comentando em cada linha o que ela mudou, mas ela não sabe porque não está funcionando
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255|unique:drivers,license_number', //tenho que fazer com que o campo so aceite números e que o tamanho máximo seja 11 caracteres
            'phone_number' => 'required|string|max:20|unique', // deixei número de telefone único e devo adicionar mensagem
            'email' => 'required|email|max:255|unique:drivers,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'license_number.required' => 'O número da habilitação é obrigatório.',
            'license_number.unique' => 'Este número de habilitação já está cadastrado.',
            'phone_number.required' => 'O telefone é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password_confirmation.required' => 'A confirmação de senha é obrigatória.',
            'password_confirmation.same' => 'As senhas não coincidem.',
        ];
    }
}
