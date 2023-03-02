<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespostaCandidato extends Model{

    protected $table = "rh_resposta_candidatos";
    protected $fillable = ['avaliacao_id', 'candidato_id', 'processo_id', 'respostas', 'avaliacao_head', 'observacao_head', 'avaliacao_gyg', 'observacao_gyg'];
}


?>
