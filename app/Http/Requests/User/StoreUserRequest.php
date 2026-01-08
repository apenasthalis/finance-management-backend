<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'person_id' => 'required|integer',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
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

