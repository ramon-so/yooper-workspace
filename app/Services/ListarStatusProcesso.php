<?php

namespace App\Services;

use App\StatusProcessoSeletivo;

class ListarStatusProcesso
{

    // public function listarStatusProcesso(){
    //     $processo_status = StatusProcessoSeletivo::query()->select('id', 'nome')->orderBy('id')->get();
    //     $ps = [];

    //     foreach ($processo_status as $status_processo) {
    //         array_push($ps, $status_processo);
    //     }

    //     return $ps;
    // }

    public function listarStatusProcesso(){
        $processo_status = StatusProcessoSeletivo::query()->select('*')
        ->where('ativo', 'Sim')->orderBy('nome')->get();
        $ps = [];

        foreach ($processo_status as $status_processo) {
            array_push($ps, $status_processo);
        }

        return $ps;
    }

}
