<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'nome' => 'required',
            'cpf' => 'required',
            'email' => 'required',
            'sexo' => 'required',
            'departamento' => 'required',
        ];
    }

    public function messages(){
        return [
            'nome.required' => 'O campo `nome` é obrigatório',
            'cpf.required' => 'O campo `cpf` é obrigatório',
            'email.required' => 'O campo `email` é obrigatório',
            'sexo.required' => 'O campo `sexo` é obrigatório',
            'departamento.required' => 'O campo `departamento` é obrigatório'
        ];
    }
}
