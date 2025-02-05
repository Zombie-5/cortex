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
            'tel' => ['required', 'min:9', 'regex:/^(admin@cortex\.com|9(1|2|3|4|5|6|7|8|9)\d{7})$/'],
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
            'tel.regex' => 'O telefone é inválido!',
        ];
    }
}

