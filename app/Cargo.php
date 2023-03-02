<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{
    protected $table = "rh_cargos";
    protected $fillable = ['nome'];
}

?>
