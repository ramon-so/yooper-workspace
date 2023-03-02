<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model{

    protected $table = "rh_avaliacaos";
    protected $fillable = ['nome', 'tipo', 'departamento_id', 'qtd_dissertativa', 'qtd_alternativa', 'json_avaliacao', 'status'];
}


?>
