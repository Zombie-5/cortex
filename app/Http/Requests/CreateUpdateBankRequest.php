<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateBankRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rulesInsert()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'owner' => ['required', 'string', 'max:255'],
            'iban' => ['required', 'numeric', 'unique:banks,iban'],
        ];
    }

    public function rulesUpdate($id)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'owner' => ['required', 'string', 'max:255'],
            'iban' => ['required', 'numeric', 'unique:banks,iban,' . $id],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Preenchimento obrigatório para o campo :attribute',
            'numeric' => 'Este campo precisa ser numerico',
            'unique' => 'Este Iban já está em uso.',
        ];
    }
}
