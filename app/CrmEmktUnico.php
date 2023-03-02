<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmEmktUnico extends Model{
    protected $fillable = ['nome','nome_campanha', 'cliente_id', 'numero_pasta', 'link', 'usuario_id', 'imagem_email', 'previa'];
}

?>
