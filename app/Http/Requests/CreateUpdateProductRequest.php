<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CreateUpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rulesInsert()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')],
            'desc' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'income' => ['required', 'numeric'],
            'duration' => ['required', 'numeric'],
            
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
            'name.unique' => 'Já existe produto com este nome!',
        ];
    }
}
