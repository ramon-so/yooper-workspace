<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicos_por_departamento extends Model{

    protected $table = "servicos_por_departamento";
    protected $fillable = ['servicos_id', 'departamentos_id', 'created_at', 'updated_at'];
}


?>
