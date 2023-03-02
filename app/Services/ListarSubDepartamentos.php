<?php

namespace App\Services;

use App\Departamento;
use App\SubDepartamentos;

class ListarSubDepartamentos
{

    public function listarSubDepartamentos(){
        $subdepartamentos = SubDepartamentos::query()->select('subdepartamentos.id', 'subdepartamentos.nome', 'subdepartamentos.departamento_id')->where('ativo', 'Sim')->orderBy('nome')->get();
        $sdp = [];

        foreach ($subdepartamentos as $subdepartamento) {
            array_push($sdp, $subdepartamento);
        }

        return $sdp;
    }

    public function listarSubDepartamentosAtivos(){
        $subdepartamentos = SubDepartamentos::select(
        'subdepartamentos.ativo',
        'subdepartamentos.nome AS nome',
        'subdepartamentos.id as id',
        'subdepartamentos.departamento_id as departamento_id',
            
        )->orderBy('nome')->get();
        $sdp = [];

        foreach ($subdepartamentos as $subdepartamento) {
            array_push($sdp, $subdepartamento);
        }

        return $sdp;
    }

}
