<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusProcessoSeletivo extends Model{
    protected $table = "rh_processo_seletivo_status";
    protected $fillable = ['nome', 'ativo'];
}

?>
