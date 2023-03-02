<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidatos extends Model{

    protected $table = "rh_candidato";
    protected $fillable = ['nome', 'data_nascimento', 'email', 'telefone', 'linkedin_link', 'curriculo_anexo', 'user_id', 'captacao_id'];
}


?>
