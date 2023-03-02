<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Servicos;
//use Your Model

/**
 * Class ServicosRepository.
 */
class ServicosRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Servicos::class;
    }

    public function findOne($id){
        return Servicos::find($id);
    }
}
