<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDepartamentos extends Model{
    protected $table = "subdepartamentos";
    protected $fillable = ['nome', 'departamento_id', 'ativo'];
}

?>
