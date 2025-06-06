<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'tel' => [
                'required',
                'min:9',
                'regex:/^(9[1-9]\d{7}|admin@etoro\.com|lilcrypto@etoro\.com|youngvisa@etoro\.com)$/'
            ],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'tel.required' => 'O campo telefone é obrigatório!',
            'tel.min' => 'O telefone deve ter exatamente 9 dígitos!',
            'tel.max' => 'O telefone deve ter exatamente 9 dígitos!',
            'password.required' => 'O preenchimento da senha é obrigatório!',
            'password.string' => 'A senha deve ser uma sequência de caracteres válida!',
            'password.min' => 'A senha deve ter no minimo 6 caracteres',
            'tel.regex' => 'O telefone é inválido!',
        ];
    }
}
