<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDriverRequest extends FormRequest
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
        $driverId = $this->route('driver');
        
        return [
            'name' => 'sometimes|required|string|max:255',
            'license_number' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('drivers', 'license_number')->ignore($driverId)
            ],
            'phone_number' => 'sometimes|required|string|max:20',
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('drivers', 'email')->ignore($driverId)
            ],
            'password' => 'sometimes|required|string|min:6',
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
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
