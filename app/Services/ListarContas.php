<?php

namespace App\Services;

use App\Contas;
use App\UsuariosDash;
use Illuminate\Support\Facades\DB;

class listarContas
{


    public function listarContas(){
        $clientes = UsuariosDash::select(
        'dash_clientes.cliente AS cliente_nome',
        'dash_clientes.id',
        'dash_clientes.status',
            
        )->join('dash_clientes', 'dash_clientes.id', '=', 'dash_usuarios.conta_id')->orderBy('cliente_nome')->get();
        $client = [];

        foreach ($clientes as $cliente) {
            array_push($client, $cliente);
        }

        return $client;
    }


}
