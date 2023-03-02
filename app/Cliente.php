<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $fillable = ['nome', 'config_numero_pasta_emkt', 'config_nome_pasta_emkt'];
}

?>
