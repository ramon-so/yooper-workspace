<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heads extends Model{

    protected $table = "heads";
    protected $fillable = ['funcionario_id', 'departamento_id', 'ativo'];
}


?>
