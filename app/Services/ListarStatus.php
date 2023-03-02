<?php

namespace App\Services;

use App\StatusProcessoSeletivo;

class ListarStatus
{

    public function listarStatus(){
        $listarstatus = StatusProcessoSeletivo::query()->select('id', 'nome')->where('ativo', 'Sim')->orderBy('id')->get();
        $st = [];

        foreach ($listarstatus as $status) {
            array_push($st, $status);
        }

        return $st;
    }

}
