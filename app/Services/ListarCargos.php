<?php

namespace App\Services;

use App\Cargo;

class ListarCargos
{

    public function listarCargos(){
        $rh_cargos = Cargo::query()->select('id', 'nome')->orderBy('id')->get();
        $cg = [];

        foreach ($rh_cargos as $rh_cargo) {
            array_push($cg, $rh_cargo);
        }

        return $cg;
    }

}
