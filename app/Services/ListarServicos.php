<?php

namespace App\Services;

use App\Servicos;
use Illuminate\Support\Facades\DB;

class listarServicos
{


    public function listarServicos(){
        $clientes = Servicos::select('*')->where('ativo', '=', 'Sim')->orderBy('nome')->get();
        $client = [];

        foreach ($clientes as $cliente) {
            array_push($client, $cliente);
        }

        return $client;
    }


}
