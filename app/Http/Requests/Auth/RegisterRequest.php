<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
                'fullname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'username' => 'nullable|string|max:255',
                'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo "E-mail" é obrigatório.',
            'email.email' => 'O campo "E-mail" deve ser um e-mail válido.',
            'password.required' => 'O campo "Senha" é obrigatório.',
            'fullname.required' => 'O campo "Nome Completo" é obrigatório.',
            'password.min' => 'O campo "Senha" deve ter no mínimo 6 caracteres.',
        ];
    }
}

