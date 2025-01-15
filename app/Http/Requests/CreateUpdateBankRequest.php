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
            'iban' => ['required', 'numeric'],
        ];
    }

    /* public function rulesUpdate($id)
    {
        return [
            'nome_servico' => ['required', 'string', 'max:255', Rule::unique('servico', 'nome_servico')->where('tipo', "EXTENSAO")->ignore($id, 'id')],
            'duracao' => ['required', 'in:DIARIO,MENSAL,ANUAL'],
            'recurso' => ['required', 'in:PARTILHADO,DEDICADO,PRIVADO'],
            'preco_fornecedor' => ['required', 'numeric'],
            'preco_venda' => ['required', 'numeric'],
            'armazenamento' => ['required', 'string'],
            'qtd_dominio' => ['required', 'numeric'],
            'qtd_base_dado' => ['required', 'numeric'],
            'qtd_email' => ['required', 'numeric'],
            'trafego' => ['required', 'in:LIMITADO,ILIMITADO'],
            'tipo' => ['required', 'in:ALOJAMENTO'],
        ];
    } */

    public function messages()
    {
        return [
            'required' => 'Preenchimento obrigatório para o campo :attribute',
            'numeric' => 'Este campo precisa ser numerico',
        ];
    }
}
