<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model{

    protected $table = "rh_solicitacaos";
    protected $fillable = ['titulo', 'departamento_id', 'cargo_id', 'nivel_de', 'nivel_para', 'qtd_candidatos', 'prioridade', 'status', 'user_id', 'subdepartamento_id'];
}


?>
