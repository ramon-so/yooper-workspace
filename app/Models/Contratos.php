<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contratos extends Model{

    protected $table = 'contratos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

}