<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessoSeletivoCandidatos extends Model{

    protected $table = "rh_processo_seletivo_candidatos";
    protected $fillable = ['candidato_id', 'processo_seletivo_id', 'user_id', 'status_id'];
}


?>
