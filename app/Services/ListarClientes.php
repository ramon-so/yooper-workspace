<?php

namespace App\Services;

use App\Cliente;

class ListarClientes
{

    public function listarClientes(){
        $clientes = Cliente::query()->select('*')
        ->where('ativo', 'Sim')->orderBy('nome')->get();
        $cliente_list = [];

        foreach ($clientes as $cliente) {
            array_push($cliente_list, $cliente);
        }

        return $cliente_list;
    }

    // Tabela clientes
    public function clientes(){
        $clientes = Cliente::query()->select('*')->orderBy('empresa')->get();
        $cliente_list = [];

        foreach ($clientes as $cliente) {
            array_push($cliente_list, $cliente);
        }

        return $cliente_list;
    }
    

}
