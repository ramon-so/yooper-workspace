<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmEmktNews extends Model{
    protected $fillable = ['cliente_id','modelo_id', 'usuario_id', 'previa', 'nome_campanha','numero_pasta',
    'utm_source', 'utm_medium', 'utm_campaign', 'banners_json', 'produtos_json'];
}

?>
