<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model{

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

}
