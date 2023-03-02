<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model{
    protected $fillable = ['nome', 'cpf', 'email', 'sexo', 'ativo', 'departamento_id'];
    

    public function departamento(){
        return $this->hasMany('Departamento');
    }
}


?>
