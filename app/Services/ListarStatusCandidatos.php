<?php

namespace App\Services;

use App\StatusCandidatos;

class ListarStatusCandidatos
{

    public function listarStatusCandidatos(){
        $listarstatuscandidatos = StatusCandidatos::query()->select('id', 'nome')->where('ativo', 'Sim')->orderBy('id', 'ASC')->get();
        $stc = [];

        foreach ($listarstatuscandidatos as $status) {
            array_push($stc, $status);
        }

        return $stc;
    }

}
