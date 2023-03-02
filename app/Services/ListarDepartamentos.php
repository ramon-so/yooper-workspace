<?php

namespace App\Services;

use App\Departamento;

class ListarDepartamentos
{

    public function listarDepartamentos(){
        $departamentos = Departamento::query()->select('departamentos.id', 'departamentos.departamento')->where('ativo', 'Sim')->orderBy('departamento')->get();
        $dp = [];

        foreach ($departamentos as $departamento) {
            array_push($dp, $departamento);
        }

        return $dp;
    }

    public function listarDepartamentosAtivos(){
        $departamentos = Departamento::select(
        'departamentos.ativo',
        'departamentos.departamento AS departamento',
        'departamentos.id as departamento_id',
            
        )->orderBy('departamento')->get();
        $dp = [];

        foreach ($departamentos as $departamento) {
            array_push($dp, $departamento);
        }

        return $dp;
    }

}
