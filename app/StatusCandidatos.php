<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusCandidatos extends Model{
    protected $table = "rh_candidatos_status";
    protected $fillable = ['nome', 'ativo'];
}

?>
