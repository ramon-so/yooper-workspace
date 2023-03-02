<?php

namespace App\Services;

use App\Funcionario;
use App\Usuario;
use Illuminate\Support\Facades\DB;

class FuncionarioInfo
{

    public function funcionario_informacoes($id){
        
        $usuario = Usuario::select(
            'usuarios.nome AS nome_user',
            'usuarios.id AS id_user',
            'usuarios.foto_usuario as foto_usuario',
            'usuarios.acesso', 
            'usuarios.foto_usuario', 
            'usuarios.funcionario_id',
            'departamentos.departamento', 
            'funcionarios.nome AS nome_funcionario',
            'funcionarios.email AS email_funcionario',
            'usuarios.ativo AS ativo_user',
            'departamentos.formulario AS departamento_form'
        )
        ->join('departamentos', 'departamentos.id', '=', 'usuarios.departamento_id')
        ->join('funcionarios', 'funcionarios.id', '=', 'usuarios.funcionario_id')
        ->where('usuarios.id', "=", $id)
        ->orderBy('funcionarios.nome', 'asc')
        ->get();

        // var_dump($usuario[0]->nome_funcionario);
        // exit();

        return $usuario;
    }

}