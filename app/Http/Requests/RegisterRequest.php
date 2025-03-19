<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

 /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tel' => ['required', 'digits:9', 'regex:/^(91|92|93|94|95|98|99)\d{7}$/', 'unique:users,tel'],
            'password' => ['required', 'string'],
            'invite_code' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'tel.required' => 'O campo telefone é obrigatório!',
            'tel.unique' => 'Este telefone já está cadastrado!',
            'tel.min' => 'O telefone deve ter exatamente 9 dígitos!',
            'tel.max' => 'O telefone deve ter exatamente 9 dígitos!',
            'password.required' => 'O preenchimento da senha é obrigatório!',
            'password.string' => 'A senha deve ser uma sequência de caracteres válida!',
            'tel.regex' => 'O telefone é inválido!',
            'invite_code.required' => 'O campo invite é obrigatório!',
        ];
    }
}
