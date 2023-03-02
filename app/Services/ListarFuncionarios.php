<?php

namespace App\Services;

use App\Funcionario;
use App\ProcessoSeletivo;
use App\Usuario;
use Illuminate\Support\Facades\DB;

class ListarFuncionarios
{

    public function listarFuncionarios(){
        $funcionarios = Funcionario::query()->select('id', 'nome')->where('ativo', 'Sim')->orderBy('nome')->get();
        $func = [];

        foreach ($funcionarios as $funcionario) {
            array_push($func, $funcionario);
        }

        return $func;
    }


    public function listarUsuariosAtivos(){
        $usuarios = Usuario::select(
        'funcionarios.nome AS funcionario_nome',
        'funcionarios.id as funcionario_id',
        'usuarios.ativo',
        'usuarios.id as usuario_id',
        'departamentos.id as departamento_id',
        'departamentos.departamento as departamento_nome',
            
        )->join('funcionarios', 'funcionarios.id', '=', 'usuarios.funcionario_id')
        ->join('departamentos', 'departamentos.id', '=', 'usuarios.departamento_id')->orderBy('funcionario_nome')->get();
        $user = [];

        foreach ($usuarios as $usuario) {
            array_push($user, $usuario);
        }

        return $user;
    }

    public function listarRecrutador($usuario_id){
        var_dump($usuario_id);
        exit();
        $recrutadores = ProcessoSeletivo::select(
        'funcionarios.nome AS funcionario_nome',
        'funcionarios.id as funcionario_id',
            
        )->join('funcionarios', 'funcionarios.id', '=', 'rh_processo_seletivos.recrutador_usuario_id')->orderBy('funcionario_nome')->get();
        $recrut = [];

        foreach ($recrutadores as $recrutador) {
            array_push($recrut, $recrutador);
        }

        return $recrut;
    }

    public function listarFuncionariosUsuarios(){
        $funcionarios = DB::select('SELECT id, nome FROM funcionarios WHERE id NOT IN (SELECT funcionario_id FROM usuarios) ORDER BY nome');
        $func = [];

        foreach ($funcionarios as $funcionario) {
            array_push($func, $funcionario);
        }

        return $func;
    }

}
