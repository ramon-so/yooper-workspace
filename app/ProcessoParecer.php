<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessoParecer extends Model{

    protected $table = "rh_processo_parecers";
    protected $fillable = ['processo_id', 'parecer', 'user_id'];
}


?>
