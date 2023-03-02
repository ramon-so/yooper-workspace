<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Carteiras;
use Illuminate\Http\Request;
//use Your Model

/**
 * Class CarteirasRepository.
 */
class CarteirasRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Carteiras::class;
    }
}
