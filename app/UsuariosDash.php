<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosDash extends Model{

    protected $table = "dash_usuarios";
    protected $fillable = ['nome', 'email', 'senha', 'conta_id'];
}


?>
