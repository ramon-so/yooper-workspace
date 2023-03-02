<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Captacao extends Model{
    protected $table = "rh_fonte_captacaos";
    protected $fillable = ['nome', 'ativo'];
}

?>
