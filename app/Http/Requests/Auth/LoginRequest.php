<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo "E-mail" é obrigatório.',
            'email.email' => 'O campo "E-mail" deve ser um e-mail válido.',
            'password.required' => 'O campo "Senha" é obrigatório.',
        ];
    }
}

