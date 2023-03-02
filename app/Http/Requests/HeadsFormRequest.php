<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeadsFormRequest extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
    public function authorize()
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
            'departamento_id' => 'required',
            'funcionario_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'departamento_id.required' => 'O campo departamento é obrigatório',
            'funcionario_id.required' => 'O campo funcionario é obrigatório'

        ];
    }
}
