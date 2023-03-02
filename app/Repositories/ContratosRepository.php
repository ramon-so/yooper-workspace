<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Contratos;

//use Your Model

/**
 * Class ContratosRepository.
 */
class ContratosRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Contratos::class;
    }

    public function buscar_pendentes(){
        return Contratos::select('*')
        ->where('data_kickoff','=', NULL)
        ->where('data_solicitacao_cancelamento', '=', NULL)
        ->where('data_ultimo_dia','=', NULL)
        ->orderBy('contratos.created_at', 'desc')
        ->get();

    }

}
