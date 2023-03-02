<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmEmktModelo extends Model{
    protected $fillable = ['nome', 'qtd_banners', 'qtd_produtos', 'descricao', 'modelo_miniatura', 'modelo_original' ];
}

?>
