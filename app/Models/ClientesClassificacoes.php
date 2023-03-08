<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientesClassificacoes extends Model
{
    protected $table = 'cliente_classificacoes';
    protected $fillable = [
        'cliente_id', 'volume'
    ];

}

?>