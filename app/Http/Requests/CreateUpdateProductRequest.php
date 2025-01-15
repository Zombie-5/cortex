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

    public function rulesUpdate($id)
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($id, 'id')],
            'desc' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'income' => ['required', 'numeric'],
            'duration' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Preenchimento obrigatório para o campo :attribute',
            'numeric' => 'Este campo precisa ser numerico',
            'name.unique' => 'Já existe produto com este nome!',
        ];
    }
}
