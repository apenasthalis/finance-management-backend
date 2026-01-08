<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'person_id' => 'sometimes|required|integer|exists:person,id',
            'username' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'sometimes|required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'person_id.required' => 'O campo "Pessoa" é obrigatório.',
            'person_id.exists' => 'A pessoa selecionada não existe.',
            'username.required' => 'O campo "Nome de Usuário" é obrigatório.',
            'username.max' => 'O campo "Nome de Usuário" não pode ter mais de 255 caracteres.',
            'username.unique' => 'Este nome de usuário já está em uso.',
            'email.required' => 'O campo "E-mail" é obrigatório.',
            'email.email' => 'O campo "E-mail" deve ser um e-mail válido.',
            'email.max' => 'O campo "E-mail" não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo "Senha" é obrigatório.',
            'password.min' => 'O campo "Senha" deve ter no mínimo 8 caracteres.',
        ];
    }
}

