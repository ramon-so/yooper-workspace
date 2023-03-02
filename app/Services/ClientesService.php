<?php

namespace App\Services;

use App\Repositories\ClientesRepository;
use App\Helpers\Clientes\Cliente;

class ClientesService
{

    public $return_clientes = [];

    public function findOne($id){
        $cliente_repository = new ClientesRepository();

        return $cliente_repository->findOne($id);

    }

}
