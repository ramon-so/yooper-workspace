<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidatoParecer extends Model{

    protected $table = "rh_processo_candidato_parecers";
    protected $fillable = ['candidato_id', 'processo_id', 'parecer', 'user_id', 'avaliacao'];
}


?>
